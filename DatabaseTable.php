<?php
namespace LSPHP;

class DatabaseTable extends DatabaseConnection {

    public function __construct($host, $database, $user, $password, $table)
    {
        $this->host = $host;
        $this->database = $database;
        $this->user = $user;
        $this->passwd = $password;
        $this->table = $table;
    }

    public function getAll()
    {
        $query = "SELECT * FROM " . $this->table . ";";
        return $this->selectQuery($query);
    }

    public function getColumn($column)
    {
        return parent::getColumn($this->table, $column);
    }
}
