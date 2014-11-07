<?php

/**
 * 
 *
 * @author Komov Roman <komov.r@gmail.com>
 */
class ProjectController extends RESTfulController
{

    protected $model;

    public function __construct()
    {
        $this->model = Project::className();
    }

    public function accessRules()
    {
        return array_merge(
                [
            [
                'allow',
                'roles' => ['member'],
            ],
            ['allow',
                'roles' => ['manager', 'expert'],
                'actions' => ['list', 'view']
            ],
            ['allow',
                'users' => '*',
                'actions' => ['list', 'view']
            ]
                ], parent::accessRules());
    }

    public function getFilterCriteria()
    {
        $cr = parent::getFilterCriteria();

        $cr->with = ['members', 'owner', 'projectCriterias'];

        if (Yii::app()->user->role == 'member' || Yii::app()->user->role == 'expert')
        {
            $member = Member::model()->findByPk(Yii::app()->user->id);
            $cr->compare('event_id',
                    array_map(function($v)
                    {
                        return $v->id;
                    }, $member->events));
        } else
        {
            if ($event_id = Yii::app()->request->getParam('event_id'))
            {
                $cr->compare('event_id', $event_id);
            }
        }

        if ($name = Yii::app()->request->getParam('name'))
        {
            $cr->compare('name', $name, true);
        }

        return $cr;
    }

    protected function transform(&$model)
    {
        parent::transform($model);

        if (Yii::app()->user->hasState('active_event') && Yii::app()->user->active_event)
        {
            $model->event_id = Yii::app()->user->active_event;
        }

        $model->owner_id = Yii::app()->user->id;
    }

    public function serializeView($model)
    {
        $row = $model->attributes;

        if (!Yii::app()->user->isGuest)
        {
            $row['members'] = $model->members;
            $row['owner'] = $model->owner;
        }

        $row['mark'] = $model->getMark();
        $row['is_active'] = $model->isActive();
        $row['criterias'] = $model->projectCriterias();

        return $row;
    }

}
