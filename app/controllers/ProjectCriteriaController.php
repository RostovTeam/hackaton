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

    protected function getFilterCriteria()
    {
        $cr = parent::getFilterCriteria();

        if ($event_id = Yii::app()->request->getParam('event_id'))
        {
            $cr->addCondition('project_id in (select id from project where event_id=:event_id)');
            $cr->params = [':event_id' => $event_id];
        }
        return $cr;
    }

}
