<?php
    
    function validate_field($field){
        $field = htmlentities($field);
        if(strlen(trim($field))<1){
            return false;
        }else{
            return true;
        }
    }

    function validate_email($email){
        // Check if the 'email' key exists in the $_POST array
        if (isset($email)) {
            $email = trim($email); // Trim whitespace
            // Check if the email is not empty
            if (empty($email)) {
                return 'Email is required';
            } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                // Check if the email has a valid format
                return 'Email is invalid format';
            } else {
                return 'success';
            }
        } else {
            return 'Email is required'; // 'email' key doesn't exist in $_POST
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

function getDepartmentOptions($selectedDepartment = null)
{
    $options = [
        'English Department' => 'English Department',
        'Mathematics Department' => 'Mathematics Department',
        'Science Department' => 'Science Department',
        'ArPan Department' => 'ArPan Department',
        'Filipino Department' => 'Filipino Department',
        'MAPEH Department' => 'MAPEH Department',
        'TLE Department' => 'TLE Department',
        'ESP Department' => 'ESP Department',
    ];

    $html = '';

    foreach ($options as $value => $label) {
        $selected2 = ($selectedDepartment === $value) ? 'selected' : '';
        $html .= "<option value='$value' $selected2>$label</option>";
    }

    return $html;
}

?>
