<?php
session_start();
include ("Server.php");

if($conn->connect_error) {
    die('Connection Failed : '.$conn->connect_error);
} else {
    if (isset($_POST['name-change'])) {
        $ID = $_SESSION['ID'];
        $name = $_POST['name'];
        $sql_query = "UPDATE users
        SET name = '$name' 
        WHERE ID = '$ID' ";

        if ($conn->query($sql_query) === TRUE) {
            $sql = "SELECT * FROM users WHERE ID = '$ID'";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);
            $_SESSION['name'] = $row['name'];
            header("Location: Home2.php?success1=Name has been Changed.");
        } else {
            echo "Error: ";
        }
    }

    if (isset($_POST['pw-change'])) {
        $ID = $_SESSION['ID'];
        $old_pw = md5($_POST['old-password']);
        $new_pw = $_POST['new-password'];
        $c_new_pw = $_POST['c-new-password'];

        $sql = "SELECT * FROM users
        WHERE ID = '$ID' AND password = '$old_pw' ";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) === 1) {
            echo "test";
            if ($new_pw == $c_new_pw) {
                $new_pw = md5($new_pw);
                $query = "UPDATE users
                SET password = '$new_pw'
                WHERE ID = '$ID'";
                if ($conn->query($query) === TRUE) {
                    header("Location: Home2.php?success2=Password has been Changed.");
                } else {
                    echo "Error: ";
                }
            } else {
                header("Location: Home2.php?error2=Old or New Password are Invalid!");
            }
        } else {
            header("Location: Home2.php?error2=Old or New Password are Invalid!");
        }

    } 
}

$conn->close();
?>