<?php
    $connection = mysqli_connect("localhost", "root", "");
    $db = mysqli_select_db($connection, "elms");
    $sql = "UPDATE admins SET name='$_POST[name]' WHERE uid = $_POST[uid]";
    $run_query = mysqli_query($connection, $sql);
?>
<script type="text/javascript">
    alert("Profile details updated successfully.");
    window.location.href = "../admin/admin_dashboard.php";
</script>