<?php
    
    function validate_field($field){
        $field = htmlentities($field);
        if(strlen(trim($field))<1){
            return false;
        }else{
            return true;
        }
    }

    function validate_email($username){
        // Check if the 'username' key exists in the $_POST array
        if (isset($username)) {
            $username = trim($username); // Trim whitespace
            // Check if the username is not empty
            if (empty($username)) {
                return 'Username is required';
            } else if (!filter_var($username, FILTER_VALIDATE_EMAIL)) {
                // Check if the username has a valid format
                return 'Username is invalid format';
            } else {
                return 'success';
            }
        } else {
            return 'Username is required'; // 'username' key doesn't exist in $_POST
        }
    }    

    function validate_password($password) {
        $password = htmlentities($password);
        
        if (strlen(trim($password)) < 1) {
            return "Password cannot be empty";
        } elseif (strlen($password) < 8) {
            return "Password must be at least 8 characters long";
        } else {
            return "success"; // Indicates successful validation
        }
    }    

    function validate_cpw($password, $cpassword){
        $pw = htmlentities($password);
        $cpw = htmlentities($cpassword);
        if(strcmp($pw, $cpw) == 0){
            return true;
        }else{
            return false;
        }
    }

    function getGenderOptions($selectedGender = null)
{
    $options = [
        'male' => 'Male',
        'female' => 'Female',
    ];

    $html = '';

    foreach ($options as $value => $label) {
        $selected = ($selectedGender === $value) ? 'selected' : '';
        $html .= "<option value='$value' $selected>$label</option>";
    }

    return $html;
}

function getStatusOptions($selectedStatus = null)
{
    $options = [
        'single' => 'Single',
        'married' => 'Married',
        'widowed' => 'Widowed',
        'divorced' => 'Divorced',
    ];

    $html = '';

    foreach ($options as $value => $label) {
        $selected1 = ($selectedStatus === $value) ? 'selected' : '';
        $html .= "<option value='$value' $selected1>$label</option>";
    }

    return $html;
}

function getDesignationOptions($selectedDesignation = null)
{
    $options = [
        'Adviser' => 'Adviser',
        'Subject Teacher' => 'Subject Teacher',
        

    ];

    $html = '';

    foreach ($options as $value => $label) {
        $selected2 = ($selectedDesignation === $value) ? 'selected' : '';
        $html .= "<option value='$value' $selected2>$label</option>";
    }

    return $html;
}

function getAssigned_subjectOptions($selectedAssigned_subject = null)
{
    $options = [
        'mathematics' => 'Mathematics',
        'araling Panlipunan' => 'Araling Panlipunan',
        'science' => 'Science',
        'english' => 'English',
        'filipino' => 'Filipino',
        'mapeh' => 'MAPEH',
        'edukasyon sa Pagpapakatao' => 'Edukasyon sa Pagpapakatao',
        'tle' => 'TLE',

    ];

    $html = '';

    foreach ($options as $value => $label) {
        $selected2 = ($selectedAssigned_subject === $value) ? 'selected' : '';
        $html .= "<option value='$value' $selected2>$label</option>";
    }

    return $html;
}

function getAssigned_year_levelOptions($selectedAssigned_year_level = null)
{
    $options = [
        'Grade 7' => 'Grade 7',
        'Grade 8' => 'Grade 8',
        'Grade 9' => 'Grade 9',
        'Grade 10' => 'Grade 10',
        

    ];

    $html = '';

    foreach ($options as $value => $label) {
        $selected2 = ($selectedAssigned_year_level === $value) ? 'selected' : '';
        $html .= "<option value='$value' $selected2>$label</option>";
    }

    return $html;
}
?>


