<?php

require_once(__DIR__ . '/libs/client/GitHubClient.php');

class GitHubConnector
{

    public $user;
    public $repo;

    public function __construct($url)
    {
        $user_arr = explode('github.com/', $url);
        $array_param = explode('/', $user_arr[1]);
        $this->user = $array_param[0];
        $this->repo = $array_param[1];
    }

    public function getCommits()
    {

        $client = new GitHubClient();
        $commits = $client
                ->repos
                ->commits
                ->listCommitsOnRepository($this->user,$this->repo);

        return $commits;
    }
    
    public function getLines()
    {
       
    }

}
