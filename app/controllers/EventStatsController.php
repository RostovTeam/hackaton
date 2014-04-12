<?php

/**
 * 
 *
 * @author Komov Roman
 */
class EventStatsController extends RESTfulController
{

    public function accessRules()
    {
        return array_merge(
                [
            ['allow',
                'actions' => [ 'list'],
                //'roles' => ['member','admin']
                'users' => ['*']
            ]
                ], parent::accessRules());
    }

    public function actionList()
    {

        $event_id = Yii::app()->request->getParam('event_id');

        if (!$event_id)
        {
            $event_id = Yii::app()->db->createCommand()
                    ->select('id')
                    ->from(Event::model()->tableName())
                    ->order('created')
                    ->limit(1)
                    ->queryScalar();
        }

        $event = Event::model()->findByPk($event_id);

        $projectsCount = count($event->projects);

        $membersCount = count($event->members);

        $commitsCount = count($event->commits);

        $this->_sendResponse(200,
                [
            'projects_count' => $projectsCount,
            'members_count' => $membersCount,
            'commits_count' => $commitsCount
        ]);
    }

}
