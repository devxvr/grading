<?php
require_once './component_class.php';
require_once './manage_component.php';
require_once './actions.php';

// Define the validate_field function
function validate_field($field){
    // Your validation logic goes here
    return !empty($field);
}

if(isset($_GET['id'])){
    $component = new grading_components();
    $record = $component->get_component($_GET['id']);
    $component->name = $record['name'];
}

if(isset($_POST['save'])){
    $component = new grading_components();
    $component->component_id = $_GET['id'];
    //sanitize
    $component->name = htmlentities($_POST['name']);

    // Perform validation
    if (validate_field($component->name)) {
        // Proceed with saving changes
        if($component->edit()){
            header('location: maintenance.php');
            exit;
        } else {
            echo 'An error occurred while adding in the database.';
        }
    } else {
        echo 'Field validation failed.';
    }
}
?>
<div class="container-fluid">
    <form action="" id="component-form" method="post">
        <input type="hidden" name="id" value="<?php echo isset($component_id) ? $component_id : '' ?>">
        <div class="form-group">
            <label for="name" class="control-label"></label>
            <input type="text" name="name" autofocus id="name" required class="form-control form-control-sm rounded-0" value="<?php if(isset($_POST['name'])) { echo $_POST['name']; } else if (isset($component->name)){ echo $component->name; } ?>">
        </div>
        <div class="button-group">
            <button type="submit" name="save" class="btn btn-primary mt-2 mb-3 brand-bg-color" id="addStaffButton">Save Changes</button>
        </div>
    </form>
</div>

