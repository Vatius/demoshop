<?php
//в целом, надо бы бд хелпер...

namespace app\core;

use PDO;

class BaseModel {

    public $dbh;

    public $table = '';

    public $data = [];

    public function __construct() {
        //так не очень хорошо делать :)
        include (APP_DIR.DS.'config.php');
        try {
            $this->dbh = new PDO($config['db'], $config['db_user'], $config['db_pass']);
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
    }

    public function getAll() {
        $stmt = $this->dbh->prepare('SELECT * FROM '.$this->table);
        $stmt->execute();
        $this->data = $stmt->fetchAll();
    }

    public function getOne($where = []) {
        $wh = '';
        foreach($where as $row => $val) {
            $wh .= $row . ' = ? ';
        }
        $stmt = $this->dbh->prepare('SELECT * FROM '.$this->table.' WHERE '.$wh);
        foreach($where as $row => $val) {
            $stmt->execute([$val]);
        }
        $this->data = $stmt->fetch(PDO::FETCH_LAZY);
    }

    public function insert($data = []) {
        $sql = 'INSERT INTO '.$this->table. ' (';
        $sql .= implode(', ', array_keys($data));
        $sql .= ') VALUES (';
        $vk = Array();
        foreach($data as $key => $val) {
            $vk[] = ':'.$key;
        }
        $sql .= implode(', ',$vk);
        $sql .= ')';
        $stmt= $this->dbh->prepare($sql);
        $stmt->execute($data);
        return $this->dbh->lastInsertId(); 
    }

    public function update($where = [], $set = []) {
        //some here
    }

    public function delete($where =[]) {
        $wh = '';
        foreach($where as $row => $val) {
            $wh .= $row . ' = ? ';
        }
        $stmt = $this->dbh->prepare('DELETE FROM '.$this->table . ' WHERE ' . $wh);
        foreach($where as $row => $val) {
            $stmt->execute([$val]);
        }
    }

}