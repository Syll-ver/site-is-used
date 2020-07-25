<?php

require_once 'db.php';
$db = new Database();


if(isset($_POST['action']) && $_POST['action'] == "viewproj"){
	$output = '';
	$data = $db->viewproj();
	if($db->countproj()>0){
		$output .= '<table class="table table-data table-striped table-hover" >
              <thead>
                  <tr>
                    <th>Project Name</th>
                    <th>Project Department</th>
                    <th>Status</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>';
    	foreach ($data as $row){
    		$output .= '<tr>';
    		if($row['status'] == 1){
    			$output .= '<td>'.$row['projname'].'</td>
		    		<td>'.$row['deptname'].'</td>
		    		<td>Finished</td>
		    		<td align="right">
		    			<button type="button" class="btn btn-success viewBtn" id="'.implode("=",$row).'" data-toggle="modal" data-target="#form" style="font-size: .60em;"><i class="fas fa-info"></i></button>
		    			<button type="button" class="btn btn-success editproj" id="'.implode("=",$row).'" data-toggle="modal" data-target="#upd_proj" style="font-size: .60em;"><i class="fas fa-edit"></i></button>

		    			<a class="btn btn-success del_proj" title="delete" id="'.implode("=",$row).'" style="font-size: .60em;"><i class="fas fa-trash-alt"></i></a>
		    		</td>';
    		} else {
    			$output .= '<td>'.$row['projname'].'</td>
		    		<td>'.$row['deptname'].'</td>
		    		<td>Ongoing</td>
		    		<td align="right">
		    			<button type="button" class="btn btn-success viewBtn" id="'.implode("=",$row).'" data-toggle="modal" data-target="#form" style="font-size: .60em;"><i class="fas fa-info"></i></button>
		    			<button type="button" class="btn btn-success editproj" id="'.implode("=",$row).'" data-toggle="modal" data-target="#upd_proj" style="font-size: .60em;"><i class="fas fa-edit"></i></button>

		    			<a class="btn btn-success del_proj" title="delete" id="'.implode("=",$row).'" style="font-size: .60em;"><i class="fas fa-trash-alt"></i></a>
		    		</td>';
    		}
    		
    		
    	}
    	$output .= '</tbody></table>';
    	echo $output;
	} else {
		echo '<h3 class="text-center text-secondary mt-5>No record in Course."';
	}
}

if(isset($_POST['action']) && $_POST['action'] == "newproject"){
    $no = $_POST['prno'];
    $name = $_POST['prname'];
    $dept = $_POST['deptdown'];
    $stat = $_POST['stat'];

    $result = $db->newproj($no,$name,$dept,$stat);
    echo json_encode($result);
    //print $db;
}

if(isset($_POST['action']) && $_POST['action'] == "newemployee"){
    $fname = $_POST['fname'];
	$lname = $_POST["lname"];
	$mint = $_POST["mint"];
	$ssn = $_POST["ssn"];
	$gender = $_POST["gender"];
	$bdate = $_POST["bday"];
	$salary = $_POST["salary"];
	$address = $_POST["address"];
	$empdept = $_POST["empdept"];
	$empsuper = $_POST["empsuper"];
	$depname = $_POST["depname"];
	$depgender = $_POST["depgender"];
	$depbdate = $_POST["depbdate"];
	$relationship = $_POST["relationship"];

    $result = $db->newemp($fname,$lname,$mint,$ssn,$gender,$bdate,$salary,$address,$empdept,$empsuper,$depname,$depgender,$depbdate,$relationship);
    echo json_encode($result);
    //print $db;
}

if(isset($_POST['action']) && $_POST['action'] == "newdepartment"){
    $deptno = $_POST['deptno'];
    $deptname = $_POST['deptname'];

    $result = $db->newdept($deptno,$deptname);
    echo json_encode($result);
    //print $db;
}

if(isset($_POST['action']) && $_POST['action'] == "viewemp"){
	$output = '';
	$data = $db->viewemp();
	$gender = '';
	if($db->countemp()>0){
		$output .= '<table class="table table-data table-striped table-hover" id="emptable">
              <thead>
                  <tr>
                    <th>SSN</th>
                    <th>Name</th>
                    <th>Gender</th>
                    <th>Birthdate</th>
                    <th>Salary</th>
                    <th>Address</th>
                    <th>Department</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>';
    	foreach ($data as $row){

    		$output .= '<tr>
    		<td>'.$row['ssn'].'</td>
    		<td>'.$row['name'].'</td>';
    		if($row['sex'] == 'f'){
    			$gender = 'Female';
    		} else if($row['sex'] == 'm'){
    			$gender = 'Male';
    		} else {
    			$gender = 'Other';
    		}
    		$output .= '<td>'.$gender.'</td>
    		<td>'.date('F j, Y', strtotime($row['bdate'])).'</td>
    		<td>PHP'.$row['salary'].'</td>
    		<td>'.$row['address'].'</td>
    		<td>'.$row['deptname'].'</td>
    		<td class="btn-toolbar" role="toolbar">
    			<button type="button" class="btn btn-success mr-1 view_empproj" id="'.implode("=",$row).'" data-toggle="modal" data-target="#info_form" style="font-size: .60em;"><i class="fas fa-info"></i></button>
    			<button type="button" class="btn btn-primary mr-1 editemp" id="'.implode("=",$row).'" data-toggle="modal" data-target="#upd_emp" style="font-size: .50em;"><i class="fas fa-edit"></i></button>

    			<a class="btn btn-danger del_emp" title="delete" id="'.implode("=",$row).'" style="font-size: .50em;"><i class="fas fa-trash-alt"></i></a>
    		</td>';
    	}
    	$output .= '</tbody></table>';
    	echo $output;
	} else {
		echo '<h3 class="text-center text-secondary mt-5>No record in Employees."';
	}
}

if(isset($_POST['action']) && $_POST['action'] == "viewdept"){
	$output = '';
	$data = $db->viewdept();
	if($db->countdept()>0){
		$output .= '<table class="table table-data table-striped table-hover">
              <thead>
                  <tr>
                    <th>Department Number</th>
                    <th>Department Name</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>';
    	foreach($data as $row){
    		$output .= '<tr>
    		<td>'.$row['deptno'].'</td>
    		<td>'.$row['deptname'].'</td>
    		<td align="right" >
    			<button type="button" class="btn btn-primary edit_dept" id="'.implode("=",$row).'" data-toggle="modal" data-target="#upd_dept" style="font-size: .60em;"><i class="fas fa-edit"></i></button>
    			<a class="btn btn-danger del_dept" title="delete" id="'.implode("=",$row).'" style="font-size: .60em;"><i class="fas fa-trash-alt"></i></a>
    		</td>';
    	}
    	$output .= '</tbody></table>';
    	echo $output;
	} else {
		echo '<h3 class="text-center text-secondary mt-5>No record in Department."';
	}
}


if(isset($_POST['empbyproj'])){
	$output = 'Employees working on this project: <br/><br/>';
    $projname = $_POST['empbyproj'];
    $data = $db->viewempbyproj($projname);
    if($db->countempbyproj($projname)>0){
    	$output .= '<table class="table table-data table-hover" id="empbyprojtable" style="font-size: 11px;">
              <thead>
                  <tr>
                    <th>Name</th>
                    <th>Department</th>
                    <th>Weeks</th>
                    <th>Total Hours</th>
                  </tr>
                </thead>
                <tbody>';
        foreach ($data as $row){
    		$output .= '<tr>
    		<td>'.$row['name'].'</td>
    		<td>'.$row['deptname'].'</td>
    		<td>'.$row['weeks'].'</td>
    		<td>'.$row['hours_worked'].'</td>
    		</tr>';
    	}
    	$output .= '</tbody></table>';
    	echo $output;
	} else {
		echo '<h5 class="text-center text-secondary">No employees working in this project.</h5>';
	}
}

if(isset($_POST['empproj'])){
	$output = '';
    $ssn = $_POST['empproj'];
    
    $datum = $db->getsupervisor($ssn);
    if($db->countgetsupervisor($ssn)>0){
    	$output .= '<p>Supervisor </p>';
    	foreach ($datum as $row) {
    		$output .= '<ul class="list-group"><li class="list-group-item">'.$row['name'].' </li></ul><hr> ';
    	}

    	$data = $db->viewempproj($ssn);
	    if($db->countempproj($ssn)>0){
	    	$output .= '<p>Projects </p>';
	    	$active = '';
			$inactive = '';
	        foreach ($data as $row){
	        	if($row['status'] == 0){
	        		$active .= $row['projname']; //'<li class="list-group-item list-group-item-primary">'.$row['projname'].'</li>';
	        	} else {
	        		$inactive .= $row['projname'];//'<li class="list-group-item list-group-item-secondary">'.$row['projname'].'</li>';
	        	}
	    	}
	    	$activehead = '<ul class="list-group"><li class="list-group-item">Current: '.$active.' </li>';
	    	$inactivehead = '<li class="list-group-item">Past: '.$inactive.' </li>';
	    	$output .= $activehead.$inactivehead.'</ul><hr>';
	    }

	    $data2 = $db->viewdependant($ssn);
	    $gender = '';
	    if($db->countdependant($ssn)>0){
	    	$output .= '<p>Dependent</p> <div class="card" style="width: 27rem;">
	    		  <div class="card-body">';
	    	foreach($data2 as $row2){
	    		if($row2['gender'] == 'm'){
	    			$gender = 'Male';
	    		} else if($row2['gender'] == 'f'){
	    			$gender = 'Female';
	    		} else {
	    			$gender = 'Other';
	    		}
	    		$output .= '<h6 class="card-title">'.$row2['dname'].'</h6>
	    		    <p class="card-text">Dependent\'s First Name</p>
	    		  </div>
	    		  <ul class="list-group list-group-flush">
	    		    <li class="list-group-item">Gender: '.$gender.'</li>
	    		    <li class="list-group-item">Birthdate: '.$row2['dbdate'].'</li>
	    		    <li class="list-group-item">Relationship: '.$row2['relationship'].' </li>
	    		  </ul>
	    		</div>';
	    	}

    }
	echo $output;
	} else {
		echo '<h3 class="text-center text-secondary mt-5">No data found.</h3>';
	}

}

if(isset($_POST['action']) && $_POST['action'] == "getsuper"){
	$output = '<option hidden>Select Supervisor</option>';
    $data = $db->viewsupervisor();
    if($db->countsupervisor()>0){
    	foreach ($data as $row) {
    		$output .= '<option value="'.$row['ssn'].'">'.$row['ssn'].' - '.$row['name'].'</option>';
    	}
    echo $output;
    }
}

if(isset($_POST['action']) && $_POST['action'] == "getdept"){
	$output = '<option hidden>Select Department</option>';
    $data = $db->viewdept();
    if($db->countdept()>0){
    	foreach ($data as $row) {
    		$output .= '<option value="'.$row['deptno'].'">'.$row['deptname'].'</option>';
    	}
    	//$output .= '</select>';
    echo $output;
    }
    //echo json_encode($data);
}

if(isset($_POST['action']) && $_POST['action'] == "updatedept"){
    $deptno = $_POST['updeptno'];
    $deptname = $_POST['updeptname'];
    $oldno = $_POST['oldno'];

    $db->updatedept($deptno,$deptname,$oldno);
}

if(isset($_POST['action']) && $_POST['action'] == "updateemp"){
    $ssn = $_POST["ussn"];
    $lname = $_POST["ulname"];
    $fname = $_POST['ufname'];
	$mint = $_POST["umint"];
	$gender = $_POST["ugender"];
    $salary = $_POST["usalary"];
    $address = $_POST["uaddress"];
	$bdate = $_POST["ubday"];
	$empdept = $_POST["uempdept"];
	$empsuper = $_POST["uempsuper"];
	$depname = $_POST["udepname"];
	$depgender = $_POST["udepgender"];
	$depbdate = $_POST["udepbdate"];
	$relationship = $_POST["urelationship"];
	$oldssn = $_POST["oldssn"];

    $result = $db->updateemp($ssn,$lname,$fname,$mint,$gender,$salary,$address,$bdate,$empdept,$empsuper,$depname,$depgender,$depbdate,$relationship,$oldssn);
    echo json_encode($result);
    // echo $ssn,$lname,$fname,$mint,$gender,$salary,$address,$bdate,$empdept,$empsuper,$depname,$depgender,$depbdate,$relationship,$oldssn;
}

if(isset($_POST['action']) && $_POST['action'] == "updateproj"){
    $prno = $_POST['updprno'];
    $prname = $_POST['updprname'];
    $deptdown = $_POST['upddeptdown'];
    $stat = $_POST['updstat'];
    $oldprno = $_POST['oldprno'];

    $db->updateproj($prno,$prname,$deptdown,$stat,$oldprno);
}

if(isset($_POST['empid'])){
    $id = $_POST['empid'];
    $result = $db->getemployee($id);
    echo json_encode($result);
}

if(isset($_POST['delempno'])){
    $id = $_POST['delempno'];
    $result = $db->delemp($id);
    echo json_encode($result);
}

if(isset($_POST['deldeptno'])){
    $id = $_POST['deldeptno'];
    $result = $db->deldept($id);
    echo json_encode($result);
}

if(isset($_POST['delprojno'])){
    $id = $_POST['delprojno'];
    $result = $db->delproj($id);
    echo json_encode($result);
}




?>