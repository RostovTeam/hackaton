<?php

/**
 * 
 *
 * @author Komov Roman <komov.r@gmail.com>
 */
class EventController extends RESTfulController
{

    protected $model;

    public function __construct()
    {
        $this->model = Event::className();
    }

    public function accessRules()
    {
        return array_merge(
                [
            ['allow',
                //'roles' => ['member','admin']
                'users' => ['*']
            ]
                ], parent::accessRules());
    }
    
    public function getFilterCriteria()
    {
        $cr=parent::getFilterCriteria();
        
        if($name=Yii::app()->request->getParam('name'))
        {
            $cr->compare('name', $name,true);
        }
        
        return $cr;
    }

}
