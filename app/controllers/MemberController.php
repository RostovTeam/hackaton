<?php

/**
 * 
 *
 * @author Komov Roman <komov.r@gmail.com>
 */
class MemberController extends RESTfulController
{

    protected $model;

    public function __construct()
    {
        $this->model = Member::className();
    }

    public function accessRules()
    {
        return array_merge(
                [
            ['allow',
                'actions' => ['view'],
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

        return $cr;
    }

    public function transform(&$model)
    {
        parent::transform($model);
        $model->type = Member::MEMBER_TYPE_MEMBER;

        if (Yii::app()->user->role == 'manager')
        {
            $model->active_event = Yii::app()->user->active_event;
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

}
