<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>dashboard</title>
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
    <div class="container">
        <h1>List Employee</h1>
                    <?php
                    include "connect_database.php";
                $do = isset($_GET['do']) ? $_GET['do'] : 'Manage';
                    //    manage employee
                if ($do == 'Manage') {
                    ?>
                                    
					<table class="table-content">
                        <thead>
                            <tr>
							<td>#ID</td>
							<td>first name</td>
							<td>last name</td>
							<td>email</td>
							<td>Control</td>
						</tr>
                    </thead>
						<tbody>
                            	<?php
                          $show=$database->prepare("SELECT * FROM employee");
                            $show->execute();
                            $items=$show->fetchAll();
							foreach($items as $item) {
								echo "<tr>";
									echo "<td>" . $item['id'] . "</td>";
									echo "<td>" . $item['firstname'] . "</td>";
									echo "<td>" . $item['lastname'] . "</td>";
									echo "<td>" . $item['email'] . "</td>";

									echo "<td>
										<a href='dashbord.php?do=edit&emplid=" . $item['id'] . "' class='btn_edit'><button>edit</button> </a>
										<a href='dashbord.php?do=delete&emplid=" . $item['id'] . "' class='btn_delete'> <button>delete</button> </a>";
									echo "</td>";
								echo "</tr>";
							}
						?>
                        </tbody>
					
						
					</table>
				 </div>
      <?php
    
      
        //    delete =employee
	} elseif ($do == 'delete') {
         if( isset($_GET['emplid']) && is_numeric($_GET['emplid'])){
            $emplid=$_GET['emplid'];
            $delet=$database->prepare("DELETE  FROM employee WHERE id=:emplid");
            $delet->bindParam('emplid',$emplid);
            $delet->execute();
                //  back to dashboard
            header("Refresh:1; url=dashbord.php");
         }

        //   edit employe
	} elseif ($do == 'edit') {
        if( isset($_GET['emplid']) && is_numeric($_GET['emplid'])){
            $emplid=$_GET['emplid'];
            $select=$database->prepare("SELECT * FROM employee WHERE id=:emplid");
            $select->bindParam('emplid',$emplid);
            $select->execute();
            $row=$select->fetch();
         
         }
        ?>
    <div class="box">
        <h1>Edit employee</h1>
        <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
        <input type="hidden" name="emplid" value="<?php echo $emplid ?>" />
        <label for="first">First name</label><br>
             <input type="text" name="first" value="<?php echo $row['firstname'];?>" id=""><br>
             <label for="last">Last name</label><br>
             <input type="text" name="last" value="<?php echo $row['lastname'];?>" id=""><br>
             <label for="email">email</label><br>
             <input type="email" name="email" value="<?php echo $row['email'];?>" id=""><br>
             <button type="submit" name="save">save employee</button>
        </form>
    </div>
        <?php

		if(isset($_POST['save'])){
            $emplid=$_GET['emplid'];
            $firstname=$_POST['first'];
            $lastname=$_POST['last'];
            $email=$_POST['email'];
            $update=$database->prepare("UPDATE employee SET firstname=:firstname,lastname=:lastname,email=:email WHERE id=:emplid");
            $update->bindParam('emplid',$emplid);
            $update->bindParam("firstname",$firstname); 
            $update->bindParam("lastname",$lastname); 
            $update->bindParam("email",$email); 
            $update->execute();
                    // back to dashborad
            header("Refresh:1; url=dashbord.php");
        }

	}
        ?>
    </div>
</body>
</html>