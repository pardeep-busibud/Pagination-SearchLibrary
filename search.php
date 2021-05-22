<?php 
include "config.php";

if(isset($_GET['search'])){
    $search_term = mysqli_real_escape_string($con, $_GET['search']);
}
$sqls = "SELECT * FROM mock WHERE mock.Name LIKE '%{$search_term}%' OR mock.Phone LIKE '%{$search_term}%' OR mock.Email LIKE '%{$search_term}%'";

$results =  mysqli_query($con, $sqls) or die("Query Failed.");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>result</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">

</head>
<body>

<div class="btn btn-danger mx-auto">
   <a href="./pagination.php" class="text-capatilize" style="color:white"> go back</a>
</div>
<div class="container">

        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Gender</th>
                </tr>
                <thead>
                <tbody>
                    <?php  
$i=0;
while ($row = mysqli_fetch_array($results)) {  
?>
                    <tr>
                        <td><?php echo $row["Id"]; ?></td>
                        <td><?php echo $row["Name"]; ?></td>
                        <td><?php echo $row["Email"]; ?></td>
                        <td><?php echo $row["Phone"]; ?></td>
                        <td><?php echo $row["Gender"]; ?></td>
                    </tr>
                    <?php  
$i++;
};  
?>
                </tbody>
        </table>
    </div>


    
</body>
</html>

