<?php
    class Controller {
        public static function handleAction($action) {
            $db = DB::get(DB::MYSQLGROUPLIST);
            //$db = DB::get(DB::MYSQLGROUPLIST_PRO);
            $db->dbms->connect();
            if($action == "editGroup") {
                $group = new Group();
                $group->readFromDB($db);
                EditGroupForm::show($group);
            } elseif($action == "editGroupCommit") {
                $group = new Group();
                $group->setNum($_POST["numb"]);
                $group->setStarosta($_POST["starosta"]);
                $group->setFacult($_POST["facult"]);
                $group->writeToDB($db);
                
                header("Location: index.php");
            } elseif($action == "addStudent") {
                $student = new Student();
                $student->setId(0);
                EditStudentForm::show($student);
            } elseif ($action == "editStudent") {
                $student = new Student();
                $student->setId($_GET['StudKod']);
                $student->readFromDB($db);
                EditStudentForm::show($student);
            } elseif($action == "editStudentCommit"){
                $student = new Student();
                $student->setId($_POST['id']);
                $student->setFio($_POST['fio']);
                $student->setSex($_POST['sex']);
                $student->setYear($_POST['year']);
                $student->writeToDB($db);
                
                header("Location: index.php");
            } elseif($action == "deleteStudent"){
                $student = new Student();
                $student->setId($_GET['StudKod']);
                $student->deleteFromDB($db);
                
                header("Location: index.php");
            } else {
                $group = new Group();
                $group->readFromDB($db);
                $filter = $_POST["fio_filter"];
                $students = Student::readStudListFromDB($db, $filter);
                MainForm::show($group, $students, $filter);
            }
        }
    }
?>