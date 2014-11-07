<?php

/**
 * 
 *
 * @author Komov Roman
 */
class ProjectApiTest extends RESTfulApiTestCase
{

    public $modelName = 'Project';
    public $resourse = '/api/Project';
    public $data = [
        'name' => 'Tesla Motors',
        'description' => 'revolution in auto industry',
        'owner_id' => 1,
        'event_id' => 1
    ];
    public $filter = [
        'name' => 'tesla',
        'event_id' => 1
    ];
    public $fixtures = [
        'events' => 'Event',
        'members' => 'Member',
        'roles' => 'Role',
        'member_roles' => 'MemberRole',
        'projects' => 'Project',
        'projects_members' => ':projects_members'
    ];

    public function auth()
    {
        $login = 'Elon Mask';
        $this->members('member1')['full_name'];

        $r = $this->request([
            'url' => '/index.php/auth/FullNameLogin',
            'data' => [
                'fullname' => $login,
//                'password' => $password
            ]
        ]);
//        var_dump($r);
//        exit();
    }

}
