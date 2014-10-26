<?php

/**
 * 
 *
 * @author Komov Roman <komov.r@gmail.com>
 */
class ExpertController extends RESTfulController
{
    protected $model;

    public function __construct()
    {
        $this->model = Expert::className();
    }

    public function accessRules()
    {
        return array_merge(
                [
            ['allow',
//                'actions' => ['view', 'list'],
//                'roles' => ['member'],
                'users' => ['*']
            ]
                ], parent::accessRules());
    }

    protected function getFilterCriteria()
    {
        $cr = parent::getFilterCriteria();
        
        return $cr;
    }

}
