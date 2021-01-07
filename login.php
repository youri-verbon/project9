<?php

// Initialize the session
session_start();
require_once "config.php";
// if(!isset($_SESSION["loggedin"])) 
//     { 
//         session_start(); 
//     } 
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: home.php");
    exit;
} else { 

}
   
// Include config file
 
// Define variables and initialize with empty values
$email = $wachtwoord = "";
$email_err = $wachtwoord_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if email is empty
    if(empty(trim($_POST["email"]))){
        $email_err = "Please enter email.";
    } else{
        $email = trim($_POST["email"]);
    }
    
    // Check if wachtwoord is empty
    if(empty(trim($_POST["password"]))){
        $wachtwoord_err = "Please enter your password.";
    } else{
        $wachtwoord = trim($_POST["password"]);
    }
    
    // Validate credentials
    if(empty($email_err) && empty($wachtwoord_err)){
        // Prepare a select statement
        $sql = "SELECT id_login, email, password FROM login WHERE email = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_email);
            
            // Set parameters
            $param_email = $email;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Store result
                mysqli_stmt_store_result($stmt);
                
                // Check if email exists, if yes then verify wachtwoord
                if(mysqli_stmt_num_rows($stmt) == 1){                    
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $id, $email, $hashed_password);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($wachtwoord, $hashed_password)){
                            // wachtwoord is correct, so start a new session
                            session_start();
                            
                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id_login"] = $id;
                            $_SESSION["email"] = $email;                            
                            
                            // Redirect user to welcome page
                            header("location: home.php");
                        } else{
                            // Display an error message if wachtwoord is not valid
                            $wachtwoord_err = "The password you entered was not valid.";
                        }
                    }
                } else{
                    // Display an error message if email doesn't exist
                    $email_err = "No account found with that email.";
                }
            } else{
                echo "Email incorrect and / or password incorrect.";
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
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
        <link rel="stylesheet" href="style.css">
        <link rel="icon" href="rivor-icon.jpg" type="imgae/x-icon" >
        <hr class="line">
    </head>
    <body>
    
        <h1>Admin Login</h1><br>

          <!-- <form>
            <div class="form-row">
              <div class="col-md-6 mb-3">
                <label for="validationDefault01">Email</label>
                <input type="email" class="form-control" id="validationDefault01" required>
              </div>
              <div class="col-md-6 mb-3">
                <label for="validationDefault02">Wachtwoord</label>
                <input type="password" class="form-control" id="validationDefault02" required>
              </div>
            </div>
            </div>
            <button class="btn btn-primary" type="submit">Inloggen</button> 
          </form> -->
          <div class="container">
          <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div class="form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" value="<?php echo $email; ?>">
                    <span class="help-block"><?php echo $email_err; ?></span>
                </div>
                <div class="form-group <?php echo (!empty($wachtwoord_err)) ? 'has-error' : ''; ?>">
                    <label>Wachtwoord</label>
                    <input type="password" name="password" class="form-control">
                    <span class="help-block"><?php echo $wachtwoord_err; ?></span>
                </div>
                <div class="form-group">
                   <button type="submit" class="btn btn-success margin-button" value="Login">Login</button>
                </div>
            </form>
          <a href="index.php"><button class="btn btn-danger margin-button">Terug</button></a>
          </div>

        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    </body>
</html>
