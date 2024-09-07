<?php
include_once '../../controller/system/system.class.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $message = array();
    
    $identifier = isset($_POST['identifier']) ? trim($_POST['identifier']) : '';
    $password = isset($_POST['password']) ? trim($_POST['password']) : '';

    if (empty($identifier)) {
        $message['status'] = "error";
        $message['info'] = "กรุณากรอก ชื่อผู้ใช้ หรือ Email";
        echo json_encode($message);
        exit();
    }

    if (empty($password)) {
        $message['status'] = "error";
        $message['info'] = "กรุณากรอก รหัสผ่าน";
        echo json_encode($message);
        exit();
    }

    $system = new System();
    $result = $system->Login($identifier, $password);
    echo $result;
}
?>
