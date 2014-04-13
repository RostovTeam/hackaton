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
        $event_created = '';
        if (!$event_id)
        {
            $event = Yii::app()->db->createCommand()
                    ->select('*')
                    ->from(Event::model()->tableName())
                    ->order('created')
                    ->limit(1)
                    ->queryRow();
            $event_id = $event['id'];
            $event_created = $event['created'];
        } else
        {
            $event = Event::model()->findByPk($event_id);
            $event_created = $event->created;
        }

        $event = Event::model()->findByPk($event_id);

        $projectsCount = count($event->projects);

        $membersCount = count($event->members);

        $commitsCount = count($event->commits);

        $start = Yii::app()->request->getParam('start', $event_created);

        $commmitDetail = $this->getCommitsDetail($start);


        $this->_sendResponse(200,
                [
            'event_id' => $event->id,
            'projects_count' => $projectsCount,
            'members_count' => $membersCount,
            'commits_count' => $commitsCount,
            'commit_detail' => $commmitDetail,
            'start_date' => $start
        ]);
    }

    protected function getCommitsDetail($start)
    {
        $int = 60;
        $date = new DateTime($start);

        $now = new DateTime();
//        $command = Yii::app()->db->createCommand()
//                ->select([new CDbExpression(' count(*) as count'),
//                    new CDbExpression('ROUND(UNIX_TIMESTAMP(date)/(' . $int . ' * 60)) AS timekey')])
//                ->from(Commit::model()->tableName())
//                ->where('date>:start', [':start' => $start])
//                ->group('timekey');
//        
//        $commits = $command->queryAll();
//
//        $counts = array_map(function($v) use($int,&$date)
//        {
//            return ['count'=>v['count'],'date'=>$date->];
//        }, $commits);

        $counts = [];
        $dates = [];

        $commits = Yii::app()->db->createCommand()
                ->select('*')
                ->from(Commit::model()->tableName())
                ->where('date>:start', [':start' => $start])
                ->order('date asc')
                ->queryAll();

        $i = 0;
        while ($now->diff($date)->invert)
        {
            $row = [];
            $dates[] = $date->format('H:i');
            $sum = 0;
            $nex_date = $date->add(new DateInterval('PT3H'));

            for (; $i < count($commits); $i++)
            {
                if (!$nex_date->diff(new DateTime($commits[$i]['date']))->invert)
                        break;

                $sum++;
            }

            $date = clone $nex_date;

            $counts[] = $sum;

            $data[] = $row;
        }

        return ['counts' => $counts, 'dates' => $dates];
    }

    public function create()
    {
        Yii::import('application.git.GitHubConnector');

        GitHubConnector::sync();
    }

}
