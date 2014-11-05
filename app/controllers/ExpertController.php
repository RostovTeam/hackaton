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
                'roles' => ['manager'],
                'users' => ['*']
            ],
            ['allow',
                'actions'=>['view','list'],
                'roles' => ['member','expert'],
                'users' => ['*']
            ]
                ], parent::accessRules());
    }

    protected function transform(&$model)
    {
        parent::transform($model);
        $model->login = $model->phone;
    }

    protected function getFilterCriteria()
    {
        $cr = parent::getFilterCriteria();

        return $cr;
    }

}
