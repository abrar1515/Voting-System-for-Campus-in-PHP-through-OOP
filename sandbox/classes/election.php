<?php

class Election
{
	public function INSERT_ELECTION($election,$description){
		global $db;

        //Check to see if the election exists
        $sql = "SELECT *
                FROM election
                WHERE election_date = ?
                LIMIT 1";
        if(!$stmt = $db->prepare($sql)) {
            echo $stmt->error;
        } else {
            $stmt->bind_param("s", $election);
            $stmt->execute();
            $result = $stmt->get_result();
        }

        if($result->num_rows > 0) {
            echo "<div class='alert alert-danger'>Sorry the Election you entered already exists in the database.</div>";
        } else {
            //Insert voter
            $sql = "INSERT INTO election(description,election_date)VALUES(?, ?)";
            if(!$stmt = $db->prepare($sql)) {
                echo $stmt->error;
            } else {
                $stmt->bind_param("ss", $description, $election);
            }
            if($stmt->execute()) {
                echo "<div class='alert alert-success'>Election was inserted successfully.</div>";
            }
            $stmt->free_result();
        }
        return $stmt;
    }
	public function READ_ELECTION() {
        global $db;

        $sql = "SELECT *
                FROM election
                ORDER BY election_date ASC";
        if(!$stmt = $db->prepare($sql)) {
            echo $stmt->error;
        } else {
            $stmt->execute();
            $result = $stmt->get_result();
			//print_r ($result);
        }
        $stmt->free_result();
        return $result;
    }
	public function EDIT_ELECTION($election_id) {
        global $db;

        $sql = "SELECT *
                FROM election
                WHERE id = ?
                LIMIT 1";
        if(!$stmt = $db->prepare($sql)) {
            echo $stmt->error;
        } else {
            $stmt->bind_param("i", $election_id);
            $stmt->execute();
            $result = $stmt->get_result();
        }
        $stmt->free_result();
        return $result;
    }

    public function UPDATE_ELECTION($election,$description,$elc_id) {
        global $db;

        $sql = "UPDATE election
                SET election_date = ?, description = ?
                WHERE id = ? LIMIT 1";
        if(!$stmt = $db->prepare($sql)) {
            echo $stmt->error;
        } else {
            $stmt->bind_param("ssi", $election,$description,$elc_id);
        }

        if($stmt->execute()) {
            echo "<div class='alert alert-success'>Election was updated successfully.<a href='http://localhost/voting_system/sandbox/add_elc.php'><span class='glyphicon glyphicon-backward'></span></a></div>";
        }
        $stmt->free_result();
        return $stmt;
    }

    public function DELETE_ELECTION($elc_id) {
        global $db;

        $sql = "DELETE FROM election
                WHERE id = ?
				LIMIT 1";
        if(!$stmt = $db->prepare($sql)) {
            echo $stmt->error;
        } else {
            $stmt->bind_param("i", $elc_id);
        }

        if($stmt->execute()) {
            header("location: http://localhost/voting_system/sandbox/add_elc.php");
            exit();
        }
        $stmt->free_result();
        return $stmt;
    }

}
?>