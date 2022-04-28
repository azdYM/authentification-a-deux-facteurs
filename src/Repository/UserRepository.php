<?php

namespace App\Repository;

use Framework\Database\MySql;
use Framework\Repository\Repository;

class UserRepository extends Repository
{
    public function __construct(MySql $db)
    {
        parent::__construct();
        $this->db = $db;
    }




}