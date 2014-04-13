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
        GitHubConnector::Sync();
    }

}
