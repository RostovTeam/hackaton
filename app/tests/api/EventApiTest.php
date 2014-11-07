<?php

/**
 * 
 *
 * @author Komov Roman
 */
class EventApiTest extends RESTfulApiTestCase
{

    public $modelName = 'Event';
    public $resourse = '/api/Event';
    public $data = [
        'name' => 'best future development',
        'start_date' => '2014-12-01 17:00:00',
        'end_date' => '2014-12-03 19:00:00',
    ];
    public $filter = [
        'name' => 'best'
    ];
    public $fixtures = [
        'events' => 'Event',
        'members' => 'Member',
        'roles' => 'Role',
        'member_roles' => 'MemberRole',
        'event_members'=>':event_members'
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
