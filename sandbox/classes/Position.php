<?php

/**
 * Created by PhpStorm.
 * User: Gizmo
 * Date: 7/8/2017
 * Time: 8:17 AM
 */
class Position
{
    public function INSERT_POS($campus, $pos) {
        global $db;

        //Check to see if the position is already inserted
        $sql = "SELECT *
                FROM positions
                WHERE camp = ?
                AND pos = ?
                LIMIT 1";
        if(!$stmt = $db->prepare($sql)) {
            echo $stmt->error;
        } else {
            $stmt->bind_param("ss", $campus, $pos);
            $stmt->execute();
            $result = $stmt->get_result();
        }
        if($result->num_rows > 0) {
            echo "<div class='alert alert-danger'>Sorry the position you entered is already inserted in the database.</div>";
        } else {
            //Insert position in the database
            $sql = "INSERT INTO positions(camp, pos)VALUES(?, ?)";
            if(!$stmt = $db->prepare($sql)) {
                echo $stmt->error;
            } else {
                $stmt->bind_param("ss", $campus, $pos);
            }
            if($stmt->execute()) {
                echo "<div class='alert alert-success'>Position was inserted successfully.</div>";
            }
            $stmt->free_result();
        }
        return $stmt;
    }

    public function READ_POS() {
        global $db;

        //Read positions in every organization
        $sql = "SELECT *
                FROM positions
                ORDER BY camp ASC";
        if(!$stmt = $db->prepare($sql)) {
            echo $stmt->error;
        } else {
            $stmt->execute();
            $result = $stmt->get_result();
        }
        $stmt->free_result();
        return $result;
    }

    public function EDIT_POS($pos_id) {
        global $db;

        //Edit position
        $sql = "SELECT *
                FROM positions
                WHERE id = ?
                LIMIT 1";
        if(!$stmt = $db->prepare($sql)) {
            echo $stmt->error;
        } else {
            $stmt->bind_param("i", $pos_id);
            $stmt->execute();
            $result = $stmt->get_result();
        }
        $stmt->free_result();
        return $result;
    }

    public function UPDATE_POS($campus, $pos, $pos_id) {
        global $db;

        //Update position
        $sql = "UPDATE positions
                SET camp = ?, pos = ?
                WHERE id = ?
                LIMIT 1";
        if(!$stmt = $db->prepare($sql)) {
            echo $stmt->error;
        } else {
            $stmt->bind_param("ssi", $campus, $pos, $pos_id);
        }

        if($stmt->execute()) {
            echo "<div class='alert alert-success'>Position was updated successfully.<a href='http://localhost/voting_system/sandbox/add_pos.php'><span class='glyphicon glyphicon-backward'></span></a></div>";
        }
        $stmt->free_result();
        return $stmt;
    }

    public function DELETE_POS($pos_id) {
        global $db;

        //Read positions in every Campus
        $sql = "DELETE FROM positions
                WHERE id = ? LIMIT 1";
        if(!$stmt = $db->prepare($sql)) {
            echo $stmt->error;
        } else {
            $stmt->bind_param("i", $pos_id);
        }

        if($stmt->execute()) {
            header("location: http://localhost/voting_system/sandbox/add_pos.php");
            exit();
        }
        $stmt->free_result();
        return $stmt;
    }

    public function READ_POS_BY_ORG($camp) {
        global $db;

        $sql = "SELECT *
                FROM positions
                WHERE camp = ?";
        if(!$stmt = $db->prepare($sql)) {
            echo $stmt->error;
        } else {
            $stmt->bind_param("s", $camp);
            $stmt->execute();
            $result = $stmt->get_result();
        }
        $stmt->free_result();
        return $result;
    }
}