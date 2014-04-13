<?php

class ProjectStatsController extends RESTfulController
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

        $project_id = Yii::app()->request->getParam('project_id');

        if (!$project_id)
        {
            $this->_sendResponse(400, []);
        }

        $project = Project::model()->findByPk($project_id);

        //$projectsCount = count($event->projects);

        $membersCount = count($project->team->members);

        $commitsCount = count($project->commits);

        $start = Yii::app()->request->getParam('start', $project->created);

        $commmitDetail = $this->getCommitsDetail($project, $start);

        $this->_sendResponse(200,
                [
            'project_id' => $project->id,
            //'projects_count' => $projectsCount,
            'members_count' => $membersCount,
            'commits_count' => $commitsCount,
            'commit_detail' => $commmitDetail,
            'start_date' => $start
        ]);
    }

    protected function getCommitsDetail($project, $start)
    {

        $int = 60;
        $date = new DateTime($start);

        $now = new DateTime();


        $counts = [];
        $dates = [];

        $commits = $project->commits;

        $i = 0;
        while ($now->diff($date)->invert)
        {
            $row = [];
            $dates[] = $date->format('H:i');
            $sum = 0;
            $nex_date = $date->add(new DateInterval('PT1H'));

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
