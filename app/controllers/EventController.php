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
                'roles' => ['member','admin']
            ]
                ], parent::accessRules());
    }
}
