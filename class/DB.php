<?php

class DB{
    // Properti untuk koneksi ke database Mysql
    private $_host = '127.0.0.1';
    private $_dbname = 'ilkom';
    private $_username = 'root';
    private $_password = '';

    // Properti internal dari class DB
    private static $_instance = null;
    private $_columnName = "*";
    private $_orderBy = '';
    private $_count = 0;
    private $_pdo;

    // Contructor untuk pembuatan PDO Object
    private function __construct(){
        try {
            $this->_pdo = new PDO('mysql:host='.$this->_host.';dbname='.$this->_dbname,$this->_username, $this->_password);
            $this->_pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("KOneksi / Query bermasalah: ".$e->getMessage(). " (".$e->getCode().")");
        }
    }

    // Singleton pattern untuk membuat class DB
    public static function getInstance(){
        if (!isset(self::$_instance)) {
            self::$_instance = new DB();
        }
        return self::$_instance;
    }

    public function runQuery($query, $bindValue = []){
        try {
            $stmt = $this->_pdo->prepare($query);
            $stmt->execute($bindValue);
        } catch (PDOException $e) {
            die("KOneksi / Query bermasalah: ".$e->getMessage(). " (".$e->getCode().")");
        }
        return $stmt;
    }

    public function getQuery($query, $bindValue = []){
        return $this->runQuery($query, $bindValue)->fetchAll(PDO::FETCH_OBJ);
    }

    public function get($tableName, $condition = '', $bindValue = []){
        $query = "SELECT {$this->_columnName} FROM {$tableName} {$condition} {$this->_orderBy}";
        // reset ulang agar tidak tertimpa nilai sebelumnya
        $this->_columnName = "*";
        $this->_orderBy = '';
        return $this->getQuery($query, $bindValue);
    }
   
    public function select($columnName){
        $this->_columnName = $columnName;
        return $this;
    }

    public function orderBy($columnName, $sortType = 'ASC'){
        $this->_orderBy = "ORDER BY {$columnName} {$sortType}";
        return $this;
    }

    public function getWhere($tableName, $condition){
        $queryCondition = "WHERE {$condition[0]} {$condition[1]} ? ";
        return $this->get($tableName, $queryCondition, [$condition[2]]);
    }

    public function getWhereOnce($tableName, $condition){
        $result = $this->getWhere($tableName, $condition);
        if (!empty($result)) {
            return $result[0];
        } else {
            return false;
        }
    }

    public function getLike($tableName, $columnLike, $search){
        $queryLike = "WHERE {$columnLike} LIKE ? ";
        return $this->get($tableName, $queryLike,[$search]);
    }

    public function check($tableName, $columnName, $dataValues){
        $query = "SELECT {$columnName} FROM {$tableName} WHERE {$columnName} = ?";
        return $this->runQuery($query,[$dataValues])->rowCount();
    }

    public function insert($tableName, $data){
        $dataKeys = array_keys($data);
        $dataValues = array_values($data);
        $placeholder = '('.str_repeat('?,', count($data)-1) . '?)';
    
        $query = "INSERT INTO {$tableName} (".implode(', ',$dataKeys).") VALUES {$placeholder}";
    
        $this->_count = $this->runQuery($query, $dataValues)->rowCount();
        return true;
    }

    public function count(){
        return $this->_count;
    }

    function update($tableName, $data, $condition){
        $query = "UPDATE {$tableName} SET ";
        foreach ($data as $key => $val ) {
            $query .= "$key = ?, " ;
        }
        $query = substr($query,0,-2);
        $query .= " WHERE {$condition[0]} {$condition[1]} ?";
        
        $dataValues = array_values($data);
        array_push($dataValues, $condition[2]);
    
        $this->_count = $this->runQuery($query, $dataValues)->rowCount();
        return true;
    }

    public function delete($tableName, $condition){
        $query = "DELETE FROM {$tableName} WHERE {$condition[0]} {$condition[1]} ? ";
        $this->_count = $this->runQuery($query,[$condition[2]])->rowCount();
        return true;
    }

    public function createTable($tableName, $field){
        $query = "DROP TABLE IF EXISTS {$tableName}";
        $this->runQuery($query);

        $query = "CREATE TABLE {$tableName} (";
        foreach ($field as $key => $value) {
            $query .= "$value, ";
        }
        $query = substr($query, 0, -2) . ")";
        $this->runQuery($query);
        return true;
       
    }

    public function dropTable($tableName){
        $query = "DROP TABLE IF EXISTS {$tableName}";
        $this->runQuery($query);
        return true;
    }

}

 // method get lain
    // public function get($tableName,$bindValue = []){ 
    //     $query = "SELECT * FROM {$tableName}"; 
    //     try { 
    //         $stmt = $this->_pdo->prepare($query); 
    //         $stmt->execute($bindValue); 
    //         } 
    //         catch (PDOException $e){ 
    //             die("Koneksi / Query bermasalah: ".$e->getMessage(). 
    //                 " (".$e->getCode().")");
    //     } 
    //     return $stmt->fetchAll(PDO::FETCH_OBJ); 
    // } 