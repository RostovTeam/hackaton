<?php

/**
 * 
 *
 * @author Komov Roman
 */
class MemberApiTest extends RESTfulApiTestCase
{

    public $modelName = 'Member';
    public $resourse = '/api/Member';
    public $data = [
        'full_name' => 'Elon Mask',
        'phone' => '79054447777',
        'event_id' => 1
    ];
    public $filter = [
        'full_name' => 'Elon'
    ];
    public $fixtures = [
        'events' => 'Event',
        'members' => 'Member',
        'roles' => 'Role',
        'member_roles' => 'MemberRole',
    ];

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
