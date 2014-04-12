<?php

class SiteController extends BaseController
{

    /**
     * This is the default 'index' action that is invoked
     * when an action is not explicitly requested by users.
     */
    public function actionIndex()
    {
        $this->render('index');
    }

    /**
     * This is the action to handle external exceptions.
     */
    public function actionError()
    {
        if ($error = Yii::app()->errorHandler->error)
        {
            if (Yii::app()->request->isAjaxRequest) echo $error['message'];
            else $this->render('error', $error);
        }
    }

    /**
     * Displays the login page
     */
    public function actionLogin()
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

    public function actionExpertLogin()
    {

        $model = new PhoneLoginForm;

        // collect user input data
        if (isset($_POST['PhoneLoginForm']))
        {
            $model->attributes = $_POST['PhoneLoginForm'];
            
            if ($model->validate() && $model->login())
                    $this->redirect($this->createUrl('expert'));
        }

        // display the login form
        $this->render('phonelogin', array('model' => $model));
    }

    /**
     * Logs out the current user and redirect to homepage.
     */
    public function actionLogout()
    {
        Yii::app()->user->logout();
        $this->redirect($this->createUrl('index'));
    }
    
    public function actionExpert()
    {
        $this->render('expert');
    }

    public function actionMember()
    {
        $this->render('member');
    }
}
