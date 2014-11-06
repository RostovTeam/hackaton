<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class PhoneLoginForm extends CFormModel
{

    public $phone;
    private $_identity;

    /**
     * Declares the validation rules.
     * The rules state that phone and password are required,
     * and password needs to be authenticated.
     */
    public function rules()
    {
        return array(
            array('phone', 'required'),
            array('phone', 'authenticate')
        );
    }

    /**
     * Declares attribute labels.
     */
    public function attributeLabels()
    {
        return array(
            'phone' => 'Номер эксперта'
        );
    }
    
    public function authenticate()
    {
        if (!$this->hasErrors())
        {
            $this->_identity = new PhoneUserIdentity($this->phone);
            if (!$this->_identity->authenticate())
                    $this->addError('phone', 'Номер не найден');
        }
    }

    /**
     * Logs in the user using the given phone and password in the model.
     * @return boolean whether login is successful
     */
    public function login()
    {
        if ($this->_identity === null)
        {
            $this->_identity = new PhoneUserIdentity($this->phone);
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
