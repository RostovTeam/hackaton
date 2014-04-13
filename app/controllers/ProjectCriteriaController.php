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
                //'roles' => ['member', 'admin']
                'users' => ['*']
            ]
                ], parent::accessRules());
    }

    protected function transform(&$model)
    {
        if (Yii::app()->user->getState('role') == 'expert')
        {
            $model->expert_id = Yii::app()->user->getState('profile_id');
        }
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
