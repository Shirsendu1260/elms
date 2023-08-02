<?php
    $connection = mysqli_connect("localhost", "root", "");
    $db = mysqli_select_db($connection, "elms");
    $sql = "UPDATE users SET name='$_POST[name]', mobile='$_POST[mobile]', address='$_POST[address]' WHERE uid = $_POST[uid];";
    $run_query = mysqli_query($connection, $sql);
?>
<script type="text/javascript">
    alert("Profile details updated successfully.");
    window.location.href = "../user/user_dashboard.php";
</script>