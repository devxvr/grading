<?php
require_once("./component_class.php");

if(isset($_GET['id'])) {
    $component = new grading_components();
    $componentId = $_GET['id'];

    if($component->delete($componentId)) {
        
        header("Location: maintenance.php");
        exit();
    } else {
       
        echo "Failed to delete component. Please try again.";
    }
} else {

    echo "Invalid request. No component ID provided.";
}
?>
