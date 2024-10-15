<?php

include ('conn.php');

$updateUserID = $_POST['user_id'];
$updateUsername = $_POST['username'];
$updateEmail = $_POST['email'];
$updatePassword = $_POST['password'];

try {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Hash the password

    $conn->beginTransaction();

    // Check if email already exists
    $stmt = $conn->prepare("SELECT `email` FROM `user` WHERE `email` = :email ");
    $stmt->execute([
        'email' => $email
    ]);
    $nameExist = $stmt->fetch(PDO::FETCH_ASSOC);

    if (empty($nameExist)) {
        $conn->beginTransaction();

        $updateStmt = $conn->prepare("UPDATE `user` SET `username` = :username, `email` = :email,  `password` = :password WHERE `user_id` = :userID");
        $updateStmt->bindParam(':username', $updateUsername, PDO::PARAM_STR);
        $updateStmt->bindParam(':email', $updateEmail, PDO::PARAM_STR);
        $updateStmt->bindParam(':password', $updatePassword, PDO::PARAM_STR);
        $updateStmt->bindParam(':userID', $updateUserID, PDO::PARAM_INT);
        $updateStmt->execute();

        echo "
        <script>
            alert('Updated Successfully');
            window.location.href = '../shap_plot.html';
        </script>
        ";

        $conn->commit();
    } else {
        echo "
        <script>
            alert('User Already Exist');
            window.location.href = '../index.php';
        </script>
        ";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}



?>

