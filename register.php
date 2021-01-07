<?php
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$email = $wachtwoord = $confirm_wachtwoord = "";
$email_err = $wachtwoord_err = $confirm_wachtwoord_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate email
    $email = ($_POST["email"]);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $email_err = "Invalid email format";
    
    } 
    else{
        
        // Prepare a select statement
        $sql = "SELECT id_login FROM login WHERE email = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_email);
            
            // Set parameters
            $param_email = trim($_POST["email"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $email_err = "This email is already taken.";
                } else{
                    $email = trim($_POST["email"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }

    // Validate wachtwoord
    $wachtwoord = ($_POST["wachtwoord"]);
    
    $uppercase = preg_match('@[A-Z]@', $wachtwoord);
    $lowercase = preg_match('@[a-z]@', $wachtwoord);
    $number    = preg_match('@[0-9]@', $wachtwoord);
    $specialChars = preg_match('@[^\w]@', $wachtwoord);

    if(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($wachtwoord) < 8) {
        $wachtwoord_err = "Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character.";
    } else{
        $wachtwoord = trim($_POST["wachtwoord"]);
    }
    
    // Validate confirm wachtwoord
    if(empty(trim($_POST["confirm_wachtwoord"]))){
        $confirm_wachtwoord_err = "Please confirm wachtwoord.";     
    } else{
        $confirm_wachtwoord = trim($_POST["confirm_wachtwoord"]);
        if(empty($wachtwoord_err) && ($wachtwoord != $confirm_wachtwoord)){
            $confirm_wachtwoord_err = "wachtwoord did not match.";
        }
    }
    
    // Check input errors before inserting in database
    if(empty($email_err) && empty($wachtwoord_err) && empty($confirm_wachtwoord_err)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO login (email, password) VALUES (?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ss", $param_email, $param_wachtwoord);
            
            // Set parameters
            $param_email = $email;
            $param_wachtwoord = password_hash($wachtwoord, PASSWORD_DEFAULT); // Creates a wachtwoord hash
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                header("location: login.php");
            } else{
                echo "Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Close connection
    mysqli_close($link);
}
?>

<html>
    <head>
        <!-- CSS only -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
        <link rel="icon" href="rivor-icon.jpg" type="imgae/x-icon" >
        
        <!-- JS, Popper.js, and jQuery -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://unpkg.com/@popperjs/core@2/dist/umd/popper.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
        <script src="https://kit.fontawesome.com/8d488599c9.js" crossorigin="anonymous"></script>

        <title>Registreren</title>
    </head>
    <body>
        <div class="container-lg container-xs">
        <div class="wrapper">
            <h2>Registreren</h2>
            <p>Vul je account gegevens in.</p>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div class="form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" value="<?php echo $email; ?>">
                    <span class="help-block"><?php echo $email_err; ?></span>
                </div>    
                <div class="form-group <?php echo (!empty($wachtwoord_err)) ? 'has-error' : ''; ?>">
                    <label>Wachtwoord</label>
                    <input type="password" name="wachtwoord" class="form-control" value="<?php echo $wachtwoord; ?>">
                    <span class="help-block"><?php echo $wachtwoord_err; ?></span>
                </div>
                <div class="form-group <?php echo (!empty($confirm_wachtwoord_err)) ? 'has-error' : ''; ?>">
                    <label>Herhaal je wachtwoord</label>
                    <input type="password" name="confirm_wachtwoord" class="form-control" value="<?php echo $confirm_wachtwoord; ?>">
                    <span class="help-block"><?php echo $confirm_wachtwoord_err; ?></span>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-primary" value="Submit">
                </div>
            </form>
            <a href="index.php"><button class="btn btn-danger">Terug</button></a>
        </div>
        </div>
    </body>
</html>