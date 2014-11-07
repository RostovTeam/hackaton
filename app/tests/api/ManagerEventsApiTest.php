<?php

/**
 * 
 *
 * @author Komov Roman
 */
class ManagerEventsApiTest extends RESTfulApiTestCase
{

    public $modelName = 'ManagerEvents';
    public $resourse = '/api/Manager/Events';
    public $data = [
    ];
    public $fixtures = [
        'members' => 'Member',
        'roles' => 'Role',
        'member_roles' => 'MemberRole',
        'events' => 'Event',
        'projects' => 'Project',
        'projects_members' => ':projects_members',
        'criterias' => 'Criteria',
        'event_members'=>':event_members'
    ];

    public function testApi()
    {
        $this->auth();

        //list relations
        $this->_list();
    }

    public function auth()
    {
        $login = $this->members('manager1')['login'];
        $password = $this->members('manager1')['password'];

        $r = $this->request([
            'url' => '/index.php/auth/login',
            'data' => [
                'login' => $login,
                'password' => $password
            ]
        ]);
    }

}