<?php
//Include database connection
require("../config/db.php");
?>
<html>


<?php
$camp = trim($_POST['camp']);
$sql = "SELECT * FROM positions WHERE camp = ?";
if(!$stmt = $db->prepare($sql)) {
    echo $stmt->error;
} else {
    $stmt->bind_param("s", $camp);
    $stmt->execute();
    $result = $stmt->get_result();
}
?>

<option value="">*****Select Position*****</option>
<?php if($result) { ?>
    <?php while($rowPos = $result->fetch_assoc()) { ?>
        <option value="<?php echo $rowPos['pos']; ?>"><?php echo $rowPos['pos']; ?></option>
    <?php } //End while ?>
<?php } //End if ?>

</html>