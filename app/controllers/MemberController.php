<?php

/**
 * 
 *
 * @author Komov Roman <komov.r@gmail.com>
 */
class MemberController extends RESTfulController
{

    protected $model;
    protected $formModel;

    public function __construct()
    {
        $this->formModel = MemberForm::className();
        $this->model = Member::className();
    }

    public function accessRules()
    {
        return array_merge(
                [
            ['allow',
                'actions' => ['list', 'view', 'update', 'changePassword'],
                'roles' => ['member'],
            ],
            ['allow',
                'roles' => ['manager']
            ]
                ], parent::accessRules());
    }

    protected function getFilterCriteria()
    {
        $cr = parent::getFilterCriteria();
        $cr->compare('type', Member::MEMBER_TYPE_MEMBER);

        if (Yii::app()->user->role == 'member')
        {
            $cr->limit = 7;

            if ($fullname = Yii::app()->request->getParam('full_name') && count($fullname) >= 3)
            {
                //too hardcore... i know
                $cr->condition = 'LOWER(full_name like) LIKE :fullname';
                $cr[':fullname'] = '%' . strtolower(trim($fullname)) . '%';
            } else
            {
                //fo not show list of members without filter
                return null;
            }
        }

        return $cr;
    }

    public function transform(&$model)
    {
        parent::transform($model);
        $model->type = Member::MEMBER_TYPE_MEMBER;

//        if (Yii::app()->user->role == 'manager')
//        {
//            $model->active_event = Yii::app()->user->active_event;
//        }
    }

    public function getUpdateModel($id)
    {
        if (Yii::app()->user->role == 'member')
        {
            return Member::model()->findByPk(Yii::app()->user->id);
        } else
        {
            return parent::getUpdateModel($id);
        }
    }

    public function actoinRegister()
    {
        $model = new RegisterMemberForm();

        $params = Yii::app()->request->getJsonData();

        $model->attributes = $params;

        if (!$model->validate() || !($member = $model->register()))
        {
            $this->_sendResponse(400, $model->errors);
            return;
        }

        $this->_sendResponse(200, $member->attributes);
    }

    public function actionChangePassword()
    {
        $member = Member::model()->find('id=:id and type=:type',
                [':id' => Yii::app()->user->id, ':type' => 'member']);

        if (!$member)
        {
            $this->_sendResponse('404', 'Member not found');
        }

        $member->scenario = 'change_password';

        $member->attributes = Yii::app()->request->getJsonData();

        if (!$member->save())
        {
            $this->_sendResponse('400', ['validation_erros' => $member->errors]);
        }

        $this->_sendResponse('200', ['ok']);
    }

}
