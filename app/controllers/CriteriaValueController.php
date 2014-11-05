<?php

/**
 * 
 *
 * @author Komov Roman
 */
class CriteriaValueController extends RESTfulController
{

    protected $model = 'CriteriaValue';

    public function accessRules()
    {
        return array_merge(
                [
            ['allow',
                'actions' => ['list', 'view'],
                'roles' => ['member','expert']
            ],
            ['allow',
                'roles' => ['manager']
            ]
                ], parent::accessRules());
    }

    public function serializeView($model)
    {
        $row = $model->attributes;

        return $row;
    }

}
