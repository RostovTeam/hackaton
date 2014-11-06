<?php

/**
 * 
 *
 * @author Komov Roman
 */
class RegisterMemberForm extends CFormModel
{

    public $login;
    public $password;
    public $number;
    public $fullname;

    public function rules()
    {
        return [
            ['login,password', 'required'],
            ['login', 'ruleUniqLogin'],
            ['fullname', 'ruleRequiredFullname']
        ];
    }

    public function register()
    {
        if ($this->number)
        {
            $member = Member::model()->find('number=:number',
                    [':number' => $this->number]);
        } else
        {
            $member = new Member();
            $member->type=  Member::MEMBER_TYPE_MEMBER;
        }

        $memder->login = $this->login;
        $memder->fullname = $this->fullname;
        $member->password = $this->password;
        
        if(!$member->save())
        {
            $this->addErrors($member->errors);
            return FALSE;
        }
        
        return $member;
    }

    public function ruleRequiredFullname($_attribute)
    {
        if ($this->number && !$this->fullname)
        {
            $this->addError('fullname', 'Имя должно быть заполнено');
            return false;
        }
        return true;
    }

    public function ruleExistLogin($_attribute, $_params)
    {
        if ($user = Member::model()->find('login = :login',
                [':login' => $this->$_attribute]))
        {
            $this->addError('login', 'Логин уже использовался');
            return false;
        }

        return true;
    }

}
