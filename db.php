<?php
    abstract class db_config{
        const SERVER = "localhost";
        const USER = "root";
        const PASSWORD = "";
        const DB = "group_list";
    }
    
    abstract class DBMS {
        protected $server;
        protected $user;
        protected $password;
        protected $db;
        
        protected $link;
        protected $err;
        
        public function __construct(){
            $this->server = db_config::SERVER;
            $this->user = db_config::USER;
            $this->password = db_config::PASSWORD;
            $this->db = db_config::DB;
        }
        
        public abstract function connect();
        public abstract function disconnect();
        public abstract function runQuery($sql);
        public abstract function getArrFromQuery($sql);
        public function getLastErr(){
            return $this->err;
        }
    }
    
    class MysqlDB extends DBMS {
        public function connect() {
            $this->link = mysqli_connect ($this->server, $this->user, $this->password, $this->db);
            if(!$this->link){
                return false;    
            }
            $this->runQuery("SET NAMES 'utf-8'");
            return true;
        }
        
        public function disconnect(){
            mysqli_close($this->link);
            unset($this->link);
        }
        
        public function runQuery($sql){
            $res = mysqli_query($this->link, $sql);
            if(!$res){
                $this->err = mysqli_error($this->link);
            }
            return $res;
        }
        
        public function getArrFromQuery($sql){
            $res_arr = array();
            $rs = $this->runQuery($sql);
            while($row = mysqli_fetch_assoc($rs)) {
                $res_arr[] = $row;
            }
            return $res_arr;
        }
    }
?>