<?php

//Include authentication
require("process/auth.php");

//Include database connection
require("../config/db.php");

//Include class campus
require("classes/Campus.php");

//Include class Position
require("classes/Position.php");

//Include class Nominees
require("classes/Nominees.php");

//Include Calss Elections
require("classes/election.php");

?>
<!DOCTYPE HTML>
<html lang="en-US">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrator Login</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/style_admin.css">

    <script>
        function getPos(val) {
            $.ajax({
               type: "POST",
                url: "get_pos.php",
                data: 'camp='+val,
                success: function(data) {
					//alert(data);
                    $("#pos-list").html(data);
                }
            });
        }
    </script>
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
				<li><a href="add_elc.php"><span class="glyphicon glyphicon-plus-sign"></span>Add Election</a></li>
                <li><a href="add_camp.php"><span class="glyphicon glyphicon-plus-sign"></span>Add Campus</a></li>
                <li><a href="add_pos.php"><span class="glyphicon glyphicon-plus-sign"></span>Add Position</a></li>
                <li class="active"><a href="add_nominees.php"><span class="glyphicon glyphicon-plus-sign"></span>Add Candidate</a></li>
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
                $camp        	= trim($_POST['campus']);
				$description	= trim($_POST['description']);
                $pos        	= trim($_POST['position']);
                $name       	= trim($_POST['name']);
                $course     	= trim($_POST['course']);
                $year       	= trim($_POST['year']);
                $stud_id    	= trim($_POST['stud_id']);

                $insertNominee = new Nominees();
                $rtnInsertNominee = $insertNominee->INSERT_NOMINEE($camp, $description, $pos, $name, $course, $year, $stud_id);
            }
            ?>
            <h4>Add Nominees</h4><hr>
            <form method="POST" action="<?php $_SERVER['PHP_SELF']; ?>" role="form">
                <?php
                $readCamp = new Campus();
                $rtnReadCamp = $readCamp->READ_CAMPUS();
                ?>
                <div class="form-group-sm">
                    <label for="campus">Campus</label>
                    <?php if($rtnReadCamp) { ?>
                        <select required name="campus" class="form-control" id="org-list" onchange="getPos(this.value);">
                            <option value="">*****Select Campus*****</option>
                            <?php while($rowCamp = $rtnReadCamp->fetch_assoc()) { ?>
                                <option value="<?php echo $rowCamp['camp']; ?>"><?php echo $rowCamp['camp']; ?></option>
                            <?php } //End while ?>
                        </select>
						 <?php $rtnReadCamp->free(); ?>
						<?php } //End if ?>
                       
                </div>
				<?php
				 $readElection = new Election();
				$rtnReadElection = $readElection->READ_ELECTION();
				?>
				
				<div class="form-group-sm">
                    <label for="description">Description</label>
					<?php if($rtnReadElection) { ?>
                    <select required name="description" class="form-control">
                        <option value="">*****Select Description*****</option>
						<?php while($rowElc = $rtnReadElection->fetch_assoc()) { ?>
						<option value="<?php echo $rowElc['description']; ?>"><?php echo $rowElc['description']; ?></option>
						<?php } //End while ?>
                    </select>
					<?php $rtnReadElection->free(); ?>
						<?php } //End if ?>
					
				</div>
                <div class="form-group-sm">
                    <label for="position">Position</label>
                    <select required name="position" class="form-control" id="pos-list">
                        <option value="">*****Select Position*****</option>
                    </select>
					
                </div>
                <div class="form-group-sm">
                    <label for="name">Name</label>
                    <input required type="text" name="name" class="form-control" placeholder="FName, LName">
                </div>
                <div class="form-group-sm">
                    <label for="course">Course</label>
                    <select required name="course" class="form-control">
                        <option value="">*****Select Course*****</option>
                        <option value="BSIT">BSIT</option>
						<option value="BSIT">BSCS</option>
                        <option value="COE">COE</option>
                        <option value="BEE">BEE</option>
                        <option value="BSE">BSE</option>
                        <option value="BSA">BSA</option>
                        <option value="BSF">BSF</option>
                        <option value="BHRM">BHRM</option>
                        <option value="BSHT">BSHT</option>
                        <option value="CRIMINOLOGY">CRIMINOLOGY</option>
                        <option value="MIDWIFERY">MIDWIFERY</option>
                    </select>
                </div>
                <div class="form-group-sm">
                    <label for="year">Year</label>
                    <select required name="year" class="form-control">
                        <option value="">*****Select Year*****</option>
                        <option value="I">I</option>
                        <option value="II">II</option>
                        <option value="III">III</option>
                        <option value="IV">IV</option>
                        <option value="V">V</option>
                    </select>
                </div>
                <div class="form-group-sm">
                    <label for="stud_id">Student ID</label>
                    <input required type="text" name="stud_id" class="form-control">
                </div>
                <hr/>
                <div class="form-group-sm">
                    <input type="submit" name="submit" value="Submit" class="btn btn-info">
                </div>
            </form>
        </div>

        <?php
        $readNominees = new Nominees();
        $rtnReadNominees = $readNominees->READ_NOMINEE();
        ?>
        <div class="col-md-8">
            <h4>List of Nominees</h4><hr>
            <div class="table-responsive">
                <?php if($rtnReadNominees) { ?>
                <table class="table table-bordered table-condensed table-striped">
                    <tr>
                        <th>Campus</th>
						<th>Description</th>
                        <th>Position</th>
                        <th>Name</th>
                        <th>Course/Year</th>
                        <th>Student ID</th>
                        <th><span class="glyphicon glyphicon-edit"></span></th>
                        <th><span class="glyphicon glyphicon-remove"></span></th>
                    </tr>
                    <?php while($rowNom = $rtnReadNominees->fetch_assoc()) { ?>
                    <tr>
                        <td><?php echo $rowNom['camp']; ?></td>
						<td><?php echo $rowNom['description']; ?></td>
                        <td><?php echo $rowNom['pos']; ?></td>
                        <td><?php echo $rowNom['name']; ?></td>
                        <td><?php echo $rowNom['course'] . "-" . $rowNom['year']; ?></td>
                        <td><?php echo $rowNom['stud_id']; ?></td>
                        <td><a href="http://localhost/voting_system/sandbox/edit_nominee.php?id=<?php echo $rowNom['id']; ?>"><span class="glyphicon glyphicon-edit"></span></a></td>
                        <td><a href="http://localhost/voting_system/sandbox/delete_nominee.php?id=<?php echo $rowNom['id']; ?>"><span class="glyphicon glyphicon-remove"></span></a></td>
                    </tr>
                    <?php } //End while ?>
                </table>
                    <?php $rtnReadNominees->free(); ?>
                <?php } //end if ?>
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
<script type="text/javascript" src="../assets/js/jquery.min.js"></script>
<script src="../assets/js/bootstrap.min.js"></script>

</body>
</html>