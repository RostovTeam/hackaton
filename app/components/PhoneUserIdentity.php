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
        $user = Member::model()->findByAttributes(['phone' => $this->phone,'type'=>  Member::MEMBER_TYPE_EXPERT]);

        if ($user === null)
        {
            $this->errorCode = self::ERROR_USERNAME_INVALID;
            return false;
        }
        
        $this->_id = $user->id;

        $this->errorCode = UserIdentity::ERROR_NONE;

        $this->setState('active_event', $user->active_event);
        $this->setState('role', $user->roles ? $user->roles[0]->name : '');

        return true;
    }

    public function getId()
    {
        return $this->_id;
    }

}
