<?php
include "connection.php";
?>
<!DOCTYPE html>
<html>

<head>
    <title>Create Registration form with MySQL and PHP</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

</head>

<body>
    <div class='container'>
        <div class='row'>

            <div class='col-md-6'>

                <form method='post' action=''>

                    <h1>SignUp</h1>
                    <?php
                    // Display Error message
                    if (!empty($error_message)) {
                        ?>
                        <div class="alert alert-danger">
                            <strong>Error!</strong> <?= $error_message ?>
                        </div>

                    <?php
                    }
                    ?>

                    <?php
                    // Display Success message
                    if (!empty($success_message)) {
                        ?>
                        <div class="alert alert-success">
                            <strong>Success!</strong>
                            <?= $success_message ?>
                        </div>

                    <?php
                    }
                    ?>

                    <div class="form-group">
                        <label for="username">User Name:</label>
                        <input type="text" class="form-control" name="name" id="username" required="required"
                            maxlength="80">
                    </div>
                    <div class="form-group">
                        <label for="email">Email address:</label>
                        <input type="email" class="form-control" name="email" id="email" required="required"
                            maxlength="80">
                    </div>
                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input type="password" class="form-control" name="password" id="password" required="required"
                            maxlength="80">
                    </div>
                    <div class="form-group">
                        <label for="pwd">Confirm Password:</label>
                        <input type="password" class="form-control" name="cpassword" id="confirmpassword" onkeyup=''
                            required="required" maxlength="80">
                    </div>

                    <button type="submit" name="btnsignup" class="btn btn-default">Submit</button>
                </form>
            </div>

        </div>
    </div>
</body>

</html>




<?php
$error_message = "";
$success_message = "";

// Register user
if (isset($_POST['btnsignup'])) {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $confirmpassword = trim($_POST['cpassword']);

    $isValid = true;

    // Check fields are empty or not
    if ($username == '' || $email == '' || $password == '' || $confirmpassword == '') {
        $isValid = false;
        $error_message = "Please fill all fields.";
    }

    // Check if confirm password matching or not
    if ($isValid && ($password != $confirmpassword)) {
        $isValid = false;
        $error_message = "Confirm password not matching";
    }

    // Check if Email-ID is valid or not
    if ($isValid && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $isValid = false;
        $error_message = "Invalid Email-ID.";
    }

    if ($isValid) {

        // Check if Email-ID already exists
        $stmt = $con->prepare("SELECT * FROM register WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        if ($result->num_rows > 0) {
            $isValid = false;
            $error_message = "Email-ID is already existed.";
        }

    }

    // Insert records
    if ($isValid) {
        $insertSQL = "INSERT INTO register(username,email,password ) values(?,?,?)";
        $stmt = $con->prepare($insertSQL);
        $stmt->bind_param("sss", $username, $email, $password);
        $stmt->execute();
        $stmt->close();

        $success_message = "Account created successfully.";
    }
}
?>