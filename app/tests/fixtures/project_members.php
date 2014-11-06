<?php

return [
    'r1' => [
        'member_id' => $this->getRecord('members', 'member1')['id'],
        'project_id' => $this->getRecord('projects', 'project1')['id'],
    ],
    'r2' => [
        'member_id' => $this->getRecord('members', 'expert1')['id'],
        'project_id' => $this->getRecord('projects', 'project1')['id'],
    ]
];
