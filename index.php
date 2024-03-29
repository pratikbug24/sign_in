<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Page</title>
    <link rel="stylesheet" href="php.css">
</head>
<body>
    
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <h1>Registration Form</h1>
    <div class="input-field">
    <div class="input-field">
        <input type="text" name="username" required>
        <label>Enter your Username</label>
      </div>
      <div class="input-field">
        <input type="password" name="password" required>
        <label>Enter your password</label>
      </div>
        <input type="submit" name="submit" value="Register">
       </form>
    <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $database = "registration";

        $conn = new mysqli($servername, $username, $password, $database);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $username = $password = "";
        $usernameErr = $passwordErr = "";

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (empty($_POST["username"])) {
                $usernameErr = "Username is required";
            } else {
                $username = test_input($_POST["username"]);
            }

            if (empty($_POST["password"])) {
                $passwordErr = "Password is required";
            } else {
                $password = test_input($_POST["password"]);
            }

                $sql = "INSERT INTO users (username, password) VALUES ('$username', '$password')";

                if ($conn->query($sql) === TRUE) {
                    echo "Registration successful!";
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            }

        function test_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        $conn->close();
    ?>

    
</body>
</html>