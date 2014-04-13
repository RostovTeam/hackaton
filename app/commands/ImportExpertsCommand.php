<?php

/**
 * 
 *
 * @author Komov Roman <komov.r@gmail.com>
 */
class ImportExpertsCommand extends CConsoleCommand
{

    protected $data = [
        [
            'full_name' => 'Full name',
            'phone' => '89044440257'
        ],
        [
            'full_name' => 'Full name',
            'phone' => '89089991469'
        ]
    ];

    public function actionIndex()
    {
        $tr = Yii::app()->db->beginTransaction();
        $auth = Yii::app()->authManager;
        foreach ($this->data as $row)
        {

            $expert_user = new User('create');
            $expert_user->login = $row['phone'];
            $expert_user->password = '';
            if (!$expert_user->save())
            {
                var_dump($expert_user->errors);
                $tr->rollback();
                return;
            }

            $expert = new Expert('create');
            $expert->full_name = $row['full_name'];
            $expert->phone = $row['phone'];
            $expert->user_id = $expert_user->id;

            if (!$expert->save())
            {
                var_dump($expert->errors);
                $tr->rollback();
                return;
            }


            $auth->assign('expert', $expert_user->id);
        }
        
        $tr->commit();
    }

}
