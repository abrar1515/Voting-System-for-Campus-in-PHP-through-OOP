<?php

//Include authentication
require("../config/db.php");

require("../sandbox/classes/election.php");
?>
<!DOCTYPE HTML>
<html lang="en-US">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Election</title>
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
				<li><a href="add_admin.php"><span class="glyphicon glyphicon-plus-sign"></span>Add Admin</a></li>
				<li class="active" ><a href="add_elc.php"><span class="glyphicon glyphicon-plus-sign"></span>Add Election</a></li>
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
            <h4>Add Election</h4><hr>
            <?php
            if(isset($_POST['submit'])) {
				$election 		= trim($_POST['election']);
				$description	= trim($_POST['description']);
							$InsertElection = new Election();
							$rtnInsertAdmin = $InsertElection->INSERT_ELECTION($election,$description);
            }
            ?>
            <form method="POST" action="<?php $_SERVER['PHP_SELF']; ?>" role="form">
                <div class="form-group-sm">
                    <label for="election">Election</label>
                    <input required type="Date" name="election" class="form-control">
					<label for="description">Description</label>
                    <input required type="text" name="description" class="form-control">
                </div><hr>
                <div class="form-group-sm">
                    <input type="submit" name="submit" value="Submit" class="btn btn-info">
                </div>
            </form>
        </div>
		<?php
        $readElection = new Election();
        $rtnReadElection = $readElection->READ_ELECTION();
        ?>
        <div class="col-md-8">
            <h4>List of Elections</h4><hr>
			<?php if($rtnReadElection) { ?>
            <div class="table-responsive">
                
                <table class="table table-bordered table-condensed table-striped">
                    <tr>
						<th>Election id</th>
						<th>Description</th>
                        <th>Elections Date</th>
                        <th><span class="glyphicon glyphicon-edit"></span></th>
                        <th><span class="glyphicon glyphicon-remove"></span></th>
                    </tr>
						<?php while($rowElection = $rtnReadElection->fetch_assoc()) { ?>
					<tr>
						<td><?php echo $rowElection['id']; ?></td>
						<td><?php echo $rowElection['description']; ?></td>
						<td><?php echo $rowElection['election_date']; ?></td>
						<td><a href="http://localhost/voting_system/sandbox/edit_elc.php?id=<?php echo $rowElection['id']; ?>"><span class="glyphicon glyphicon-edit"></span></a></td>
                        <td><a href="http://localhost/voting_system/sandbox/delete_elc.php?id=<?php echo $rowElection['id']; ?>"><span class="glyphicon glyphicon-remove"></span></a></td>
					</tr>
					<?php } //End while ?>
				</table>
				<?php $rtnReadElection->free(); ?>
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