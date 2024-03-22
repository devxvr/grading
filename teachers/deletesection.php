<?php
session_start();
     
if (!isset($_SESSION['user']) || $_SESSION['user'] != 'teacher_list'){
   header('location: ./login.php');
}

require_once './section-class.php';

$section = new Section();

// Check if section_id is provided
if(isset($_GET['section_id'])) {
    $section_id = $_GET['section_id'];
    if($section->isSectionExists($section_id)) {
        if($section->delete($section_id)) {
            header('Location: viewsection.php');
            exit();
        } else {
            echo "Failed to delete the section.";
            exit();
        }
    } else {
        echo "Section not found.";
        exit();
    }
} else {
    echo "Section ID not provided.";
    exit();
}
?>