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
            ['allow',
                //'roles' => ['member', 'admin']
                'users' => ['*']
            ]
                ], parent::accessRules());
    }

    public function getFilterCriteria()
    {
        $cr = parent::getFilterCriteria();

        $cr->with = ['members','owner'];

        if ($name = Yii::app()->request->getParam('name'))
        {
            $cr->compare('name', $name, true);
        }

        if ($event_id = Yii::app()->request->getParam('event_id '))
        {
            $cr->compare('event_id', $event_id);
        }

        return $cr;
    }

    public function serializeView($model)
    {
        $row = $model->attributes;

        $row['owner'] = $model->owner;
        $row['members'] = $model->members;
        $row['mark']=$model->getMark();
        
        return $row;
    }

}
