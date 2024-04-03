<?php

class Admin
{
    public function INSERT_ADMIN($uname,$pass,$name, $email, $contact, $profile) {
        global $db;

       //Check to see if the voter exists
        $sql = "SELECT *
                FROM admin
                WHERE username = ?
                LIMIT 1";
				
        if(!$stmt = $db->prepare($sql)) {
            echo $stmt->error;
        } else {
            $stmt->bind_param("s", $uname);
            $stmt->execute();
            $result = $stmt->get_result();
			//print_r ($result);
        } 
		
		
        if($result->num_rows > 0) {
            echo "<div class='alert alert-danger'>Sorry the Admin you entered already exists in the database.</div>";
        } else {
            //Insert admin
            $sql = "INSERT INTO admin(username, password, name, email, contact, profile_image)VALUES(?, ?, ?, ?, ?, ?)";
            if(!$stmt = $db->prepare($sql)) {
                echo $stmt->error;
            } else {
                $stmt->bind_param("ssssis", $uname,$pass,$name, $email, $contact, $profile);
            }
            if($stmt->execute()) {
                echo "<div class='alert alert-success'>Admin was inserted successfully.</div>";
            }
            $stmt->free_result();
        }
        return $stmt;
    }

    public function READ_ADMIN() {
        global $db;

        $sql = "SELECT *
                FROM admin
                ORDER BY name ASC";
        if(!$stmt = $db->prepare($sql)) {
            echo $stmt->error;
        } else {
            $stmt->execute();
            $result = $stmt->get_result();
        }
        $stmt->free_result();
        return $result;
    }

    public function EDIT_ADMIN($id) {
        global $db;

        $sql = "SELECT *
                FROM admin
                WHERE id = ?
                LIMIT 1";
        if(!$stmt = $db->prepare($sql)) {
            echo $stmt->error;
        } else {
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();
        }
        $stmt->free_result();
        return $result;
    }

    public function UPDATE_ADMIN($name, $username, $password, $email, $contact,$profile_image, $admin_id) {
        global $db;

        $sql = "UPDATE admin
                SET name = ?, username = ?, password = ?, email = ?, contact = ?, profile_image = ?
                WHERE id = ? LIMIT 1";
        if(!$stmt = $db->prepare($sql)) {
            echo $stmt->error;
        } else {
            $stmt->bind_param("ssssiss", $name, $username, $password, $email, $contact,$profile_image, $admin_id);
        }

        if($stmt->execute()) {
            echo "<div class='alert alert-success'>Admin was updated successfully.<a href='http://localhost/voting_system/sandbox/add_admin.php'><span class='glyphicon glyphicon-backward'></span></a></div>";
        }
        $stmt->free_result();
        return $stmt;
    }

    public function DELETE_ADMIN($username) {
        global $db;

        $sql = "DELETE FROM admin
                WHERE id = ? LIMIT 1";
        if(!$stmt = $db->prepare($sql)) {
            echo $stmt->error;
        } else {
            $stmt->bind_param("s", $username);
        }

        if($stmt->execute()) {
            header("location: http://localhost/voting_system/sandbox/add_admin.php");
            exit();
        }
        $stmt->free_result();
        return $stmt;
    }
}