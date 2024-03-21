<?php
session_start();

if (isset($_SESSION['teachers_list']) && $_SESSION['teachers_list'] == 'teacher_list') {
    header('location: ./login.php');
    exit(); 
    
require_once("../includes/database.php");
$database = new Database();
$conn = $database->connect();
if(isset($_GET['id'])){
    $qry = $conn->query("SELECT * FROM `grading_components` where component_id = '{$_GET['id']}'");
    while($row = $qry->fetch(PDO::FETCH_ASSOC)) {
        foreach($row as $k => $v){
            $$k = $v;
        }
    }
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


?>


<script>
    $(function(){
        $('#component-form').submit(function(e){
            e.preventDefault();
            $('.pop_msg').remove()
            var _this = $(this)
            var _el = $('<div>')
                _el.addClass('pop_msg')
            $('#uni_modal button').attr('disabled',true)
            $('#uni_modal button[type="submit"]').text('submitting form...')
            $.ajax({
                url:'./Actions.php?a=save_component',
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
                        if("<?php echo isset($component_id) ?>" != 1)
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