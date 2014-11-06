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
        return [
            [
                'allow',
                'users'=>'*'
            ]
        ];
    }

    /**
     * Displays the login page
     */
    public function actionSNLogin()
    {
        if (!$this->user()->isGuest)
        {
            $this->redirect(Yii::app()->user->returnUrl);
        }

        Yii::log('Authenticating', CLogger::LEVEL_INFO, 'auth');

        $serviceName = Yii::app()->request->getParam('service');

        if ($serviceName)
        {
            Yii::log('With ' . $serviceName, CLogger::LEVEL_INFO, 'auth');
            /** @var $eauth EAuthServiceBase */
            $eauth = Yii::app()->eauth->getIdentity($serviceName);
            $eauth->redirectUrl = Yii::app()->user->returnUrl;
            $eauth->cancelUrl = $this->createAbsoluteUrl('site/login');

            try
            {
                Yii::log('Trying  ' . $serviceName, CLogger::LEVEL_INFO, 'auth');
                if ($eauth->authenticate())
                {
                    Yii::log('Eauth authenticated ', CLogger::LEVEL_INFO, 'auth');

                    $identity = new EAuthUserIdentity($eauth);

                    // successful authentication
                    if ($identity->authenticate())
                    {
                        Yii::app()->user->login($identity);

                        $session = Yii::app()->session;
                        $session['eauth_profile'] = $eauth->attributes;

                        Yii::log('Auth success', CLogger::LEVEL_INFO, 'auth');

                        // redirect and close the popup window if needed
                        $eauth->redirect();
                    } else
                    {
                        Yii::log('Auth cant authenticate identity',
                                CLogger::LEVEL_WARNING, 'auth');
                        // close popup window and redirect to cancelUrl
                        $eauth->cancel();
                    }
                }
                Yii::log('Auth cant authenticate eauth', CLogger::LEVEL_WARNING,
                        'auth');

                // Something went wrong, redirect back to login page
                $this->redirect(array('site/login'));
            } catch (EAuthException $e)
            {
                Yii::log('EAuth exception ' . $e->getMessage(),
                        CLogger::LEVEL_WARNING, 'auth');

                // save authentication error to session
                Yii::app()->user->setFlash('error',
                        'EAuthException: ' . $e->getMessage());

                // close popup window and redirect to cancelUrl
                $eauth->redirect($eauth->getCancelUrl());
            }
        }
    }

    public function actionLogin()
    {
        $this->layout = '//layouts/main';
        $model = new LoginForm;


        $params = Yii::app()->request->getJsonData();

        if (!$params)
        {
            $this->_sendResponse(400, ['error' => 'empty request']);
            return;
        }

        $model->attributes = $params;

        if ($model->validate() && $model->login())
        {
            $this->_sendResponse(200, []);
        } else
        {
            $this->_sendResponse(400, ['error' => $model->errors]);
        }
    }
    
    public function actionExpertLogin()
    {
        $this->layout = '//layouts/main';
        $model = new PhoneLoginForm;


        $params = Yii::app()->request->getJsonData();

        if (!$params)
        {

            $this->_sendResponse(400, ['error' => 'empty request']);
            return;
        }

        $model->attributes = $params;

        if ($model->validate() && $model->login())
        {
            $this->_sendResponse(200, []);
        } else
        {
            $this->_sendResponse(400, ['error' => 'failed to find expert']);
        }
    }

    public function actionFullNameLogin()
    {
        $model = new FullNameLoginForm;

        $params = Yii::app()->request->getJsonData();

        if (!$params)
        {
            $this->_sendResponse(400, ['error' => 'empty request']);
            return;
        }

        $model->attributes = $params;

        if ($model->validate() && $model->login())
        {
            $this->_sendResponse(200, []);
        } else
        {
            $this->_sendResponse(400, ['error' => 'failed to find member']);
        }
    }

    /**
     * Logs out the current user and redirect to homepage.
     */
    public function actionLogout()
    {
        Yii::app()->user->logout();
        $this->_sendResponse(200, []);
    }

}
