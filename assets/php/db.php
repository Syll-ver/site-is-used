<?php

	class Database{
		private $dsn = "mysql:host=localhost;dbname=projmonitoring";
		private $user = "root";
		private $pass = "";
		public $conn;

		public function __construct(){
			try{
				$this->conn = new PDO($this->dsn, $this->user, $this->pass);
			}
			catch(PDOException $e){
				echo $e->getMessage();
			}
		}

		public function countproj(){
			$sql = 'SELECT projname, deptname, status FROM projects
						JOIN department using (deptno)';
			$stmt = $this->conn->prepare($sql);
			$stmt->execute();
			$total = $stmt->rowCount();
			return $total;
		}

		public function viewproj(){
			$data = array();
			$sql = 'SELECT projno, projname, deptname, status FROM projects
						JOIN department using (deptno)';
			$stmt = $this->conn->prepare($sql);
			$stmt->execute();
			$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
			foreach ($result as $row){
				$data[] = $row;
			}
			return $data;
		}

		public function newproj($no,$name,$dept,$stat){
			$sql = 'INSERT INTO projects(projno, projname, deptno, status) VALUES(:no, :name, :dept, :stat)';
			$stmt = $this->conn->prepare($sql);
			$stmt->execute([':no'=>$no,':name'=>$name,':dept'=>$dept,'stat'=>$stat]);
		
			return true;
		}

		public function newemp($fname,$lname,$mint,$ssn,$gender,$bdate,$salary,$address,$dept,$empsuper,$depname,$depgender,$depbday,$relationship){
			$sql = 'INSERT INTO employee(fname, lname, mint, ssn, sex, bdate, salary, address, deptno, superssn) VALUES(:fname, :lname, :mint, :ssn, :sex, :bdate, :salary, :address, :deptno, :superssn)';
			$stmt = $this->conn->prepare($sql);
			$stmt->execute([':fname'=>$fname,':lname'=>$lname,':mint'=>$mint,'ssn'=>$ssn,':sex'=>$gender,':bdate'=>$bdate,':salary'=>$salary,':address'=>$address,':deptno'=>$dept,':superssn'=>$empsuper]);

				$sql2 = 'INSERT INTO dependents(ssn, dname, dbdate, gender, relationship) VALUES(:ssn, :dname, :bdate, :sex, :relationship)';
				$stmt2 = $this->conn->prepare($sql2);
				$stmt2->execute([':ssn'=>$ssn,':dname'=>$depname,':bdate'=>$depbday,':sex'=>$depgender,':relationship'=>$relationship]);

			return true;
		}

		public function newdept($deptno,$deptname){
			$sql = 'INSERT INTO department(deptno, deptname) VALUES(:deptno, :deptname)';
			$stmt = $this->conn->prepare($sql);
			$stmt->execute([':deptno'=>$deptno,':deptname'=>$deptname]);
		
			return true;
		}

		public function viewempbyproj($projname){
			$data = array();
			$sql = 'SELECT projname, deptname, concat(fname, " ", mint, " ", lname) AS name, count(dateworked) AS weeks, GROUP_CONCAT(dateworked) AS date_worked, sum(hoursworked) AS hours_worked FROM employee
						join department using (deptno)
						join workson using (ssn)
						join projects using (projno)
						where projname = :projname 
						GROUP BY `employee`.`ssn`';
			$stmt = $this->conn->prepare($sql);
			$stmt->execute([':projname'=>$projname]);
			$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
			foreach ($result as $row){
				$data[] = $row;
			}
			return $data;
		}

		public function countempbyproj($projname){
			$sql = 'SELECT projname, deptname, concat(fname, " ", mint, " ", lname) AS name, count(dateworked) AS weeks, GROUP_CONCAT(dateworked) AS date_worked, sum(hoursworked) AS hours_worked FROM employee
						join department using (deptno)
						join workson using (ssn)
						join projects using (projno)
						where projname = :projname 
						GROUP BY employee.ssn';
			$stmt = $this->conn->prepare($sql);
			$stmt->execute([':projname'=>$projname]);
			$total = $stmt->rowCount();
			return $total;
		}

		public function viewempproj($ssn){
			$data = array();
			$sql = 'SELECT DISTINCT projname, status FROM projects
						JOIN workson using (projno)
						JOIN employee using (ssn)
						where ssn = :ssn';
			$stmt = $this->conn->prepare($sql);
			$stmt->execute([':ssn'=>$ssn]);
			$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
			foreach ($result as $row){
				$data[] = $row;
			}
			return $data;
		}

		public function countempproj($ssn){
			$sql = 'SELECT DISTINCT projname, status FROM projects
						JOIN workson using (projno)
						JOIN employee using (ssn)
						where ssn = :ssn';
			$stmt = $this->conn->prepare($sql);
			$stmt->execute([':ssn'=>$ssn]);
			$total = $stmt->rowCount();
			return $total;
		}

		public function viewdependant($ssn){
			$data = array();
			$sql = 'SELECT * FROM dependents where ssn = :ssn';
			$stmt = $this->conn->prepare($sql);
			$stmt->execute([':ssn'=>$ssn]);
			$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
			foreach ($result as $row){
				$data[] = $row;
			}
			return $data;
		}

		public function countdependant($ssn){
			$sql = 'SELECT * FROM dependents where ssn = :ssn';
			$stmt = $this->conn->prepare($sql);
			$stmt->execute([':ssn'=>$ssn]);
			$total = $stmt->rowCount();
			return $total;
		}

		public function getemployee($ssn){
			$data = array();
			$sql = 'SELECT * FROM employee LEFT JOIN dependents USING (ssn) WHERE ssn = :ssn';
			$stmt = $this->conn->prepare($sql);
			$stmt->execute([':ssn'=>$ssn]);
			$result = $stmt->fetch(PDO::FETCH_OBJ);
			return $result;
		}


		public function countemp(){
			$sql = 'SELECT * FROM employee';
			$stmt = $this->conn->prepare($sql);
			$stmt->execute();
			$total = $stmt->rowCount();
			return $total;
		}

		public function viewemp(){
			$data = array();
			$sql = 'SELECT ssn, CONCAT(fname, " ", mint, " ", lname) AS name, sex, salary, address, bdate, deptname, superssn FROM employee
						JOIN department using(deptno)
						ORDER BY lname';
			$stmt = $this->conn->prepare($sql);
			$stmt->execute();
			$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
			foreach ($result as $row){
				$data[] = $row;
			}
			return $data;
		}

		public function countdept(){
			$sql = 'SELECT * FROM department';
			$stmt = $this->conn->prepare($sql);
			$stmt->execute();
			$total = $stmt->rowCount();
			return $total;
		}

		public function getsupervisor($ssn){
			$data = array();
			$sql = 'SELECT CONCAT(fname, " ", mint, " ", lname) as name FROM employee WHERE ssn = (SELECT superssn FROM employee WHERE ssn = :ssn) ';
			$stmt = $this->conn->prepare($sql);
			$stmt->execute([':ssn'=>$ssn]);
			$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
			foreach ($result as $row){
				$data[] = $row;
			}
			return $data;
		}

		public function countgetsupervisor($ssn){
			$data = array();
			$sql = 'SELECT ssn, CONCAT(fname, " ", mint, " ", lname) as name FROM employee where ssn = :ssn';
			$stmt = $this->conn->prepare($sql);
			$stmt->execute([':ssn'=>$ssn]);
			$total = $stmt->rowCount();
			return $total;
		}

		public function viewsupervisor(){
			$data = array();
			$sql = 'SELECT ssn, CONCAT(fname, " ", mint, " ", lname) as name FROM employee';
			$stmt = $this->conn->prepare($sql);
			$stmt->execute();
			$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
			foreach ($result as $row){
				$data[] = $row;
			}
			return $data;
		}

		public function countsupervisor(){
			$data = array();
			$sql = 'SELECT ssn, CONCAT(fname, " ", mint, " ", lname) as name FROM employee';
			$stmt = $this->conn->prepare($sql);
			$stmt->execute();
			$total = $stmt->rowCount();
			return $total;
		}

		public function viewdept(){
			$data = array();
			$sql = 'SELECT * FROM department';
			$stmt = $this->conn->prepare($sql);
			$stmt->execute();
			$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
			foreach ($result as $row){
				$data[] = $row;
			}
			return $data;
		}

		public function updateemp($ssn,$lname,$fname,$mint,$gender,$salary,$address,$bdate,$dept,$empsuper,$depname,$depgender,$depbday,$relationship, $oldssn){
			$sql = 'UPDATE employee set ssn = :ssn, lname = :lname, fname = :fname, mint = :mint, sex = :sex, salary = :salary, address = :address, bdate = :bdate, deptno = :deptno, superssn = :superssn WHERE ssn = :oldssn';
			$stmt = $this->conn->prepare($sql);
			$stmt->execute(['ssn'=>$ssn,':lname'=>$lname,':fname'=>$fname,':mint'=>$mint,':sex'=>$gender,':salary'=>$salary,':address'=>$address,':bdate'=>$bdate,':deptno'=>$dept,':superssn'=>$empsuper,':oldssn'=>$oldssn]);

				// if($depname != ''){
					$sql2 = 'UPDATE dependents set dname = :dname, dbdate = :dbdate, gender = :gender, relationship = :relationship WHERE ssn = :oldssn';
					$stmt2 = $this->conn->prepare($sql2);
					$stmt2->execute([':dname'=>$depname,':dbdate'=>$depbday,':gender'=>$depgender,':relationship'=>$relationship,':oldssn'=>$oldssn]);
				//}

			//return $stmt;//$ssn,$lname,$fname,$mint,$gender,$salary,$address,$bdate,$dept,$empsuper,$depname,$depgender,$depbday,$relationship, $oldssn;
					return true;
		}

		public function updatedept($deptno, $deptname, $oldno){
			$sql = 'UPDATE department set deptno = :deptno, deptname = :deptname WHERE deptno = :oldno';
			$stmt = $this->conn->prepare($sql);
			$stmt->execute([':deptno'=>$deptno, ':deptname'=>$deptname, ':oldno'=>$oldno]);
			return true;
		}

		public function updateproj($prno, $prname, $dept, $stat, $oldno){
			$sql = 'UPDATE projects set projno = :projno, projname = :projname, deptno = :deptno, status = :stat WHERE projno = :oldno';
			$stmt = $this->conn->prepare($sql);
			$stmt->execute([':projno'=>$prno,':projname'=>$prname,':deptno'=>$dept,':stat'=>$stat,':oldno'=>$oldno]);
			return true;
		}

		public function deldept($deptno){
			$sql = 'DELETE FROM department WHERE deptno = :deptno';
			$stmt = $this->conn->prepare($sql);
			$stmt->execute([':deptno'=>$deptno]);
				return true;
		}

		public function delemp($ssn){
			$sql = 'DELETE FROM employee WHERE ssn = :ssn';
			$stmt = $this->conn->prepare($sql);
			$stmt->execute([':ssn'=>$ssn]);
			return true;
		}

		public function delproj($projno){
			$sql = 'DELETE FROM projects WHERE projno = :projno';
			$stmt = $this->conn->prepare($sql);
			$stmt->execute([':projno'=>$projno]);
				return true;
		}


	}

	// $a = new Database();
	// $b = $a->updateemp('Annie','Leonhart','','2049','f','1995/07/26','11300','Wall Sina','1','2003','Krosho','m','1981/01/01','Brother','2049');
	// print_r($b);

?>