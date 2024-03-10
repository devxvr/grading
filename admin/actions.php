<?php 
session_start();
require_once('./includes/database.php');

Class Actions extends database{
    
    function login(){
        extract($_POST);
        $sql = "SELECT * FROM admin_list where username = '{$username}' and `password` = '".md5($password)."' ";
        @$qry = $this->query($sql)->fetchArray();
        if(!$qry){
            $resp['status'] = "failed";
            $resp['msg'] = "Invalid username or password.";
        }else{
            $resp['status'] = "success";
            $resp['msg'] = "Login successfully.";
            foreach($qry as $k => $v){
                if(!is_numeric($k))
                $_SESSION[$k] = $v;
            }
        }
        return json_encode($resp);
    }
    function logout(){
        session_destroy();
        header("location:./");
    }
    function save_user(){
        extract($_POST);
        $data = "";
        foreach($_POST as $k => $v){
        if(!in_array($k,array('id','type'))){
            if(!empty($id)){
                if(!empty($data)) $data .= ",";
                $data .= " `{$k}` = '{$v}' ";
                }else{
                    $cols[] = $k;
                    $values[] = "'{$v}'";
                }
            }
        }
        if(empty($id)){
            $cols[] = 'password';
            $values[] = "'".md5($username)."'";
        }
        if(isset($cols) && isset($values)){
            $data = "(".implode(',',$cols).") VALUES (".implode(',',$values).")";
        }
        

       
        @$check= $this->query("SELECT count(admin_id) as `count` FROM admin_list where `username` = '{$username}' ".($id > 0 ? " and admin_id != '{$id}' " : ""))->fetchArray()['count'];
        if(@$check> 0){
            $resp['status'] = 'failed';
            $resp['msg'] = "Username already exists.";
        }else{
            if(empty($id)){
                $sql = "INSERT INTO `admin_list` {$data}";
            }else{
                $sql = "UPDATE `admin_list` set {$data} where admin_id = '{$id}'";
            }
            @$save = $this->query($sql);
            if($save){
                $resp['status'] = 'success';
                if(empty($id))
                $resp['msg'] = 'New Admin User successfully saved.';
                else
                $resp['msg'] = 'Admin User Details successfully updated.';
            }else{
                $resp['status'] = 'failed';
                $resp['msg'] = 'Saving Admin User Details Failed. Error: '.$this->lastErrorMsg();
                $resp['sql'] =$sql;
            }
        }
        return json_encode($resp);
    }
    function delete_user(){
        extract($_POST);

        @$delete = $this->query("DELETE FROM `admin_list` where rowid = '{$id}'");
        if($delete){
            $resp['status']='success';
            $_SESSION['flashdata']['type'] = 'success';
            $_SESSION['flashdata']['msg'] = 'Admin User successfully deleted.';
        }else{
            $resp['status']='failed';
            $resp['error']=$this->lastErrorMsg();
        }
        return json_encode($resp);
    }
    function update_credentials(){
        extract($_POST);
        $data = "";
        foreach($_POST as $k => $v){
            if(!in_array($k,array('id','old_password')) && !empty($v)){
                if(!empty($data)) $data .= ",";
                if($k == 'password') $v = md5($v);
                $data .= " `{$k}` = '{$v}' ";
            }
        }
        if(!empty($password) && md5($old_password) != $_SESSION['password']){
            $resp['status'] = 'failed';
            $resp['msg'] = "Old password is incorrect.";
        }else{
            $sql = "UPDATE `admin_list` set {$data} where admin_id = '{$_SESSION['admin_id']}'";
            @$save = $this->query($sql);
            if($save){
                $resp['status'] = 'success';
                $_SESSION['flashdata']['type'] = 'success';
                $_SESSION['flashdata']['msg'] = 'Credential successfully updated.';
                foreach($_POST as $k => $v){
                    if(!in_array($k,array('id','old_password')) && !empty($v)){
                        if(!empty($data)) $data .= ",";
                        if($k == 'password') $v = md5($v);
                        $_SESSION[$k] = $v;
                    }
                }
            }else{
                $resp['status'] = 'failed';
                $resp['msg'] = 'Updating Credentials Failed. Error: '.$this->lastErrorMsg();
                $resp['sql'] =$sql;
            }
        }
        return json_encode($resp);
    }
    function save_subject(){
        $percentage = $_POST['percentage'] ?? null;
        $id = $_POST['id'] ?? null;
        $component_id = $_POST['component_id'] ?? [];
        if(empty($id))
            $sql = "INSERT INTO `subjects` (`name`)VALUES('{$name}')";
        else{
            $data = "";
            foreach ($percentage as $p) {
                if (!is_numeric($p) || $p < 0 || $p > 100) {
                    $resp['status'] = 'failed';
                    $resp['msg'] = 'Percentage values must be valid numbers between 0 and 100.';
                    return json_encode($resp);
                }
            }
            $sql = "UPDATE `subjects` set {$data} where `subject_id` = '{$id}' ";
        }
        @$check= $this->query("SELECT COUNT(subject_id) as count from `subjects` where `name` = '{$name}' ".($id > 0 ? " and subject_id != '{$id}'" : ""))->fetchArray()['count'];
        if(@$check> 0){
            $resp['status'] ='failed';
            $resp['msg'] = 'Subject already exists.';
        }else{
            @$save = $this->query($sql);
            if($save){
                $resp['status']="success";
                if(empty($id))
                    $resp['msg'] = "Subject successfully saved.";
                else
                    $resp['msg'] = "Subject successfully updated.";
            }else{
                $resp['status']="failed";
                if(empty($id))
                    $resp['msg'] = "Saving New Subject Failed.";
                else
                    $resp['msg'] = "Updating Subject Failed.";
                $resp['error']=$this->lastErrorMsg();
            }
        }
        return json_encode($resp);
    }
    function delete_subject(){
        extract($_POST);

        @$delete = $this->query("DELETE FROM `subjects` where subject_id = '{$id}'");
        if($delete){
            $resp['status']='success';
            $_SESSION['flashdata']['type'] = 'success';
            $_SESSION['flashdata']['msg'] = 'Subject successfully deleted.';
        }else{
            $resp['status']='failed';
            $resp['error']=$this->lastErrorMsg();
        }
        return json_encode($resp);
    }
    function save_component(){
        extract($_POST);
        if(empty($id))
            $sql = "INSERT INTO `grading_components` (`name`)VALUES('{$name}')";
        else{
            $data = "";
             foreach($_POST as $k => $v){
                 if(!in_array($k,array('id'))){
                     if(!empty($data)) $data .= ", ";
                     $data .= " `{$k}` = '{$v}' ";
                 }
             }
            $sql = "UPDATE `grading_components` set {$data} where `component_id` = '{$id}' ";
        }
        @$check= $this->query("SELECT COUNT(component_id) as count from `grading_components` where `name` = '{$name}' ".($id > 0 ? " and component_id != '{$id}'" : ""))->fetchArray()['count'];
        if(@$check> 0){
            $resp['status'] ='failed';
            $resp['msg'] = 'Component already exists.';
        }else{
            @$save = $this->query($sql);
            if($save){
                $resp['status']="success";
                if(empty($id))
                    $resp['msg'] = "Component successfully saved.";
                else
                    $resp['msg'] = "Component successfully updated.";
            }else{
                $resp['status']="failed";
                if(empty($id))
                    $resp['msg'] = "Saving New Component Failed.";
                else
                    $resp['msg'] = "Updating Component Failed.";
                $resp['error']=$this->lastErrorMsg();
            }
        }
        return json_encode($resp);
    }
    function delete_component(){
        extract($_POST);

        @$delete = $this->query("DELETE FROM `grading_components` where component_id = '{$id}'");
        if($delete){
            $resp['status']='success';
            $_SESSION['flashdata']['type'] = 'success';
            $_SESSION['flashdata']['msg'] = 'Component successfully deleted.';
        }else{
            $resp['status']='failed';
            $resp['error']=$this->lastErrorMsg();
        }
        return json_encode($resp);
    }
    function save_percentage() {
        extract($_POST);
        
        // Validate input
        if (empty($percentage)) {
            $resp['status'] = 'failed';
            $resp['msg'] = 'Percentage is required.';
            return json_encode($resp);
        }
        if (empty($id)) {
            $resp['status'] = 'failed';
            $resp['msg'] = 'Subject ID is required.';
            return json_encode($resp);
        }
        
        try {
            $conn = $this->connect();
            $conn->beginTransaction();
            
            // Delete existing records for the subject
            $stmt = $conn->prepare("DELETE FROM component_subject_percentage WHERE subject_id = :subject_id");
            $stmt->bindParam(':subject_id', $id);
            $stmt->execute();
            
            // Insert new records for the subject
            $stmt = $conn->prepare("INSERT INTO component_subject_percentage (subject_id, component_id, percentage) VALUES (:subject_id, :component_id, :percentage)");
            foreach ($component_id as $key => $value) {
                $stmt->bindParam(':subject_id', $id);
                $stmt->bindParam(':component_id', $value);
                $stmt->bindParam(':percentage', $percentage[$key]);
                $stmt->execute();
            }
            
            $conn->commit();
            
            // Prepare response
            $resp['status'] = 'success';
            $resp['msg'] = 'Percentage successfully saved.';
        } catch (PDOException $e) {
            // Rollback transaction if an error occurs
            $conn->rollBack();
            
            // Prepare error response
            $resp['status'] = 'failed';
            $resp['msg'] = 'An error occurred while saving data: ' . $e->getMessage();
        }
        
        // Encode response as JSON and return
        echo json_encode($resp);
    }
}

$a = isset($_GET['a']) ? $_GET['a'] : '';
$action = new Actions();

switch($a) {
    case 'save_percentage':
        echo $action->save_percentage();
        break;
    default:
        // Handle other actions
        break;
}
    function save_class(){
        extract($_POST);
        if(empty($id))
            $sql = "INSERT INTO `class_list` (`subject_id`,`grade`,`section`)VALUES('{$subject_id}','{$grade}','{$section}')";
        else{
            $data = "";
             foreach($_POST as $k => $v){
                 if(!in_array($k,array('id'))){
                     if(!empty($data)) $data .= ", ";
                     $data .= " `{$k}` = '{$v}' ";
                 }
             }
            $sql = "UPDATE `class_list` set {$data} where `class_id` = '{$id}' ";
        }
        @$check= $this->query("SELECT COUNT(class_id) as count from `class_list` where `subject_id` = '{$subject_id}' and `grade` ='{$grade}' and `section` ='{$section}' ".($id > 0 ? " and class_id != '{$id}'" : ""))->fetchArray()['count'];
        if(@$check> 0){
            $resp['status'] ='failed';
            $resp['msg'] = 'Class already exists.';
        }else{
            @$save = $this->query($sql);
            if($save){
                $resp['status']="success";
                if(empty($id))
                    $resp['msg'] = "Class successfully saved.";
                else
                    $resp['msg'] = "Class successfully updated.";
            }else{
                $resp['status']="failed";
                if(empty($id))
                    $resp['msg'] = "Saving New Class Failed.";
                else
                    $resp['msg'] = "Updating Class Failed.";
                $resp['error']=$this->lastErrorMsg();
            }
        }
        return json_encode($resp);
    }
    function delete_class(){
        extract($_POST);

        @$delete = $this->query("DELETE FROM `class_list` where class_id = '{$id}'");
        if($delete){
            $resp['status']='success';
            $_SESSION['flashdata']['type'] = 'success';
            $_SESSION['flashdata']['msg'] = 'Class successfully deleted.';
        }else{
            $resp['status']='failed';
            $resp['error']=$this->lastErrorMsg();
        }
        return json_encode($resp);
    }
    function save_student(){
        extract($_POST);
        if(empty($id))
            $sql = "INSERT INTO `student_list` (`class_id`,`name`)VALUES('{$class_id}','{$name}')";
        else{
            $data = "";
             foreach($_POST as $k => $v){
                 if(!in_array($k,array('id'))){
                     if(!empty($data)) $data .= ", ";
                     $data .= " `{$k}` = '{$v}' ";
                 }
             }
            $sql = "UPDATE `student_list` set {$data} where `student_id` = '{$id}' ";
        }
        @$check= $this->query("SELECT COUNT(student_id) as count from `student_list` where `class_id` = '{$class_id}' and `name` ='{$name}' ".($id > 0 ? " and student_id != '{$id}'" : ""))->fetchArray()['count'];
        if(@$check> 0){
            $resp['status'] ='failed';
            $resp['msg'] = 'Student already exists.';
        }else{
            @$save = $this->query($sql);
            if($save){
                $resp['status']="success";
                if(empty($id))
                    $resp['msg'] = "Student successfully saved.";
                else
                    $resp['msg'] = "Student successfully updated.";
            }else{
                $resp['status']="failed";
                if(empty($id))
                    $resp['msg'] = "Saving New Student Failed.";
                else
                    $resp['msg'] = "Updating Student Failed.";
                $resp['error']=$this->lastErrorMsg();
            }
        }
        return json_encode($resp);
    }
    function delete_student(){
        extract($_POST);

        @$delete = $this->query("DELETE FROM `student_list` where student_id = '{$id}'");
        if($delete){
            $resp['status']='success';
            $_SESSION['flashdata']['type'] = 'success';
            $_SESSION['flashdata']['msg'] = 'Student successfully deleted.';
        }else{
            $resp['status']='failed';
            $resp['error']=$this->lastErrorMsg();
        }
        return json_encode($resp);
    }
    function save_assessment(){
        extract($_POST);
        if(empty($id))
            $sql = "INSERT INTO `assessment_list` (`class_id`,`component_id`,`quarter`,`name`,`hps`)VALUES('{$class_id}','{$component_id}','{$quarter}','{$name}','{$hps}')";
        else{
            $data = "";
             foreach($_POST as $k => $v){
                 if(!in_array($k,array('id'))){
                     if(!empty($data)) $data .= ", ";
                     $data .= " `{$k}` = '{$v}' ";
                 }
             }
            $sql = "UPDATE `assessment_list` set {$data} where `assessment_id` = '{$id}' ";
        }
        @$check= $this->query("SELECT COUNT(assessment_id) as count from `assessment_list` where `class_id` = '{$class_id}' and `component_id` = '{$component_id}' and `quarter` = '{$quarter}' and `name` ='{$name}' ".($id > 0 ? " and assessment_id != '{$id}'" : ""))->fetchArray()['count'];
        if(@$check> 0){
            $resp['status'] ='failed';
            $resp['msg'] = 'Assessment already exists.';
        }else{
            @$save = $this->query($sql);
            if($save){
                $resp['status']="success";
                if(empty($id))
                    $resp['msg'] = "Assessment successfully saved.";
                else
                    $resp['msg'] = "Assessment successfully updated.";
            }else{
                $resp['status']="failed";
                if(empty($id))
                    $resp['msg'] = "Saving New Assessment Failed.";
                else
                    $resp['msg'] = "Updating Assessment Failed.";
                $resp['error']=$this->lastErrorMsg();
            }
        }
        return json_encode($resp);
    }
    function delete_assessment(){
        extract($_POST);

        @$delete = $this->query("DELETE FROM `assessment_list` where assessment_id = '{$id}'");
        if($delete){
            $resp['status']='success';
            $_SESSION['flashdata']['type'] = 'success';
            $_SESSION['flashdata']['msg'] = 'Assessment successfully deleted.';
        }else{
            $resp['status']='failed';
            $resp['error']=$this->lastErrorMsg();
        }
        return json_encode($resp);
    }
    function save_mark(){
        extract($_POST);
        $data = "";
        foreach($student_id as $k => $v){
            if(!empty($data)) $data .=", ";
            $data .= "('{$assessment_id}','{$v}','{$mark[$k]}')";
        }
        if(!empty($data)){
            $this->query("DELETE  FROM `mark_list` where assessment_id = '{$assessment_id}'");
            $sql = "INSERT INTO `mark_list` (`assessment_id`,`student_id`,`mark`) VALUES {$data}";
            $save = $this->query($sql);
            if($save){
                $resp['status'] = 'success';
                $resp['msg'] = " Marks Successfuly Saved";
            }else{
                $resp['status']='failed';
                $resp['msg'] = "Saving Data Failed. Error: ".$this->lastErrorMsg();
                $resp['sql'] = $sql;
            }
        }else{
            $resp['status'] = 'failed';
            $resp['msg'] = "No Student Listed yet";
        }
        return json_encode($resp);
    }

$a = isset($_GET['a']) ?$_GET['a'] : '';
$action = new Actions();
switch($a){
    case 'login':
        echo $action->login();
    break;
    case 'customer_login':
        echo $action->customer_login();
    break;
    case 'logout':
        echo $action->logout();
    break;
    case 'customer_logout':
        echo $action->customer_logout();
    break;
    case 'save_user':
        echo $action->save_user();
    break;
    case 'delete_user':
        echo $action->delete_user();
    break;
    case 'update_credentials':
        echo $action->update_credentials();
    break;
    case 'save_subject':
        echo $action->save_subject();
    break;
    case 'delete_subject':
        echo $action->delete_subject();
    break;
    case 'save_component':
        echo $action->save_component();
    break;
    case 'delete_component':
        echo $action->delete_component();
    break;
    case 'save_percentage':
        echo $action->save_percentage();
    break;
    case 'save_class':
        echo $action->save_class();
    break;
    case 'delete_class':
        echo $action->delete_class();
    break;
    case 'save_student':
        echo $action->save_student();
    break;
    case 'delete_student':
        echo $action->delete_student();
    break;
    case 'save_assessment':
        echo $action->save_assessment();
    break;
    case 'delete_assessment':
        echo $action->delete_assessment();
    break;
    case 'save_mark':
        echo $action->save_mark();
    break;
    default:
    // default action here
    break;
}