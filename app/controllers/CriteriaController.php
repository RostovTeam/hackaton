<?php

/**
 * 
 *
 * @author Komov Roman
 */
class CriteriaController extends RESTfulController
{

    protected $model = 'Criteria';

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
        $row['values'] = $model->criteriaValues;

        return $row;
    }

}
