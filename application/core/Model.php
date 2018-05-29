<?php
namespace application\core;

use application\lib\Db;

abstract class Model
{
    public $db;

    /**
     * Model constructor.
     */
    public function __construct()
    {
        $this->db = new Db;
    }
}