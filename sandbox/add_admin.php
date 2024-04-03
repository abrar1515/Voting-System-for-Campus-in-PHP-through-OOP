<?php

//Include database connection
require("../config/db.php");

//Include class Admin
require("../sandbox/classes/Admin.php");

//Include class Position
//require("classes/Position.php");

//Include class Nominees
//require("classes/Nominees.php");

?>
<!DOCTYPE HTML>
<html lang="en-US">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Administrator</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/style_admin.css">

  
</head>
<body>

<!-- Header -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php">Voting Sytem</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="admin_page.php"><span class="glyphicon glyphicon-home"></span></a></li>
				<li  class="active"><a href="add_admin.php"><span class="glyphicon glyphicon-plus-sign"></span>Add Admin</a></li>
				<li><a href="add_elc.php"><span class="glyphicon glyphicon-plus-sign"></span>Add Election</a></li>
                <li><a href="add_camp.php"><span class="glyphicon glyphicon-plus-sign"></span>Add Campus</a></li>
                <li><a href="add_pos.php"><span class="glyphicon glyphicon-plus-sign"></span>Add Position</a></li>
                <li><a href="add_nominees.php"><span class="glyphicon glyphicon-plus-sign"></span>Add Candidate</a></li>
                <li><a href="add_voters.php"><span class="glyphicon glyphicon-plus-sign"></span>Add Voters</a></li>
                <li><a href="vote_result.php"><span class="glyphicon glyphicon-plus-sign"></span>Vote Result</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-user"></span> <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="process/logout.php">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div><!-- /.navbar-collapse -->

    </div><!-- /.container-fluid -->
</nav>
<!-- End Header -->


          <div class="container">
    <div class="row">
        <div class="col-md-4">
		<?php 
            if(isset($_POST['submit'])) {
                $name       = trim($_POST['aname']);
                $uname      = trim($_POST['uname']);
                $pass       = trim($_POST['pwd']);
                $email      = trim($_POST['email']);
                $contact    = trim($_POST['contact']);
                $profile    = trim($_POST['profile']);
							$insertAdmin = new Admin();
							$rtnInsertAdmin = $insertAdmin->INSERT_ADMIN($uname, $pass, $name, $email,$contact,$profile);   
			}
				?>
			
            <h4>Add Admin</h4><hr>
      
            <form method="POST" action="<?php $_SERVER['PHP_SELF']; ?>" role="form">
                <div class="form-group-sm">
					<label for="organization">Admin Name</label>
                    <input required type="text" name="aname" class="form-control">
					<label for="organization">Username</label>
                    <input required type="text" name="uname" class="form-control">
					<label for="organization">Password</label>
                    <input required type="text" name="pwd" class="form-control">
					<label for="organization">Email</label>
                    <input required type="text" name="email" class="form-control">
					<label for="organization">Contact</label>
                    <input required type="text" name="contact" class="form-control">
					<label for="organization">Profile Image</label>
                    <input required type="file" name="profile">
                </div><hr>
                <div class="form-group-sm">
                    <input type="submit" name="submit" value="Submit" class="btn btn-info">
                </div>
				
			</form>

				<?php /*
		if(isset($_POST['submit'])){
		$name		= $_POST['aname'];
		$uname		= $_POST['uname'];
		$pass		= $_POST['pwd'];
		$email		= $_POST['email'];
		$contact	= $_POST['contact'];
		$profile	= $_POST['profile'];
	$query = "INSERT INTO `admin`( `username`, `password`, `name`, `email`, `contact`, `profile_image`) VALUES ('$uname','$pass','$name','$email',$contact,'$profile')";
	$result = mysqli_query($conx,$query);
	if($result){echo"Data Successfully Inserted";} else {echo"Data Not Inserted";}
	} */
?>
        </div>
		<?php
        $readAdmins = new ADMIN();
        $rtnReadAdmins = $readAdmins->READ_ADMIN();
        ?>
        <div class="col-md-8">
            <h4>List of Admins</h4><hr>
				 <?php if($rtnReadAdmins) { ?>
                <table class="table table-bordered table-condensed table-striped">
                    <tr>
                        <th>Admin id</th>
						<th>Admin Name</th>
                        <th>Username</th>
                        <th>Password</th>
                        <th>Email</th>
                        <th>Contact</th>
						<th>Profile Image</th>
                        <th><span class="glyphicon glyphicon-edit"></span></th>
                        <th><span class="glyphicon glyphicon-remove"></span></th>
					</tr>
					<?php while($rowAdmin = $rtnReadAdmins->fetch_assoc()) { ?>
					 <tr>
						<td><?php echo $rowAdmin['id']; ?></td>
                        <td><?php echo $rowAdmin['name']; ?></td>
                        <td><?php echo $rowAdmin['username']; ?></td>
                        <td><?php echo $rowAdmin['password']; ?></td>
						<td><?php echo $rowAdmin['email']; ?></td>
						<td><?php echo $rowAdmin['contact']; ?></td>
						<td><?php echo $rowAdmin['profile_image']; ?></td>
                        <td><a href="http://localhost/voting_system/sandbox/edit_admin.php?id=<?php echo $rowAdmin['id']; ?>"><span class="glyphicon glyphicon-edit"></span></a></td>
                        <td><a href="http://localhost/voting_system/sandbox/delete_admin.php?id=<?php echo $rowAdmin['id']; ?>"><span class="glyphicon glyphicon-remove"></span></a></td>
                    </tr>
                    <?php } //End while ?>
                </table>
				<?php $rtnReadAdmins->free(); ?>
                <?php } //End if ?>
            </div>
        </div>
    </div>
</div>




<!-- Footer -->
<nav class="navbar navbar-inverse navbar-fixed-bottom" role="navigation">

    <div class="container">
        <div class="navbar-text pull-left">

        </div>
    </div>

</nav>
<!-- End Footer -->

<script src="../assets/js/jquery.js"></script>
<script src="../assets/js/bootstrap.min.js"></script>

</body>
</html>
<?php
//Close database connection
//$db->close();