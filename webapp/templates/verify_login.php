<?php

include('conn.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require '../phpmailer/src/Exception.php';
require '../phpmailer/src/PHPMailer.php';
require '../phpmailer/src/SMTP.php';

$mail = new PHPMailer(true);

if (isset($_POST['register'])) {
    try {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password']; 

        // Begin transaction
        $conn->beginTransaction();

        // Check if email already exists
        $stmt = $conn->prepare("SELECT `email` FROM `user` WHERE `email` = :email");
        $stmt->execute(['email' => $email]);
        $nameExist = $stmt->fetch(PDO::FETCH_ASSOC);

        if (empty($nameExist)) {
            // Generate a verification code
            $verificationCode = rand(100000, 999999);

            // Hash the password before storing
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

            // Insert user data with hashed password and verification code
            $insertStmt = $conn->prepare("INSERT INTO `user` (`user_id`, `username`, `email`, `password`, `verification_code`) VALUES (NULL, :username, :email, :password, :verification_code)");
            $insertStmt->bindParam(':username', $username, PDO::PARAM_STR);
            $insertStmt->bindParam(':email', $email, PDO::PARAM_STR);
            $insertStmt->bindParam(':password', $hashedPassword, PDO::PARAM_STR); 
            $insertStmt->bindParam(':verification_code', $verificationCode, PDO::PARAM_INT);
            $insertStmt->execute();

            // Commit transaction
            $conn->commit();

            // Send verification email
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'chanjunyu1141@gmail.com';
            $mail->Password   = 'your_smtp_password';
            $mail->SMTPSecure = 'ssl';
            $mail->Port       = 465;

            $mail->setFrom('chanjunyu1141@gmail.com', 'OTP Verification');
            $mail->addAddress($email);
            $mail->addReplyTo('chanjunyu1141@gmail.com', 'OTP Verification');

            $mail->isHTML(true);
            $mail->Subject = 'Verification Code';
            $mail->Body    = 'Your verification code is: ' . $verificationCode;

            $mail->send();

            session_start();
            $_SESSION['user_verification_id'] = $conn->lastInsertId();

            echo "<script>alert('Check your email for the verification code.'); window.location.href = './verification_login.php';</script>";

        } else {
            echo "<script>alert('Email already registered.'); window.location.href = './index.php';</script>";
        }

    } catch (PDOException $e) {
        $conn->rollBack();
        echo "Error: " . $e->getMessage();
    }
}

// Separate verification logic (e.g., in verify.php)
if (isset($_POST['verify'])) {
    session_start();
    $userVerificationID = $_SESSION['user_verification_id']; 
    $enteredVerificationCode = $_POST['verification_code'];

    try {
        $stmt = $conn->prepare("SELECT `verification_code` FROM `user` WHERE `user_id` = :user_verification_id");
        $stmt->execute(['user_verification_id' => $userVerificationID]);
        $codeExist = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($codeExist && $codeExist['verification_code'] == $enteredVerificationCode) {
            // OTP is correct
            echo "<script>alert('Verification successful!'); window.location.href = './shap_plot.php';</script>";
            session_destroy();
        } else {
            // OTP is incorrect
            $deleteStmt = $conn->prepare("DELETE FROM `user` WHERE `user_id` = :user_verification_id");
            $deleteStmt->execute(['user_verification_id' => $userVerificationID]);

            echo "<script>alert('Incorrect Verification Code. Please Register Again.'); window.location.href = './index.php';</script>";
        }

    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
