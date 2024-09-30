<?php
include('../conn/conn.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

$mail = new PHPMailer(true);

if (isset($_POST['register'])) {
    try {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password']; 
        $conn->beginTransaction();

        // Check if email already exists
        $stmt = $conn->prepare("SELECT `email` FROM `user` WHERE `email` = :email ");
        $stmt->execute([
            'email' => $email
        ]);
        $nameExist = $stmt->fetch(PDO::FETCH_ASSOC);

        if (empty($nameExist)) {
            $verificationCode = rand(100000, 999999);

            // Insert user data with the hashed password and verification code
            $insertStmt = $conn->prepare("INSERT INTO `user` (`user_id`, `username`, `email`, `password`, `verification_code`) VALUES (NULL, :username, :email, :password, :verification_code)");
            $insertStmt->bindParam(':username', $username, PDO::PARAM_STR);
            $insertStmt->bindParam(':email', $email, PDO::PARAM_STR);
            $insertStmt->bindParam(':password', $password, PDO::PARAM_STR); 
            $insertStmt->bindParam(':verification_code', $verificationCode, PDO::PARAM_INT);
            $insertStmt->execute();


            // Email configuration and sending OTP
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'chanjunyu1141@gmail.com';
            $mail->Password   = 'dwns mhem chbf xthq';
            $mail->SMTPSecure = 'ssl';
            $mail->Port       = 465;

            $mail->setFrom('chanjunyu1141@gmail.com', 'OTP verification');
            $mail->addAddress($email);
            $mail->addReplyTo('chanjunyu1141@gmail.com', 'OTP verification');

            // Mail content
            $mail->isHTML(true);
            $mail->Subject = 'Verification Code';
            $mail->Body    = 'Your verification code is: ' . $verificationCode;

            // Send the email
            $mail->send();

            session_start();

            $userVerificationID = $conn->lastInsertId();
            $_SESSION['user_verification_id'] = $userVerificationID;

            echo "
            <script>
                alert('Check your email for the verification code.');
                window.location.href = '../verification.php';
            </script>
            ";

            $conn->commit();
        } else {
            echo "
            <script>
                alert('User Already Exists');
                window.location.href = '../index.php';
            </script>
            ";
        }
    } catch (PDOException $e) {
        $conn->rollBack();
        echo "Error: " . $e->getMessage();
    }
}

if (isset($_POST['verify'])) {
    try {
        $userVerificationID = $_POST['user_verification_id'];
        $verificationCode = $_POST['verification_code'];

        $stmt = $conn->prepare("SELECT `verification_code` FROM `user` WHERE `user_id` = :user_verification_id");
        $stmt->execute([
            'user_verification_id' => $userVerificationID,
        ]);
        $codeExist = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($codeExist && $codeExist['verification_code'] == $verificationCode) {
            // Verification successful, session can be destroyed or used for login
            session_destroy();
            echo "
            <script>
                alert('Verification successful!');
                window.location.href = 'http://127.0.0.1:5000/';
            </script>
            ";
            // 上面直接放link
        } else {
            // Delete the user if verification failed
            $deleteStmt = $conn->prepare("DELETE FROM `user` WHERE `user_id` = :user_verification_id");
            $deleteStmt->execute([
                'user_verification_id' => $userVerificationID
            ]);

            echo "
            <script>
                alert('Incorrect Verification Code. Please Register Again.');
                window.location.href = '../index.php';
            </script>
            ";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
