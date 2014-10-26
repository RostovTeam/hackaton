<?php

/**
 * 
 *
 * @author Komov Roman
 */
class EventMemberApiTest extends RESTfulApiTestCase
{

    public $modelName = 'EventMember';
    public $resourse = '/api/Event/1/members';
    public $data = [
        'id'=>1
    ];
    public $fixtures = [
        'members' => 'Member',
        'events' => 'Event',
        'projects' => 'Project',
        'projects_members'=>':projects_members'
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
}