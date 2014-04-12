<?php

/**
 * 
 *
 * @author Komov Roman
 */
class InstallRolesCommand extends BaseConsoleCommand
{

    public function actionIndex()
    {
        Yii::import('application.models.User');
        
        $auth = Yii::app()->authManager;
        $auth->clearAll();
        
        $role_member = $auth->createRole('member');        
        
        $role_admin = $auth->createRole('admin');
        $expert = new User('create');
        $expert->login = 'admin';
        $expert->password = 'password';
        $expert->save();
        $auth->assign('admin', $expert->id);

        $auth->save();
    }

}
