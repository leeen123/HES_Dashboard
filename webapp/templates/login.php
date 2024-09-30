<?php
include ('../conn/conn.php');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

$mail = new PHPMailer(true);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // 验证用户名和密码
    $stmt = $conn->prepare("SELECT `user_id`, `password`, `email` FROM `user` WHERE `username` = :username");
    $stmt->bindParam(':username', $username);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $row = $stmt->fetch();
        $stored_password = $row['password'];
        $email = $row['email'];  
        $user_id = $row['user_id'];  // 获取用户ID

        // 如果密码正确，发送OTP
        if ($password === $stored_password) {
            try {
                // 生成OTP
                $verificationCode = rand(100000, 999999);

                // 更新数据库中的verification_code
                $updateStmt = $conn->prepare("UPDATE `user` SET `verification_code` = :verification_code WHERE `user_id` = :user_id");
                $updateStmt->bindParam(':verification_code', $verificationCode);
                $updateStmt->bindParam(':user_id', $user_id);
                $updateStmt->execute();

                // 配置邮件服务器
                $mail->isSMTP(); 
                $mail->Host       = 'smtp.gmail.com'; 
                $mail->SMTPAuth   = true; 
                $mail->Username   = 'chanjunyu1141@gmail.com'; 
                $mail->Password   = 'dwns mhem chbf xthq'; 
                $mail->SMTPSecure = 'ssl'; 
                $mail->Port       = 465;                                    
                
                // 设置收件人和内容
                $mail->setFrom('chanjunyu1141@gmail.com', 'OTP Verification');
                $mail->addAddress($email);   
                $mail->addReplyTo('chanjunyu1141@gmail.com', 'OTP Verification'); 
                
                // 邮件内容
                $mail->isHTML(true);  
                $mail->Subject = 'Verification Code';
                $mail->Body    = 'Your verification code is: ' . $verificationCode; 
                
                // 发送邮件
                $mail->send();

                // 开启Session以保存用户ID和OTP
                session_start();
                $_SESSION['user_verification_id'] = $user_id;
                $_SESSION['verification_code'] = $verificationCode;

                echo "
                <script>
                    alert('Login Successful! Check your email for OTP verification.');
                    window.location.href = '../verification.php';
                </script>
                ";
            } catch (Exception $e) {
                echo "
                <script>
                    alert('Error sending OTP: " . $e->getMessage() . "');
                    window.location.href = '../index.php';
                </script>
                ";
            }
        } else {
            echo "
            <script>
                alert('Login Failed, Incorrect Password!');
                window.location.href = '../index.php';
            </script>
            ";
        }
    } else {
        echo "
        <script>
            alert('Login Failed, User Not Found!');
            window.location.href = '../index.php';
        </script>
        ";
    }
}
?>
