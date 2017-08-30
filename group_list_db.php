<?php
    abstract class GroupList{
        public $dbms;
        protected $err;
        
        public function __construct(DBMS $db){
            $this->dbms = $db;
        }
        
        abstract function getGroup();
        abstract function editGroup($kod, $facult, $starosta);
        
        abstract function getStudent($id);
        abstract function addStudent($name, $sex, $year);
        abstract function editStudent($id, $name, $sex, $year);
        abstract function delStudent($id);
        
        abstract function getStudents($filter = "");
        
        public function getlastErr(){
            return $this->err;
        }
    }
    
    class MyGroupList extends GroupList{
        function getGroup(){
            if(!$res = $this->dbms->getArrFromQuery("SELECT kod, facult, starosta FROM groups")){
                $this->err = "Ошибка чтения группы " . $this->dbms->getlastErr();
            }
            return $res;
        }
        
        function getStudent($id){
            if(!$res = $this->dbms->getArrFromQuery("SELECT fio, sex, year FROM students where kod = " . $id)){
                $this->err = "Ошибка чтения студента" . $this->dbms->getlastErr();
            }
            return $res;
        }
        
        function getStudents($filter = ""){
            if(!$res = $this->dbms->getArrFromQuery("SELECT kod, fio, sex, year FROM students where fio like '%".$filter."%'")){
                $this->err = "Ошибка чтения студентов" . $this->dbms->getlastErr();
            }
            return $res;
        }
        
        function addStudent($name, $sex, $year){
            $sql = "select @kod:=ifnull(max(kod),0)+1 from students;";
            $this->dbms->runQuery($sql);
            $sql = "insert into students(kod, fio, sex, year)
                values(@kod, '".$name."', '".$sex."', ".$year.");";
            if(!$res = $this->dbms->runQuery($sql)){
                $this->err = "Ошибка добавления студента" . $this->dbms->getlastErr();
            }
            return $res;
        }
        
        function delStudent($id){
            $sql = "delete from students where kod = ".$id;
            if(!$res = $this->dbms->runQuery($sql)){
                $this->err = "Ошибка удаления студента" . $this->dbms->getlastErr();
            }
            return $res;
        }
        
        function editGroup($kod, $facult, $starosta){
            $sql = "update groups set kod='".$kod."', facult='".$facult."', starosta='".$starosta."'";
            if(!$res = $this->dbms->runQuery($sql)){
                $this->err = "Ошибка изменения группы" . $this->dbms->getlastErr();
            }
            return $res;
        }
        
        function editStudent($id, $name, $sex, $year){
            $sql = "update students set fio='".$name."', sex='".$sex."', year='".$year."' where kod=".$id;
            if(!$res = $this->dbms->runQuery($sql)){
                $this->err = "Ошибка изменения студента" . $this->dbms->getlastErr();
            }
            return $res;
        }
    }
    
    class DB{
        const MYSQLGROUPLIST = 1;
        const MYSQLGROUPLIST_PRO = 2;
        
        public static function get($dbType){
            if ($dbType == self::MYSQLGROUPLIST){
                return new MyGroupList(new MysqlDB());
            } elseif($dbType == self::MYSQLGROUPLIST_PRO){
                return new MyGroupListPro(new MysqlDB());
            }
            return null;
        }
    }

    class MyGroupListPro extends GroupList{
        function addStudent($name, $sex, $year) {
            $sql = "call add_student('".$name."', '".$sex."', ".$year.");";
            if(!$res = $this->dbms->runQuery($sql)) {
                $this->err = "Ошибка добавления студента ".$this->dbms->getLastErr();
            }
            return $res;
        }
        
        function delStudent($id) {
            $sql = "call del_student(".$id.")";
             if(!$res = $this->dbms->runQuery($sql)) {
                $this->err = "Ошибка удаления студента ".$this->dbms->getLastErr();
            }
            return $res;
        }
        
        function editStudent($id, $name, $sex, $year) {
            $sql = "call upd_student(".$id.", '".$name."', '".$sex."', ".$year.")";
             if(!$res = $this->dbms->runQuery($sql)) {
                $this->err = "Ошибка изменения студента ".$this->dbms->getLastErr();
            }
            return $res;
        }
        
        function editGroup($kod, $facult, $starosta) {
            $sql = "call upd_group('".$kod."', '".$facult."', '".$starosta."')";
             if(!$res = $this->dbms->runQuery($sql)) {
                $this->err = "Ошибка изменения группы ".$this->dbms->getLastErr();
            }
            return $res;
        }
        
        function getGroup(){
            if(!$res = $this->dbms->getArrFromQuery("SELECT kod, facult, starosta FROM groups")){
                $this->err = "Ошибка чтения группы " . $this->dbms->getlastErr();
            }
            return $res;
        }
        
        function getStudent($id){
            if(!$res = $this->dbms->getArrFromQuery("SELECT fio, sex, year FROM students where kod = " . $id)){
                $this->err = "Ошибка чтения студента" . $this->dbms->getlastErr();
            }
            return $res;
        }
        
        function getStudents($filter = ""){
            if(!$res = $this->dbms->getArrFromQuery("SELECT kod, fio, sex, year FROM students where fio like '%".$filter."%'")){
                $this->err = "Ошибка чтения студентов" . $this->dbms->getlastErr();
            }
            return $res;
        }
    }
?>