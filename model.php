<?php
class Student {
	private $id;
	private $fio;
	private $sex;
	private $year;
	
	public function getId(){return $this->id;}
	public function getFio(){return $this->fio;}
	public function getYear(){return $this->year;}
	public function getSex(){return $this->sex;}
	
	public function setId($id){$this->id = $id;}
	public function setFio($fio){$this->fio = $fio;}
	public function setYear($year){$this->year = $year;}
	public function setSex($sex){$this->sex = $sex;}
	
	public function readFromDB(GroupList $db){
		$stud = $db->getStudent($this->id);
		if(!$stud){
			echo $db->getLastErr();
		}else{
			$this->setFio($stud[0]['fio']);
			$this->setSex($stud[0]['sex']);
			$this->setYear($stud[0]['year']);
		}
	}
	
	public function writeToDB(GroupList $db){
		if($this->id){
			$res = $db->editStudent($this->getId(), $this->getFio(), 
			$this->getSex(), $this->getYear());
		}else{
			$res = $db->addStudent($this->getFio(), $this->getSex(), $this->getYear());
		}
		if(!$res){
			echo $db->getLastErr();
		}
	}
	
	public function deleteFromDB(GroupList $db){
		$res = $db->delStudent($this->getId());
		if(!$res){
			echo $db->getLastErr();
		}
	}
	
	public static function readStudListFromDB(GroupList $db, $filter){
		$list = $db->getStudents($filter);
		if(!$list){
			echo $db->getLastErr();
			return false;
		}else{
			$StudArr = array();
			foreach($list as $row){
				$stud = new Student();
				$stud->setId($row['kod']);
				$stud->setFio($row['fio']);
				$stud->setSex($row['sex']);
				$stud->setYear($row['year']);
				
				$StudArr[] = $stud;
			}
			return $StudArr;
		}
	}
}

class Group {
	
	private $num;
	private $facult;
	private $starosta;
	
	public function getNum(){return $this->num;}
	public function getFacult(){return $this->facult;}
	public function getStarosta(){return $this->starosta;}
	
	public function setNum($num){$this->num = $num;}
	public function setFacult($facult){$this->facult = $facult;}
	public function setStarosta($starosta){$this->starosta = $starosta;}
		
	public function readFromDB(GroupList $db){
		$grp = $db->getGroup($this->id);
		if(!$grp){echo $db->getLastErr();}
		else{
			$this->setNum($grp[0]['kod']);
			$this->setFacult($grp[0]['facult']);
			$this->setStarosta($grp[0]['starosta']);
		}
	}
	
	public function writeToDB(GroupList $db){
		$res = $db->editGroup($this->getNum(), $this->getFacult(), $this->getStarosta());
	}
}
?>