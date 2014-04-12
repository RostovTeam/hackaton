<?php

/**
 * 
 *
 * @author Komov Roman <komov.r@gmail.com>
 */
class MemberController extends RESTfulController
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
                'users'=>['*']
            ]
                ], parent::accessRules());
    }
}
