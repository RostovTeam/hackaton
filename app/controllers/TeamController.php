<?php

/**
 * 
 *
 * @author Komov Roman
 */
class TeamController extends RESTfulController
{

    protected $model;

    public function __construct()
    {
        $this->model = Team::className();
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

        $cr->with = ['members'];

        return $cr;
    }

    public function serializeView($model)
    {
        $row = $model->attributes;

        $row['members'] = $model->team->members;
        
        return $row;
    }

}
