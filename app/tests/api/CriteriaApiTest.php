<?php

/**
 * 
 *
 * @author Komov Roman
 */
class CriteriaApiTest extends RESTfulApiTestCase
{

    public $modelName = 'Criteria';
    public $resourse = '/api/Criteria';
    public $data = [
        'name' => 'Coolness'
    ];
    public $fixtures = [
        'members' => 'Member',
        'roles' => 'Role',
        'member_roles' => 'MemberRole',
        'events' => 'Event',
        'projects' => 'Project',
        'projects_members' => ':projects_members',
        'criterias' => 'Criteria'
    ];

    public function auth()
    {
        $login = 'manager'; //$this->members('manager1')['login'];
        $password = 'password'; //$this->members('manager1')['password'];

        $r = $this->request([
            'url' => '/index.php/auth/login',
            'data' => [
                'login' => $login,
                'password' => $password
            ]
        ]);

        $response = $r['json'];
//        var_dump($r);
//        exit();
    }

}
