<?php

$con=mysqli_connect('localhost','root','','mock_test_tbl');
// if($con==true)
// {echo "connection is successfull";}

$query="select * from mock_test_tbl";
$execute=mysqli_query($con,$query);
// print_r($execute);?>


<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="/./Mock_test_1/pagination1.0/library1.0.js"></script>
</head>

<body>
    <div class="container-fluid">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="card">
                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-4">
                                <div class="container">
                                <table class="table table-bordered table-striped table-hover" id="dataTable" width="100%" cellspacing="0">
                                    <thead style="color: #fff; background-color: #EC5D25;">
                                        <tr>
                                            <th>ID</th>
                                            <th>NAME</th>
                                            <th>Email</th>
                                            <th>phone-no</th>
                                            <th>gender</th>
                                        </tr>
                                    </thead>
                                    <tfoot style="color: #fff; background-color: #EC5D25;">
                                        <tr>
                                        <th>ID</th>
                                            <th>NAME</th>
                                            <th>Email</th>
                                            <th>phone-no</th>
                                            <th>gender</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                       
                                        <?php 

                                            while($row=mysqli_fetch_assoc($execute))
                                                { ?>
                                                
                                        <tr>
                                            <td><?php echo $row['Id']; ?></td>
                                            <td><?php echo $row['Name']; ?></td>
                                            <td><?php echo $row['Email']; ?></td>
                                            <td><?php echo $row['Phone']; ?></td>
                                            <td><?php echo $row['Gender']; ?></td>
                                        </tr>
                                                <?php

                                                
                                                }

                                        
                                        ?>
                                       
                                    </tbody>
                                </table>
                            </div>
                            </div>
                            <div class="col-lg-8 col-md-8 col-sm-8" id="main_div"
                                style="text-align: center;position: relative;">
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <script type="text/javascript" src="/./Mock_test_1/js/frontend.js"></script>

    <!-- Bootstrap core JavaScript-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <!-- Page level plugin JavaScript-->
    <script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>

    <script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>

    <script>
        $(document).ready(function() {
              $('#dataTable').DataTable();
        });
    </script>
</body>

</html>