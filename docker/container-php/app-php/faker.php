<?php
require_once 'vendor/autoload.php'; // Include the Faker library

$faker = Faker\Factory::create(); // Create a new instance of the Faker generator

// Connect to the database
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "app-php";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Generate and insert 10 fake users
for ($i = 0; $i < 1000; $i++) {
  $email = $faker->email;
  $name = $faker->name;
  $created = $faker->dateTimeThisMonth->format('Y-m-d H:i:s');
  $level = $faker->numberBetween(1, 10);

  $sql = "INSERT INTO users (email, name, created, level) VALUES ('$email', '$name', '$created', $level)";

  try {
    if ($conn->query($sql) === TRUE) {
      echo "($i) New record created successfully\n";
    } else {
      echo "Error: " . $sql . "\n" . $conn->error;
    }
    
  }
  catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
    echo "Error: " . $sql . "\n" . $conn->error;
  }
}

$conn->close(); // Close the database connection
?>