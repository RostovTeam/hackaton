<?php

require_once(__DIR__ . '/../GitHubObject.php');

	

class GitHubCommitCommitCommitter extends GitHubObject
{
	/* (non-PHPdoc)
	 * @see GitHubObject::getAttributes()
	 */
	protected function getAttributes()
	{
		return array_merge(parent::getAttributes(), array(
                    'date'
		));
	}
        
        protected $date;
        
        public function getDate()
        {
            return $date;
        }
	
}

