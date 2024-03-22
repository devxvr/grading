<?php
session_start();
     
if (!isset($_SESSION['user']) || $_SESSION['user'] != 'teacher_list'){
   header('location: ./login.php');
}


require_once './section-class.php';

function validate_field($field){
    return !empty($field);
}

$section = new Section();
if(isset($_GET['id'])){
    $section_id = $_GET['id'];
    // Fetch section details
    $sectionDetails = $section->getSectionById($section_id); 
    if(!$sectionDetails){
        
        echo "Section not found.";
        exit();
    }
} else {
    echo "Section ID not provided.";
    exit();
}

if(isset($_POST['save'])){
    
    $section_name = htmlentities($_POST['section']);
    $grade_level = htmlentities($_POST['gradelvl']);
    
   
    $section->section_id = $section_id;
    $section->section = $section_name;
    $section->gradelvl = $grade_level;
    
    if($section->edit()){ 
        header('Location: viewsection.php');
        exit();
    } else {
        echo 'An error occurred while updating the section.';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Section</title>
   
</head>
<body>
    <h2>Edit Section</h2>
    <form action="" method="POST">
        <label for="gradelvl">Grade Level:</label>
        <select name="gradelvl" id="gradelvl">
            
            <option value="Grade 7" <?php if($sectionDetails['gradelvl'] == "Grade 7") echo "selected"; ?>>Grade 7</option>
            <option value="Grade 8" <?php if($sectionDetails['gradelvl'] == "Grade 8") echo "selected"; ?>>Grade 8</option>
            <option value="Grade 9" <?php if($sectionDetails['gradelvl'] == "Grade 9") echo "selected"; ?>>Grade 9</option>
            <option value="Grade 10" <?php if($sectionDetails['gradelvl'] == "Grade 10") echo "selected"; ?>>Grade 10</option>
        </select>
        <br>
        <label for="section">Section Name:</label>
        <input type="text" name="section" id="section" value="<?php echo $sectionDetails['section']; ?>">
        <br>
        <button type="submit" name="save">Save Changes</button>
    </form>
</body>
</html>
