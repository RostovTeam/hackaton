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
        $member = new Member('create');
        $member->full_name = 'Larry Page';
        $member->login = '89044440257';
        $member->password = 'password';
        $member->type='member';
        $member->save();
        $auth->assign('member', $member->id);

        $role_admin = $auth->createRole('manager');
        $manager = new Member('create');
        $manager->full_name = 'Larry Page';
        $manager->login = 'login';
        $manager->password = 'manager_password';
        $member->type='manager';
        $manager->save();
        $auth->assign('manager', $manager->id);

        $role_expert = $auth->createRole('expert');
        $expert_user = new Member('create');
        $expert_user->full_name = 'Larry Page';
        $expert_user->login = '89044440257';
        $expert_user->password = 'password';
        $member->type='expert';
        $expert_user->save();
        $auth->assign('expert', $expert_user->id);

        $auth->save();
    }

}
