<?php
    $connection = mysqli_connect("localhost", "root", "");
    $db = mysqli_select_db($connection, "elms");
    $datetime = date('Y-m-d H:i:s');
    $sql = "INSERT INTO users VALUES (NULL, '$_POST[name]', '$_POST[email]', '$_POST[password]', NULL, NULL, '$_POST[gender]', '$_POST[mobile]', '$_POST[address]', '$datetime');";
    $run_query = mysqli_query($connection, $sql);
?>
<script type="text/javascript">
    alert("Account created sucessfully. You can login now.");
    window.location.href = "../user/user_login.php";
</script>