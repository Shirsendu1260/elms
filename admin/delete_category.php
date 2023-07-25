<?php
    session_start();
    $connection = mysqli_connect("localhost", "root", "");
    $db = mysqli_select_db($connection, "elms");
    $decoded_cid = base64_decode($_GET['cid']);
    $sql = "DELETE FROM categories WHERE cid = $decoded_cid";
    $result = $connection -> query($sql);
    if($result){
        echo '<script type="text/javascript">
                    alert("Category deleted sucessfully.");
                    window.location.href = "../admin/manage_categories.php";
                </script>';
    }
    else{
        echo '<script type="text/javascript">
                    alert("Unable to delete category. Try again later");
                    window.location.href = "../admin/manage_categories.php";
                </script>';
    }
?>