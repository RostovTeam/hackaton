<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class PhoneLoginForm extends CFormModel
{

    public $username;
    private $_identity;

    /**
     * Declares the validation rules.
     * The rules state that username and password are required,
     * and password needs to be authenticated.
     */
    public function rules()
    {
        return array(
            array('username', 'required'),
            array('username', 'authenticate')
        );
    }

    /**
     * Declares attribute labels.
     */
    public function attributeLabels()
    {
        return array(
            'username' => 'Номер эксперта'
        );
    }
    
    public function authenticate()
    {
        if (!$this->hasErrors())
        {
            $this->_identity = new PhoneUserIdentity($this->username);
            if (!$this->_identity->authenticate())
                    $this->addError('username', 'Номер не найден');
        }
    }

    /**
     * Logs in the user using the given username and password in the model.
     * @return boolean whether login is successful
     */
    public function login()
    {
        if ($this->_identity === null)
        {
            $this->_identity = new PhoneUserIdentity($this->username);
            $this->_identity->authenticate();
        }

        if ($this->_identity->errorCode === UserIdentity::ERROR_NONE)
        {
            $duration = 3600 * 24 * 30; // 30 days
            Yii::app()->user->login($this->_identity, $duration);
            return true;
        } else return false;
    }

}
