<?php

/**
 * 
 *
 * @author Komov Roman <komov.r@gmail.com>
 */
class EventController extends RESTfulController
{

    protected $model;

    public function __construct()
    {
        $this->model = Event::className();
    }

    public function accessRules()
    {
        return array_merge(
                [
            ['allow',
                'roles' => ['manager'],
            ],
            ['allow',
                'actions' => ['view', 'list'],
                'roles' => ['member', 'expert'],
            ],
            ['allow',
                'users' => '*',
                'actions' => ['list', 'view']
            ]
                ], parent::accessRules());
    }

    protected function transform(&$model)
    {
        parent::transform($model);
        $model->creator = Yii::app()->user->id;
    }

    public function getFilterCriteria()
    {
        $cr = parent::getFilterCriteria();

        if (Yii::app()->user->hasState('role') 
                && (Yii::app()->user->role == 'member' || Yii::app()->user->role == 'expert') 
                && Yii::app()->request->getParam('attended')
        )
        {

            $member = Member::model()->findByPk(Yii::app()->user->id);
            $cr->compare('id',
                    array_map(function($v)
                    {
                        return $v->id;
                    }, $member->events));
        }

        if ($name = Yii::app()->request->getParam('name'))
        {
            $cr->compare('name', $name, true);
        }

        return $cr;
    }

}
