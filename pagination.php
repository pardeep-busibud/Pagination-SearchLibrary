<?php
$server ="localhost";
$user ="root";
$password ="";
$db = "mock_test_db";

$con = mysqli_connect($server,$user,$password,$db);
if(!$con){
mysql_error();
}
$limit = 5;  
if (isset($_GET["page"])) {
	$page  = $_GET["page"]; 
	} 
	else{ 
	$page=1;
	};  
$start_from = ($page-1) * $limit;  
$result = mysqli_query($con,"SELECT * FROM mock ORDER BY Id ASC LIMIT $start_from, $limit");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Search</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</head>

<body>

    <div class="container">
        <p class="text-center">Name: Sahil | Contact Us:9267979069 | Github : github.com/sahihai</p>
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
while ($row = mysqli_fetch_array($result)) {  
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

    <?php  

$result_db = mysqli_query($con,"SELECT COUNT(Id) FROM mock"); 
$row_db = mysqli_fetch_row($result_db);  
$total_records = $row_db[0];  
$total_pages = ceil($total_records / $limit); 

$pageno = "<ul class='pagination container '>";  
for ($i=1; $i<=$total_pages; $i++) {
              $pageno .= "<li class='page-item'><a class='page-link' href='pagination.php?page=".$i."'>".$i."</a></li>";	
}
echo $pageno . "</ul>";  
?>


    <!-- search box -->
    <div class="container">
        <h1>Search here</h1>
        <form class="search-post" action="search.php" method="GET">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Search .....">
                <span class="input-group-btn">
                    <button type="submit" class="btn btn-danger">Search</button>
                </span>
            </div>
        </form>
    </div>
    <!-- search box ends -->
    
</body>

</html>