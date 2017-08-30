<?php
    class Form {
        public static function showHeader(){
            ?>
            <!DOCTYPE html>
            <html>
            <head>
                <meta charset="UTF-8">
                <link rel="stylesheet" href="main.css">
                <title>LABS</title>
                <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
            </head>
            <body>
            <?php
        }
        
        public static function showFooter(){
            ?>
            </body>
            </html>
            <?php
        }
    }

    class MainForm extends Form{
        private static function showGroup(Group $group){
            echo "<p class='GroupName'>Список ".$group->getNum()." группы</p>";
            echo "<p class='FacultName'>".$group->getFacult()."</p>";
            echo "<p>Староста ".$group->getStarosta()."</p>";
            
            echo "<p><a href='index.php?action=editGroup'>Редактировать данные</a></p>";
        }
        
        private static function showFilter($filter = ""){
            echo "<p><form name='filter' action='".$_SERVER["PHP_SELF"]."' method='post'>";
            echo "Фильтр за фамилией: <input type='text' name='fio_filter' size='10' value='".$_POST["fio_filter"]."'>";
            echo "<input type='submit' value='Отфильтровать'>";
            echo "</form></p>";
        }
        
        private static function showStudents($students) {
            echo "<table border=1 class='main'>";
            echo "<tr class='head'><td>ФИО</td><td>Пол</td><td>Год рождения</td><td>Управление</td></tr>";
            
            foreach ($students as $CurStudent){
                $class_name="row";
                if($CurStudent->getSex() == "чол")
                    $class_name="row_man";
                if($CurStudent->getSex() == "жін")
                    $class_name="row_woman";
                echo "<tr class=".$class_name."><td align=left>".$CurStudent->getFio()."</td><td>".$CurStudent->getSex()."</td><td>".$CurStudent->getYear()."</td>
                <td><a href='index.php?action=editStudent&StudKod=".$CurStudent->getId()."'>Изменить</a> | <a href='index.php?action=deleteStudent&StudKod=".$CurStudent->getId()."'>Удалить</a></td></tr>";
            }
            echo "<tr class='row'><td colspan=4><a href='index.php?action=addStudent'>+</a></td></tr>";
            echo "</table>";  
        }
        
        public static function show(Group $group, $students, $filter = "") {
            self::showHeader();
            self::showGroup($group);
            self::showFilter($filter);
            self::showStudents($students);
            self::showFooter();
        }
    }

    class EditGroupForm extends Form {
        public static function show(Group $group) {
            
            self::showHeader();
            
            echo "<meta charset='UTF-8'>";
            
            echo "<p class='upper'>Редактирование ведомостей по группе</p>";
            echo "<form name='edit' action='index.php?action=editGroupCommit' method='post' class='EditForm'>";
            echo "<table border=0><tr><td>Группа</td>";
            echo "<td><input type='text', name='numb', size='5' value='".$group->getNum()."'></td></tr>";
            echo "<tr><td>Староста </td><td><input type='text' name='starosta' size='15' value='".$group->getStarosta()."'></td></tr>";
            echo "<tr><td>Факультет </td><td><input type='text' name='facult' size='30' value='".$group->getFacult()."'></td></tr>";
            echo "<tr><td colspan=2></td></tr>";
            echo "<tr><td colspan=2 align=right><input type='submit' class='add' value='Сохранить'></td></tr>";
            
            echo "</table>";
            echo "</form>";
            
            self::showFooter();
        }
    }

    class EditStudentForm extends Form {
        public static function show(Student $student){
            self::showHeader();
            
            if($student->getId()) {
                echo "<p class='upper'>редактирование ведомостей по студенту</p>";
            } else {
                echo "<p class='upper'>добавление нового студента</p>";
            }
            
            echo "<meta charset='UTF-8'>";
            
            echo "<form name='edit' action='index.php?action=editStudentCommit' method='post'>";
            echo "<input hidden='hidden' name='id' value='".$student->getId()."'>";
            echo "<table border=0><tr><td>ФИО</td>";
            echo "<td><input type='text', name='fio', size='25' value='".$student->getFio()."'></td></tr>";
            echo "<tr><td>Пол</td><td><input type='text' name='sex' size='5' value='".$student->getSex()."'></td></tr>";
            echo "<tr><td> Год рождения</td><td><input type='text' name='year' size='10' value='".$student->getYear()."'></td></tr>";
            echo "<tr><td colspan=2></td></tr>";
            echo "<tr><td colspan=2 align=right><input type='submit' class='add' value='Сохранить'></td></tr>";
            
            echo "</table>";
            echo "</form>";
            
            self::showFooter();
        }
    }
?>