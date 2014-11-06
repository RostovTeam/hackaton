<?php

/**
 * 
 *
 * @author Komov Roman
 */
class ManagerController extends RESTfulApiTestCase
{

    public $modelName = 'Manager';
    public $resourse = '/api/Manager';
    public $data = [
        'full_name' => 'Larry Page',
        'phone' => '79054447777',
        'login'=>'login',
        'password'=>'password'
    ];
    public $filter = [
        'full_name' => 'Larry'
    ];
    public $fixtures = [
        'events' => 'Event',
        'members' => 'Member',
        'roles'=>'Role',
        'member_roles'=>'MemberRole',
    ];

}
