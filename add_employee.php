<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>addemployee</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <nav class="header">
       <ul>
           <li>
               <a href="add_employee.php">add employee</a>
        
            </li>
            <li class="line">|</li>
           <li>
               <a href="dashbord.php">list employee</a>
        
            </li>
       </ul>
    </nav>
    <div class="box">
        <h1>Create employee</h1>
        <?php
        include "connect_database.php";
        if(isset($_POST['save'])){
            $firstname=$_POST['first'];
            $lastname=$_POST['last'];
            $email=$_POST['email'];
            $insert=$database->prepare("INSERT INTO employee(firstname,lastname,email) VALUES(:firstname,:lastname,:email)");
            $insert->bindParam("firstname",$firstname); 
            $insert->bindParam("lastname",$lastname); 
            $insert->bindParam("email",$email); 

            if($insert->execute()){
                echo "<div style='background:green;padding:5px;margin:5px 0;'>
                  data inserted succsessfly
                </div>";
            }
        }
        
        ?>
        <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
        
        <label for="first">First name</label><br>
             <input type="text" name="first" id=""><br>
             <label for="last">Last name</label><br>
             <input type="text" name="last" id=""><br>
             <label for="email">email</label><br>
             <input type="email" name="email" id=""><br>
             <button type="submit" name="save">save employee</button>
        </form>
    </div>
</body>
</html>