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
        
        $role_admin = $auth->createRole('admin');
        $admin = new User('create');
        $admin->login = 'admin';
        $admin->password = 'password';
        $admin->save();
        $auth->assign('admin', $admin->id);
        
        $role_expert=$auth->createRole('expert');
        $expert_user = new User('create');
        $expert_user->login = '123';
        $expert_user->password = 'password';
        $expert_user->save();
        $expert= new Expert('create');
        $expert->full_name='Expert';
        $expert->user_id=$expert_user->id;
        $expert->phone='123';
        $expert->save();
        $auth->assign('expert', $expert_user->id);

        $auth->save();
    }
}
