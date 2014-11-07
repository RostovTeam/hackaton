<?php

/**
 * 
 *
 * @author Komov Roman
 */
class MemberEventApiTest extends RESTfulApiTestCase
{

    public $modelName = 'MemberEvent';
    public $resourse = '/api/Member/Events';
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
       $login = $this->members('member1')['full_name'];
        $phone = $this->members('member1')['phone'];

        $r = $this->request([
            'url' => '/index.php/auth/FullNameLogin',
            'data' => [
                'fullname' => $login,
                'phone' => $phone
            ]
        ]);
    }

}
