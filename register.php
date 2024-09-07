<?php
include_once '../../controller/system/system.class.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $message = array();

    $requiredFields = ['username', 'password'];

    foreach ($requiredFields as $field) {
        if (empty($_POST[$field])) {
            $message['status'] = "error";
            $message['info'] = "กรุณากรอก " . GetData($field);
            echo json_encode($message);
            exit;
        }
    }

    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    
    $system = new System();
    $result = $system->Register($username, $email, $password);
    echo $result;
}

function GetData($field) {
    $fields = [
        'username' => 'Email',
        'password' => 'Password'
    ];

    return isset($fields[$field]) ? $fields[$field] : $field;
}
?>
