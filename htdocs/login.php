<?php
$email = $_POST['email'];
$password = $_POST['password'];



$con = new mysqli("localhost","root","","logindb");
if($con->connect_error) {
    die("Failed to connect : " . $con->connect_error);
} else {
    $stmt = $con->prepare("select * from registration where email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt_result = $stmt->get_result();
    if($stmt_result->num_rows > 0) {
        $data = $stmt_result->fetch_assoc();

        if ($data['password'] !== $password) {
            echo "<script type='text/javascript'>alert('Oeps! Probeer het opnieuw..')</script>";
        }
        if ($data['password'] === $password) {
            echo "<h2>Login Succesfully</h2>";
            header("Location: Main.html");
        }
    }else{
        echo "<script type='text/javascript'>alert('Gebruikersnaam of Wachtwoord incorrect!')</script>";

    }
}
?>