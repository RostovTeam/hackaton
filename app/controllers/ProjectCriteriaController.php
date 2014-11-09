<?php

/**
 * 
 *
 * @author Komov Roman
 */
class ProjectCriteriaController extends RESTfulController
{

    protected $model = 'ProjectCriteria';

    public function accessRules()
    {
        return array_merge(
                [
            ['allow',
                'roles' => ['expert'],
                'actions' => ['create','update']
            ],
            ['allow',
                'roles' => ['manager','member'],
                'actions' => ['view','list']
            ]
                ], parent::accessRules());
    }

    protected function transform(&$model)
    {
        if (Yii::app()->user->role=='expert')
        {
            $model->expert_id = Yii::app()->user->id;
        }
    }
    
    public function actionCreate()
    {
        $modelname = $this->model;

        $params = Yii::app()->request->getJsonData();

        if (isset($params['expert_id']) && isset($params['project_id']))
                $modelname::model()->deleteAll('expert_id=:expert_id and project_id=:project_id',
                    [':expert_id' => $params['expert_id'], ':project_id' => $params['project_id']]);

        if (!$params)
        {
            $this->_sendResponse(400, array('error' => 'empty request'));
        }

        $model= new $modelname('create');
        $model->attributes = $params;

        $this->transform($model);

        if (!$model->validate())
        {
            $this->_sendResponse(500,
                    array('error' => 'validation_errors', 'errors_list' => $model->errors));
        }

        if (get_class($model) == $formModelName)
        {
            if (!($result = $model->create()))
                    $this->_sendResponse(500, array('error' => $model->errors));
        }
        else
        {
            if (!$model->save())
                    $this->_sendResponse(500, array('error' => 'intenal_error'));

            $result = $model;
        }

        $this->_sendResponse(200, $this->serializeView($result));
    }
    protected function getFilterCriteria()
    {
        $cr = parent::getFilterCriteria();

        if (Yii::app()->user->getState('role') == 'expert')
        {
            $cr->compare('expert_id', Yii::app()->user->getState('profile_id'));
        }

        if ($event_id = Yii::app()->request->getParam('event_id'))
        {
            $cr->addCondition('project_id in (select id from project where event_id=:event_id)');
            $cr->params = [':event_id' => $event_id];
        }

        return $cr;
    }

    protected function serializeView($model)
    {
        $row = $model->attributes;
        $row['criteria'] = $model->criteria;
        //$row['project'] = $model->project;
        //$row['expert'] = $model->expert;

        return $row;
    }
}
