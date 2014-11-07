<?php

/**
 * 
 *
 * @author Komov Roman
 */
class ExpertEventsApiTest extends RESTfulApiTestCase
{

    public $modelName = 'ExpertEvent';
    public $resourse = '/api/Expert/Events';
    public $data = [
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

    public function testApi()
    {
        $this->auth();

        //list relations
        $this->_list();
    }

    public function auth()
    {
        $login = $this->members('expert1')['phone'];
//        $password = 'password';

        $r = $this->request([
            'url' => '/index.php/auth/ExpertLogin',
            'data' => [
                'phone' => $login,
//                'password' => $password
            ]
        ]);
        
//        var_dump($r);
//        exit();
    }

}
