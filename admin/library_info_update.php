<?php
    if(isset($_POST['save'])){
        $library_data['name'] = $_POST['name'];
        $library_data['address'] = $_POST['address'];
        $library_data['phone'] = $_POST['phone'];
        $library_data['email'] = $_POST['email'];
        $library_data['time_start'] = $_POST['time_start'];
        $library_data['time_end'] = $_POST['time_end'];
        $library_data['week_start'] = $_POST['week_start'];
        $library_data['week_end'] = $_POST['week_end'];

        $updated_json_data = json_encode($library_data, JSON_PRETTY_PRINT);
        $result = file_put_contents("../utilities/library.json", $updated_json_data);
        if($result == false){
            echo '<script type="text/javascript">
                        alert("Unable to update library details. Try again later.");
                        window.location.href = "../admin/edit_library_info.php";
                    </script>';
        }
        else{
            echo '<script type="text/javascript">
                alert("Library details updated successfully.");
                window.location.href = "../admin/library_info.php";
            </script>';
        }
    }
?>