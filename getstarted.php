<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $errors = []; // Initialize an empty array to store errors

    // Connect to the database
    $servername = 'localhost';
    $username = 'giginetn_user';
    $password = 'Iamthatiam1!';
    $dbname = 'giginetn_gigi';
    
    // Create a connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check if the connection is successful
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
}

    // Check if the submitted form is for registration
    if (isset($_POST['signup'])) {
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $errors = []; // Initialize an empty array to store errors

    // Connect to the database
    $servername = 'localhost';
    $username = 'giginetn_user';
    $password = 'Iamthatiam1!';
    $dbname = 'giginetn_gigi';
    
    // Create a connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check if the connection is successful
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Get the form data
    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];

    // Validate the email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format";
    }

    // Check if the email already exists
    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $errors[] = '&#9888; Email already exists, please login';
    }
    

    // Validate the password length
    if (strlen($password) < 8) {
        $errors[] = "&#9888; Password must be at least 8 characters long";
    }

    // Check if password and confirm_password match
    if ($password !== $confirm_password) {
        $errors[] = "&#9888; Password and Confirm Password do not match";
    }

    if (empty($errors)) {
        // Step 6: Hash the password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        // Insert the data into the database
        $sql = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$hashed_password')";
        if ($conn->query($sql) === TRUE) {
            $errors[] = "Signup Success, Login";
        } else {
            $errors[] = "&#9888; Error: " . $sql . "<br>" . $conn->error;
        }
    }
  

}
} elseif (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $error = "";
    if (!empty($email) && !empty($password)) {
        // Define database connection parameters
        $servername = 'localhost';
        $username = 'giginetn_user';
        $password = 'Iamthatiam1!';
        $dbname = 'giginetn_gigi';
        

        try {
            // Create a PDO database connection
            $pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_password);

            // Set PDO error mode to exception
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Prepare and execute the SQL statement
            $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
            $stmt->execute([$email]);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($row) {
                $stored_hash = $row['password'];
                if (password_verify($password, $stored_hash)) {
                    $_SESSION['id'] = $row['id'];
                    $_SESSION['name'] = $row['name']; // Set the user's name in the session
                    header("Location: home.php"); // Redirect to dashboard or desired page
                    exit();
                } else {
                    $errors[] = "&#9888; Password is incorrect!";
                }
            } else {
                $errors[] = "&#9888; This email doesn't exist on our record!";
            }
        } catch (PDOException $e) {
            die("Database connection failed: " . $e->getMessage());
        }
    } else {
        $errors[] = "&#9888; All input fields are required!";
    }

    $_SESSION['login_error'] =  $errors;
    header("Location: getstarted.php"); // Redirect back to the login page
    exit();
}

// Close the connection (if needed)
 $pdo = null;
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="getstarted.css">
    <title>Get Started</title>
    <link rel="shortcut icon" href="logo.png" type="image/x-icon">
</head>
<body>
<div class="login-wrap">
    <div class="login-html">
        <input id="tab-1" type="radio" name="tab" class="sign-in" checked><label for="tab-1" class="tab">Sign In</label>
        <input id="tab-2" type="radio" name="tab" class="sign-up"><label for="tab-2" class="tab">Sign Up</label>

        <div class="login-form">
            <div class="sign-in-htm">
                <form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
                    <!-- Login form fields here -->
                    <div class="group">
                        <label for="user" class="label">Email</label>
                        <input id="user" type="email" name="email" class="input">
                    </div>
                    <div class="group">
                        <label for="pass" class="label">Password</label>
                        <input id="pass" type="password" name="password" class="input" data-type="password">
                    </div>
                    <div class="group">
                        <input type="submit" class="button" name="login" value="Sign In">
                    </div>
                     <div class="warning">
                        <?php if (!empty($_SESSION['login_error'])) {
                            foreach ($_SESSION['login_error'] as $error) {
                                echo $error . "<br>";
                            }

                            // Clear the login error messages from the session
                            unset($_SESSION['login_error']);
                        } ?>
                    <?php if (!empty($errors)) { foreach ($errors as $error) { echo $error . "<br>";}}?>
                </form>
                    </div>
                
                <div class="hr"></div>
                <div class="foot-lnk">
                  <!--  <a href="#forgot">Forgot Password?</a> --->
                </div>
            </div>
<div class="sign-up-htm">
    <form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
        <!-- Registration form fields here -->
        <div class="group">
            <label for="name" class="label">Full Name</label>
            <input id="name" type="text" name="name" class="input">
        </div>
        <div class="group">
            <label for="email" class="label">Email Address</label>
            <input id="email" type="email" name="email" class="input">
        </div>
        <div class="group">
            <label for="password" class="label">Password</label>
            <input id="password" type="password" name="password" class="input" data-type="password">
        </div>
        <div class="group">
            <label for="confirm_pass" class="label">Repeat Password</label>
            <input id="confirm_pass" type="password" name="confirm_password" class="input" data-type="password">
        </div>
        <div class="group">
            <input type="submit" class="button" name="signup" value="Sign Up">
        </div>
    </form>
    <div class="warning"><?php if (!empty($errors)) { foreach ($errors as $error) { echo $error . "<br>";}}?></div>
    <div class="hr"></div>
    <div class="foot-lnk">
        <label for="tab-1">Already Member?</a>
    </div>
</div>
</body>
</html>