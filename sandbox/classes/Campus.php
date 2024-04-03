<?php

class Campus
{
    public function INSERT_CAMPUS($campus) {
        global $db;

        //Check if the campus already exists in the database
        $sql = "SELECT *
                FROM campus
                WHERE camp = ?
                LIMIT 1";
        if(!$stmt = $db->prepare($sql)) {
            echo $stmt->error;
        } else {
            $stmt->bind_param("s", $campus);
            $stmt->execute();
            $result = $stmt->get_result();
        }

        if($result->num_rows > 0) {
            echo "<div class='alert alert-danger'>Sorry the Campus you are trying to insert already exists in the database.</div>";
        } else {
            //Successfully inserted
            $sql = "INSERT INTO campus(camp)VALUES(?)";
            if(!$stmt = $db->prepare($sql)) {
                echo $stmt->error;
            } else {
                $stmt->bind_param("s", $campus);
            }

            if($stmt->execute()) {
                echo "<div class='alert alert-success'>Campus was inserted successfully.</div>";
            }
            $stmt->free_result();
        }
        $result->free();
        return $stmt;
    }

    public function READ_CAMPUS() {
        global $db;

        $sql = "SELECT * FROM campus";
        if(!$stmt = $db->prepare($sql)) {
            echo $stmt->error;
        } else {
            $stmt->execute();
            $result = $stmt->get_result();
        }
        return $result;
    }

    public function EDIT_CAMPUS($camp_id) {
        global $db;

        $sql = "SELECT *
                FROM campus
                WHERE id = ?
                LIMIT 1";
        if(!$stmt = $db->prepare($sql)) {
            echo $stmt->error;
        } else {
            $stmt->bind_param("i", $camp_id);
            $stmt->execute();
            $result = $stmt->get_result();
        }
        $stmt->free_result();
        return $result;
    }

    public function UPDATE_CAMPUS($campus, $campus_id) {
        global $db;

        $sql = "UPDATE campus
                SET camp = ?
                WHERE id = ?
                LIMIT 1";
        if(!$stmt = $db->prepare($sql)) {
            echo $stmt->error;
        } else {
            $stmt->bind_param("si", $campus, $campus_id);
        }

        if($stmt->execute()) {
            echo "<div class='alert alert-success'>Update successful <a href='http://localhost/voting_system/sandbox/add_camp.php'><span class='glyphicon glyphicon-backward'></span> </a></div>";
        }
        $stmt->free_result();
        return $stmt;
    }

    public function DELETE_CAMPUS($camp_id) {
        global $db;

        //Delete campus
        $sql = "DELETE FROM campus
                WHERE id = ?
                LIMIT 1";
        if(!$stmt = $db->prepare($sql)) {
            echo $stmt->error;
        } else {
            $stmt->bind_param("i", $camp_id);
        }

        if($stmt->execute()) {
            header("location: http://localhost/voting_system/sandbox/add_camp.php");
            exit();
        }
        $stmt->free_result();
        return $stmt;
    }
}