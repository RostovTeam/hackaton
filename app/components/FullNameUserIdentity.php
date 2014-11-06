<?php

/**
 * 
 *
 * @author Komov Roman
 */
class FullNameUserIdentity extends CUserIdentity
{

    protected $_id;
    protected $fullname;

    public function __construct($fullname)
    {
        $this->fullname = $fullname;
        parent::__construct($fullname, '');
    }

    public function authenticate()
    {
        $user = Member::model()->findByAttributes(['full_name' => $this->fullname]);

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
