<?php
$server ="localhost";
$user ="root";
$password ="";
$db = "mock_test_db";

$con = mysqli_connect($server,$user,$password,$db);

if($con){
    ?>
    <script>
        alert('conection sucessful');
    </script>
    <?php
}else{
    ?>
    <script>
        alert('conection failed');
    </script>
    <?php
}
?>