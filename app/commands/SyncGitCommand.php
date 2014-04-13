<?php

/**
 * 
 *
 * @author Komov Roman <komov.r@gmail.com>
 */
class SyncGitCommand extends CConsoleCommand
{

    public function actionIndex()
    {
        Yii::import('application.git.GitHubConnector');

        $projects = Project::model()->findAll();

        foreach ($projects as $project)
        {
            if (!$project->git_url) continue;

            try
            {
                $gh = new GitHubConnector($project->git_url);

                $commits = $gh->getCommits();
                //var_dump($commits);
                foreach ($commits as $c)
                {

                    $commiter = $c->getCommitter();
                    $member_id = null;
                    $login = null;
                    if ($commiter && ($login = $commiter->getLogin()))
                    {
                        $commit_member = Member::model()->findByAttributes(['git_nickname' => $login]);
                        $member_id = $commit_member ? $commit_member->id : null;
                    }

                    $ex_commit = Commit::model()->findByAttributes(['hash' => $c->getSha(),
                        'project_id' => $project->id]);

                    if ($ex_commit) continue;

                    $commit = new Commit('create');

                    $commit->project_id = $project->id;
                    $commit->member_id = $member_id;

                    $commit->url = $c->getUrl();
                    $commit->hash = $c->getSha();
                    $commit->commiter_login = $login;

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
