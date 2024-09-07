<?php
include_once 'config.db.php';
include_once 'connect.class.php';

class System extends pdo_mysql
{
    private $db;

    public function __construct()
    {
        $this->db = $this->Database_PDO();
    }

    public function Login($identifier, $password)
    {
        $message = [];
        try {
            if (ctype_space($identifier) || ctype_space($password)) {
                throw new Exception("ข้อมูล ชื่อผู้ใช้, อีเมล หรือ รหัสผ่าน ไม่ถูกต้อง");
            }
            $checkUser = $this->db->prepare("SELECT * FROM users WHERE email = :email OR username = :username");
            $checkUser->execute([
                ':email' => $identifier,
                ':username' => $identifier
            ]);

            if ($checkUser->rowCount() > 0) {
                $result = $checkUser->fetch(PDO::FETCH_OBJ);
                if ($result->password) {
                    $message['status'] = "success";
                    $message['info'] = "เข้าสู่ระบบสำเร็จ";
                    $_SESSION["user_id"] = $result->id;
                    $_SESSION["username"] = $result->username;
                    $_SESSION["email"] = $result->email;
                } else {
                    throw new Exception("ชื่อผู้ใช้, Email หรือ รหัสผ่านไม่ถูกต้อง");
                }
            } else {
                throw new Exception("ชื่อผู้ใช้, Email หรือ รหัสผ่านไม่ถูกต้อง");
            }
        } catch (Exception $e) {
            $message['status'] = "error";
            $message['info'] = "เกิดข้อผิดพลาด: " . $e->getMessage();
        }

        return json_encode($message);
    }

    public function Register($username, $email, $password)
    {
        $message = [];
        try {
            if (ctype_space($username) || ctype_space($email) || ctype_space($password)) {
                throw new Exception("ข้อมูล ชื่อผู้ใช้, อีเมล หรือ รหัสผ่าน ไม่ถูกต้อง");
            }

            $checkEmail = $this->db->prepare("SELECT * FROM users WHERE email = :email OR username = :username");
            $checkEmail->execute([':email' => $email, ':username' => $username]);

            if ($checkEmail->rowCount() > 0) {
                throw new Exception("มี Email หรือ ชื่อผู้ใช้ นี้แล้ว");
            } else {
                $registerUser = $this->db->prepare("INSERT INTO users (username, email, password) 
                                    VALUES (:username, :email, :password)");
                $success = $registerUser->execute([
                    ':username' => $username,
                    ':email' => $email,
                    ':password' => $password,
                ]);

                if ($success) {
                    $message['status'] = "success";
                    $message['info'] = "สมัครสมาชิกสำเร็จ";
                } else {
                    throw new Exception("เกิดข้อผิดพลาดในการสมัครสมาชิก");
                }
            }
        } catch (Exception $e) {
            $message['status'] = "error";
            $message['info'] = "เกิดข้อผิดพลาด: " . $e->getMessage();
        }

        return json_encode($message);
    }

}
?>
