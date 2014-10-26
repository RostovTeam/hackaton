<?php

/**
 * 
 *
 * @author Komov Roman
 */
class PhoneUserIdentity extends CUserIdentity
{

    protected $_id;
    protected $phone;

    public function __construct($phone)
    {
        $this->phone = $phone;
        parent::__construct($phone, '');
    }

    public function authenticate()
    {
        $user = Expert::model()->findByAttributes(['login' => $this->phone]);

        if ($user === null)
        {
            $this->errorCode = self::ERROR_USERNAME_INVALID;
            return false;
        }
        $this->_id = $user->id;

        $this->errorCode = UserIdentity::ERROR_NONE;
       
        return true;
    }

    public function getId()
    {
        return $this->_id;
    }

}
