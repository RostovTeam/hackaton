<?php

return [
    'member1' => [
        'id'=>1,
        'full_name' => 'Elon Mask',
        'phone' => '79054447777',
        'type'=>'member',
        'active_event'=>$this->getRecord('events', 'event1')['id']
    ],
    'expert1' => [
        'id'=>2,
        'full_name' => 'Elon Mask 1',
        'phone' => '79054447777',
        'type'=>'expert',
        'active_event'=>$this->getRecord('events', 'event1')['id']
    ],
    'manager1' => [
        'id'=>3,
        'full_name' => 'Elon Mask 2',
        'phone' => '79054447777',
        'type'=>'manager',
        'login'=>'manager',
        'password'=>'password',
        'active_event'=>$this->getRecord('events', 'event1')['id']
    ]
    
];
