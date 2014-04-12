<?php

/**
 * 
 *
 * @author Komov Roman
 */
class AuthController extends RESTfulController
{

    public function accessRules()
    {
        return array_merge([
            ['allow',
                'users' => ['*']
            ]
                ]
                , parent::accessRules());
    }

    public function actionVkLogin()
    {
        
    }

}
