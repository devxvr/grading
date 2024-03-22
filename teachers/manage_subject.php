<?php

session_start();
     
if (!isset($_SESSION['user']) || $_SESSION['user'] != 'teacher_list'){
   header('location: ./login.php');
}

    
require_once("../includes/database.php"); // Include database connection file

// Establish a database connection
$db = new Database();
$conn = $db->connect();

// Check if the subject ID is set in the URL
if(isset($_GET['id'])){
    // Retrieve subject details from the database based on the subject ID
    $qry = $conn->query("SELECT * FROM `subjects` where subject_id = '{$_GET['id']}'");
    // Fetch the subject details
    foreach($qry->fetch(PDO::FETCH_ASSOC) as $k => $v){
        $$k = $v;
    }
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

?>


<script>
    $(function(){
        $('#subject-form').submit(function(e){
            e.preventDefault();
            $('.pop_msg').remove()
            var _this = $(this)
            var _el = $('<div>')
                _el.addClass('pop_msg')
            $('#uni_modal button').attr('disabled',true)
            $('#uni_modal button[type="submit"]').text('submitting form...')
            $.ajax({
                url:'./Actions.php?a=save_subject',
                method:'POST',
                data:$(this).serialize(),
                dataType:'JSON',
                error:err=>{
                    console.log(err)
                    _el.addClass('alert alert-danger')
                    _el.text("An error occurred.")
                    _this.prepend(_el)
                    _el.show('slow')
                     $('#uni_modal button').attr('disabled',false)
                     $('#uni_modal button[type="submit"]').text('Save')
                },
                success:function(resp){
                    if(resp.status == 'success'){
                        _el.addClass('alert alert-success')
                        $('#uni_modal').on('hide.bs.modal',function(){
                            location.reload()
                        })
                        if("<?php echo isset($subject_id) ?>" != 1)
                        _this.get(0).reset();
                    }else{
                        _el.addClass('alert alert-danger')
                    }
                    _el.text(resp.msg)

                    _el.hide()
                    _this.prepend(_el)
                    _el.show('slow')
                     $('#uni_modal button').attr('disabled',false)
                     $('#uni_modal button[type="submit"]').text('Save')
                }
            })
        })
    })
</script>
