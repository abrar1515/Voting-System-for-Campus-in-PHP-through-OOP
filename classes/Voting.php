<?php

class Voting
{
    public function READ_CAMPUS() {
        global $db;

        $sql = "SELECT * FROM campus ORDER BY camp ASC";
        if(!$stmt = $db->prepare($sql)) {
            echo $stmt->error;
        } else {
            $stmt->execute();
            $result = $stmt->get_result();
        }
        return $result;
    }

    public function READ_POSITION($camp) {
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

    public function READ_NOMINEES($camp, $pos) {
        global $db;

        $sql = "SELECT *
                FROM nominees
                WHERE camp = ?
                AND pos = ?";
        if(!$stmt = $db->prepare($sql)) {
            echo $stmt->error;
        } else {
            $stmt->bind_param("ss", $camp, $pos);
            $stmt->execute();
            $result = $stmt->get_result();
        }
        $stmt->free_result();
        return $result;
    }

    public function VALIDATE_VOTE($camp, $pos, $voters_id) {
        global $db;

        //Check to see if the voter votes already
        $sql = "SELECT *
                FROM votes
                WHERE camp = ?
                AND pos = ?
                AND voters_id = ?
                LIMIT 1";
        if(!$stmt = $db->prepare($sql)) {
            echo $stmt->error;
        } else {
            $stmt->bind_param("ssi", $camp, $pos, $voters_id);
            $stmt->execute();
            $result = $stmt->get_result();
        }
        $stmt->free_result();
        return $result;
    }

    public function VOTE_NOMINEE($camp, $pos, $candidate_id, $voters_id) {
        global $db;

        //Check to see if the voter votes already
        $sql = "SELECT *
                FROM votes
                WHERE camp = ?
                AND pos = ?
                AND voters_id = ?
                LIMIT 1";
        if(!$stmt = $db->prepare($sql)) {
            echo $stmt->error;
        } else {
            $stmt->bind_param("ssi", $camp, $pos, $voters_id);
            $stmt->execute();
            $result = $stmt->get_result();
        }

        if($result->num_rows > 0) {
            echo "<div class='alert alert-danger'>Sorry you voted in that position already.</div>";
        } else {
            //Vote successful.
            $sql = "INSERT INTO votes(camp, pos, candidate_id, voters_id)VALUES(?, ?, ?, ?)";
            if(!$stmt = $db->prepare($sql)) {
                echo $stmt->error;
            } else {
                $stmt->bind_param("ssii", $camp, $pos, $candidate_id, $voters_id);
            }

            if($stmt->execute()) {
                echo "<div class='alert alert-success'>Vote successful.</div>";
            }
            $stmt->free_result();
        }
        return $stmt;
    }


}