<?php

return [
    'project1'=>[
        'id'=>1,
        'name'=>'Test project',
        'description'=>'test project desc',
        'event_id'=>$this->getRecord('events','event1')['id'],
        'owner_id'=>$this->getRecord('members','member1')['id']
    ]
];
