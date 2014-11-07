<?php

/**
 * 
 *
 * @author Komov Roman
 */
class ProjectCriteriaController extends RESTfulApiTestCase
{

    public $modelName = 'ProjectCriteria';
    public $resourse = '/api/ProjectCriteria';
    public $data = [
        'project_id' => 1,
        'criteria_id' => 1,
        'value' => 100
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

        $data = $this->_create();
        $this->_update($data['id']);

        $this->authMember();                
        $this->_list();
        $this->_view($data['id']);
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
    }

    public function authMember()
    {
        $login = $this->members('member1')['full_name'];

        $r = $this->request([
            'url' => '/index.php/auth/FullNameLogin',
            'data' => [
                'fullname' => $login,
//                'password' => $password
            ]
        ]);
    }

}
