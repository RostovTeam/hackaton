<?php

/**
 * 
 *
 * @author Komov Roman <komov.r@gmail.com>
 */
class InstallRolesCommand extends CConsoleCommand
{

    public function actionIndex()
    {
        Yii::import('application.models.*');

        $auth = Yii::app()->authManager;
        $auth->clearAll();

        $role_member = $auth->createRole('member');

        $role_admin = $auth->createRole('manager');

        $role_expert = $auth->createRole('expert');

        $auth->save();
    }

}
