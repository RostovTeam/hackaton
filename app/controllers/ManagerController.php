<?php

/**
 * 
 *
 * @author Komov Roman
 */
class ManagerController  extends RESTfulController
{

    protected $model;

    public function __construct()
    {
        $this->model = Member::className();
    }

    public function accessRules()
    {
        return array_merge(
                [
            ['allow',
                //'roles' => ['member','admin']
                'users' => ['*']
            ]
                ], parent::accessRules());
    }

    protected function getFilterCriteria()
    {
        $cr = parent::getFilterCriteria();
        $cr->compare('type', Member::MEMBER_TYPE_MANAGER);
        
        return $cr;
    }

    public function transform(&$model)
    {
        parent::transform($model);
        $model->type = Member::MEMBER_TYPE_MANAGER;
    }

}
