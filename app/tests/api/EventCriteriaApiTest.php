<?php

/**
 * 
 *
 * @author Komov Roman
 */
class EventCriteriaApiTest extends RESTfulApiTestCase
{

    public $modelName = 'EventCriteria';
    public $resourse = '/api/Event/1/criterias';
    public $data = [
        'id' => 1
    ];
    public $fixtures = [
        'events' => 'Event',
        'members' => 'Member',
        'roles' => 'Role',
        'member_roles' => 'MemberRole',
        'projects' => 'Project',
        'projects_members' => ':projects_members',
        'criterias'=>'Criteria'
    ];

    public function testApi()
    {
        $this->auth();

        //add m:n relation
        $this->_update(1);

        //list relations
        $this->_list();

        //drop relation
        $this->_delete(1);
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
