<?php
session_start();

// Change this to your connection info.
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'capitalg';
$DATABASE_PASS = 'Edwards12345@';
$DATABASE_NAME = 'capitalg_capitalguard';

// Try and connect using the info above.
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);

if (mysqli_connect_errno()) {
    // If there is an error with the connection, stop the script and display the error.
    exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}

// Now we check if the data from the login form was submitted, isset() will check if the data exists.
if (!isset($_POST['username'], $_POST['password'])) {
    // Could not get the data that should have been sent.
    exit('Please fill both the username and password fields!');
}

// Prepare our SQL, preparing the SQL statement will prevent SQL injection.
if ($stmt = $con->prepare('SELECT id, password FROM accounts WHERE username = ?')) {
    // Bind parameters (s = string, i = int, b = blob, etc), in our case the username is a string so we use "s"
    $stmt->bind_param('s', $_POST['username']);
    $stmt->execute();
    // Store the result so we can check if the account exists in the database.
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $password);
        $stmt->fetch();
        // Account exists, now we verify the password.
        // Note: remember to use password_hash in your registration file to store the hashed passwords.
        if ($_POST['password'] === $password) {
            // Verification success! User has logged-in!

            // Insert a record into the "ip_address" table (assuming you have this table in your MySQL database)
            $userID = $id;
            $ipAddress = $_SERVER['REMOTE_ADDR'];

            // Prepare the SQL statement to insert data into the "ip_address" table
            if ($stmtSusp = $con->prepare('INSERT INTO ip_address (account_id, ip_address) VALUES (?, ?)')) {
                // Bind the parameters (i = integer, s = string)
                $stmtSusp->bind_param('is', $userID, $ipAddress);

                // Execute the statement to insert the record
                if ($stmtSusp->execute()) {
                    // Record inserted successfully
                } else {
                    // Error occurred while inserting the record
                    echo 'Error: ' . $stmtSusp->error;
                }

                // Close the statement
                $stmtSusp->close();
            }

            // Fetch the existing login history from the database
            $loginHistory = ''; // Initialize an empty string

            $stmtHistory = $con->prepare('SELECT loginHistory FROM accounts WHERE id = ?');
            $stmtHistory->bind_param('i', $id);
            $stmtHistory->execute();
            $stmtHistory->bind_result($loginHistory);
            $stmtHistory->fetch();
            $stmtHistory->close();

            // Create a string with the current login time
            $currentLoginTime = date('Y-m-d H:i:s');

            // Append the current login time to the existing login history with a semicolon separator
            if (!empty($loginHistory)) {
                $updatedLoginHistory = $loginHistory . ';' . $currentLoginTime;
            } else {
                $updatedLoginHistory = $currentLoginTime; // If there's no existing history, just set the current time
            }

            // Update the loginHistory column in the accounts table
            $stmtUpdateHistory = $con->prepare('UPDATE accounts SET loginHistory = ? WHERE id = ?');
            $stmtUpdateHistory->bind_param('si', $updatedLoginHistory, $id);

            if ($stmtUpdateHistory->execute()) {
                // Record updated successfully
            } else {
                // Error occurred while updating the record
                echo 'Error: ' . $stmtUpdateHistory->error;
            }

            $stmtUpdateHistory->close();

            sleep(3);
            // Continue with the login process
            // Create sessions, so we know the user is logged in; they basically act like cookies but remember the data on the server.
            session_regenerate_id();
            $_SESSION['loggedin'] = TRUE;
            $_SESSION['name'] = $_POST['username'];
            $_SESSION['id'] = $id;
            header('Location: dashboard.php');
        } else {
            // Incorrect password
            echo 'Login failed. Please check your credentials.';
        }
    } else {
        // Incorrect username
        echo 'Login failed. Please check your credentials.';
    }

    $stmt->close();
}
?>
