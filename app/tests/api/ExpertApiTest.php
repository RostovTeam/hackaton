<?php

/**
 * 
 *
 * @author Komov Roman
 */
class ExpertApiTest extends RESTfulApiTestCase
{

    public $modelName = 'Expert';
    public $resourse = '/api/Expert';
    public $data = [
        'full_name' => 'Elon Mask',
        'phone' => '79054447777',
        'event_id' => 1
    ];
    public $filter = [
        'full_name' => 'Elon',
        'event_id' => 1
    ];
    public $fixtures = [
        'events' => 'Event',
        'members' => 'Member',
        'roles' => 'Role',
        'member_roles' => 'MemberRole',
        'event_members' => ':event_members'
    ];

    public function testApi()
    {
        $this->auth();

        $data = $this->_create();
        $this->_list();
        $this->_view($data['id']);
        $this->_update($data['id']);
        $this->_delete($data['id']);
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
