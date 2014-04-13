<?php

require_once(__DIR__ . '/libs/client/GitHubClient.php');

class GitHubConnector
{

    public $user;
    public $repo;

    public function __construct($url)
    {
        $user_arr = explode('github.com/', $url);
        $array_param = explode('/', $user_arr[1]);
        $this->user = $array_param[0];
        $this->repo = $array_param[1];
    }

    public function getCommits($since=null)
    {

        $client = new GitHubClient();
        $commits = $client
                ->repos
                ->commits
                ->listCommitsOnRepository($this->user, $this->repo, null, null,
                null, $since);

        return $commits;
    }

    public function getLines()
    {
        
    }

    public static function Sync()
    {
        

        $projects = Project::model()->findAll();

        foreach ($projects as $project)
        {
            if (!$project->git_url) continue;

            try
            {
                $gh = new GitHubConnector($project->git_url);

                //date("c", strtotime('-15 minutes')
                $commits = $gh->getCommits();
                //var_dump($commits);
                foreach ($commits as $c)
                {

                    $committer = $c->commit->committer;
                    $member_id = null;
                    $login = null;
                    if ($committer && ($login = $committer->email))
                    {
                        $commit_member = Member::model()->findByAttributes(['git_nickname' => $login]);
                        $member_id = $commit_member ? $commit_member->id : null;
                    }

                    $ex_commit = Commit::model()->findByAttributes(['hash' => $c->sha,
                        'project_id' => $project->id]);

                    if ($ex_commit) continue;

                    $commit = new Commit('create');

                    $commit->project_id = $project->id;
                    $commit->member_id = $member_id;

                    $commit->url = $c->url;
                    $commit->hash = $c->sha;
                    $commit->commiter_login = $login;
                    $commit->date = $c->commit->committer ? $c->commit->committer->date : new CDbExpression('NOW()');

                    $commit->save();
                    var_dump($commit->attributes);
                    var_dump($commit->errors);
                }
            } catch (Exception $e)
            {
                continue;
            }
        }
    }

}
