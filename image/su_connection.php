<?php

    // Retrieve form data
    $fullname = $_POST['fullname'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];


    $conn = new mysqli('localhost', 'root', '', 'registration1'); // Removed backticks


if($conn->connect_error){
    die('connection failed : ' .$conn->connect_error);
    // die ("not connected ". mysqli_error());
}
else{
    // echo "connected Successfully";
    $stmt = $conn->prepare("insert into registration1 (fullname,username,email,password)
    values(?,?,?,?)");
    $stmt->bind_param("ssss", $fullname, $username, $email, $password);

    $stmt->execute();
    echo "registration Completed"; // Corrected typo
    $stmt->close();
    $conn->close();

}  
?>
