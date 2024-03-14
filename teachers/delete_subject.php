<?php
require_once './subject_class.php';

$subject = new subjects();

// Check if subject_id is provided
if(isset($_GET['subject_id'])) {
    $subject_id = $_GET['subject_id'];

    
    if($subject->isSubjectExists($subject_id)) {
        if($subject->delete($subject_id)) {
            header('Location: viewsubject.php');
            exit();
        } else {
            echo "Failed to delete the subject.";
            exit();
        }
    } else {
        echo "Subject not found.";
        exit();
    }
} else {
    echo "Subject ID not provided.";
    exit();
}
?>
