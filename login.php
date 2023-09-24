
<?php
// Create a database connection file named db.php
$dbhost = "localhost"; // Database host
$dbuser = "root"; // Database user
$dbpass = ""; // Database password
$dbname = "project"; // Database name
$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname); // Connect to the database
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error()); // If connection fails, show error
}

// Create a login page file named login.php
session_start(); // Start a session

if (isset($_POST["submit"])) { // If login button is clicked, get the user input
  $uname = mysqli_real_escape_string($conn, $_POST["uname"]); // Get the username and escape special characters
  $pass = mysqli_real_escape_string($conn, $_POST["pass"]); // Get the password and escape special characters
  $sql = "SELECT * FROM register WHERE uname = '$uname' AND pass = '$pass'"; // Create a SQL query to select the user from the table
  $result = mysqli_query($conn, $sql); // Execute the query and get the result
  if (mysqli_num_rows($result) == 1) { // If there is one row in the result, that means the user exists and the password matches
    $row = mysqli_fetch_assoc($result); // Fetch the row as an associative array
    $_SESSION["uname"] = $row["uname"]; // Store the username in the session variable
    header("Location: home.php"); // Redirect to dashboard.php
  } else { // If there is no row in the result, that means the user does not exist or the password is wrong
    echo "Invalid username or password"; // Show an error message
  }
}
?>
