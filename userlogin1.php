<?php

$is_invalid=false;
if($_SERVER["REQUEST_METHOD"]==="POST"){

    $mysqli=require __DIR__ . "/database1.php";

    $sql=sprintf("SELECT * FROM register
            WHERE email='%s'",
            $mysqli->real_escape_string($_POST["email"]));

    $result=$mysqli->query($sql);

    $register=$result->fetch_assoc();

   // var_dump($register);
   if($register){

    if(password_verify($_POST["password"], $register["password_hash"])){

        //die("Login successful");
        session_start();

        session_regenerate_id();

        $_SESSION["user_id"]=$register["id"];

        header("Location: addcolleges.html");
        exit;

    }
   // else{
    //    die("Invalid login");
   // }
   }
   $is_invalid=true;
    //exit;
}



?>

<!DOCTYPE html>
<html>
    <head>
        <title>Login and Registration form</title>
        <link rel="stylesheet" href="userstyle.css">
    
        
    </head>
    <body>
        <div class="hero">
            <div class="form-box">
                <div class="button-box">
                    <div id="btn"></div>
                    <button type="button" class="toggle-btn" onclick="login()" >Log In</button>
                    <!-- <button type="button" class="toggle-btn" onclick="Register()">Register</button> -->
                </div>
                <form id="login" method="post"  class="input-group">
                        <?php if($is_invalid): ?>
                            <em>Invalid login</em>
                        <?php endif; ?>
                    <input type="email" class="input-field" placeholder="email Id" name="email" required> 
                    <input type="password" class="input-field" placeholder="Password" name="password" required>
                   <button type="submit" class="submit-btn">LogIn</button>
                </form>
                <form action="userregister.php" method="post" id="Register" class="input-group" novalidate>
                    <input type="text" class="input-field" placeholder="User Id" name="name" required> 
                    <input type="email" class="input-field" placeholder="Email Id" name="email" required> 
                    <input type="password" class="input-field" placeholder="Password" name="password" required>
                    <input type="password" class="input-field" placeholder="Renter-password" name="password-conform" required>
                   <button type="submit" class="submit-btn">Register</button>
                </form>
            </div>
        </div>
        <script>
            var x=document.getElementById("login");
            var y=document.getElementById("Register");
            var z=document.getElementById("btn");
            function Register(){
                x.style.left="-400px";
                y.style.left="50px";
                z.style.left="110px";
            }
            function login(){
                x.style.left="50px";
                y.style.left="450px";
                z.style.left="0px";
            }
        </script>
    </body>
</html>