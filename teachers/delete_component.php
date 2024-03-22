<?php
session_start();
     
if (!isset($_SESSION['user']) || $_SESSION['user'] != 'teacher_list'){
   header('location: ./login.php');
}

require_once("./component_class.php");

if(isset($_GET['id'])) {
    $component = new grading_components();
    $componentId = $_GET['id'];

    if($component->delete($componentId)) {
        // Delete successful
        header("Location: maintenance.php");
        exit();
    } else {
        // Delete failed
        echo "Failed to delete component. Please try again.";
    }
} else {
    // Invalid request, no component ID provided
    echo "Invalid request. No component ID provided.";
}
?>
