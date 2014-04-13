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
                //'roles' => ['member', 'admin']
                'users' => ['*']
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
