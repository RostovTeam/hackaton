<?php

/**
 * 
 *
 * @author Komov Roman
 */
class ProjectMemberApiTest extends RESTfulApiTestCase
{

    public $modelName = 'ProjectMember';
    public $resourse = '/api/Project/1/members';
    public $data = [
        'id' => 1
    ];
    public $fixtures = [
        'events'=>'Event',
        'members' => 'Member',
        'roles'=>'Role',
        'member_roles'=>'MemberRole',
        'projects' => 'Project',
        'projects_members' => ':projects_members'
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
        $login = $this->members('member1')['full_name'];
//        $password = 'password';

        $r = $this->request([
            'url' => '/index.php/auth/FullNameLogin',
            'data' => [
                'fullname' => $login,
//                'password' => $password
            ]
        ]);
    }

}
