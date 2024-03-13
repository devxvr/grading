<?php
require_once("./subject_class.php");

if(isset($_GET['id'])) {
    $subject = new subjects();
    $subjectId = $_GET['id'];

    if($subject->delete($subjectId)) {
        // Delete successful
        header("Location: maintenance.php");
        exit();
    } else {
        // Delete failed
        echo "Failed to delete subject. Please try again.";
    }
} else {
    // Invalid request, no subject ID provided
    echo "Invalid request. No subject ID provided.";
}
?>
