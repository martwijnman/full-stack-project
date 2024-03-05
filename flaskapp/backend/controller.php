<?php
// take form information
$name = $_POST["name"];
$email = $_POST["email"];
$data = $name . "," . $email;

//post it in csv file
file_put_contents('data.csv', $data, FILE_APPEND | LOCK_EX);


//make connection with sql

// Databasegegevens
$dbHost = "localhost";
$dbName = "flaskapp";
$dbUser = "root";
$dbPass = "";

$query = "INSERT INTO customers (name, email) VALUES(:name, :email);";
//3. Prepare'
$conn = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUser, $dbPass);
$statement = $conn->prepare($query);

//4. Execute
$statement->execute([
    ":name" => $name,
    ":email" => $email,
]);
$items = $statement->fetchAll(PDO::FETCH_ASSOC);
header("Location:.../index.php?msg=Melding opgeslagen");
