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

        $cr->with = ['team'];

        return $cr;
    }

    public function serializeView($model)
    {
        $row = $model->attributes;

        $row['team'] = $model->team;
        $row['members'] = $model->team->members;
        
        return $row;
    }

}
