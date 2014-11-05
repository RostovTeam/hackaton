<?php

/**
 * 
 *
 * @author Komov Roman
 */
class CriteriaValueApiTest extends RESTfulApiTestCase
{

    public $modelName = 'CriteriaValue';
    public $resourse = '/api/CriteriaValue';
    public $data = [
        'criteria_id' => '1',
        'value' => '1',
        'label' => 'test'
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
