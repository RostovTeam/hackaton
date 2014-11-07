<?php

/**
 * 
 *
 * @author Komov Roman <komov.r@gmail.com>
 */
class ExpertController extends RESTfulController
{

    protected $model;
    protected $formModel;

    public function __construct()
    {
        $this->model = Expert::className();
        $this->formModel = MemberForm::className();
    }

    public function accessRules()
    {
        return array_merge(
                [
            ['allow',
                'roles' => ['manager'],
            ],
            ['allow',
                'actions' => ['view', 'list'],
                'roles' => ['member', 'expert'],
            ],
            ['allow',
                'actions' => ['update', 'events'],
                'roles' => [ 'expert'],
            ]
                ], parent::accessRules());
    }

    protected function transform(&$model)
    {
        parent::transform($model);
        $model->login = $model->phone;
        
        $model->type = Member::MEMBER_TYPE_EXPERT;
    }

    public function getUpdateModel($id = false)
    {
        if (Yii::app()->user->hasState('role') && Yii::app()->user->role == 'expert')
        {
            return Member::model()->findByPk(Yii::app()->user->id);
        } else
        {
            return parent::getUpdateModel($id);
        }
    }

    protected function getFilterCriteria()
    {
        $cr = parent::getFilterCriteria();

        return $cr;
    }

    public function actionEvents()
    {
        if ($model = $this->getUpdateModel())
        {
            $this->_sendResponse(200, $model->events);
        } else
        {
            $this->_sendResponse(403, '');
        }
    }

}
