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
        'criteria_id'=>1,
        'value'=>100
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

        //add m:n relation
        $this->_update(1);

        //list relations
        $this->_list();

        //drop relation
        $this->_delete(1);
    }

    public function auth()
    {
        $login = $this->members( 'expert1')['phone'];
//        $password = 'password';

        $r = $this->request([
            'url' => '/index.php/auth/ExpertLogin',
            'data' => [
                'fullname' => $login,
//                'password' => $password
            ]
        ]);
    }

}
