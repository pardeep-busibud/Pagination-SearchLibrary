<?php  
 $connect = mysqli_connect("localhost", "root", "", "demo");  
 $query ="SELECT * FROM mock_test_tbl ORDER BY ID DESC";  
 $result = mysqli_query($connect, $query);  
 ?>  
 <!DOCTYPE html>  
 <html>  
      <head>  
           <title>users</title>  
           <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
           <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
           <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>  
           <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>            
           <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />  
      </head>  
      <body>  
           <br /><br />  
           <div class="container">  
                <!-- <h3 align="center">Datatables Jquery Plugin with Php MySql and Bootstrap</h3>   -->
                <br />  
                <div class="table-responsive">  
                     <table id="employee_data" class="table table-striped table-bordered">  
                          <thead>  
                               <tr> 

                                     <td>Sl No</td>  
                                    <td>Name</td>  
                                    <td>Email</td>  
                                    <td>Phone No</td>  
                                    <td>Gender</td>  
                                   
                               </tr>  
                          </thead>  
                          <?php 

                          $i=0; 
                          while($row = mysqli_fetch_array($result))  
                          {  $i++;
                               echo '  
                               <tr> 
                                <td>'.$i.'</td>     
                                    <td>'.$row["Name"].'</td>  
                                    <td>'.$row["Email"].'</td>  
                                    <td>'.$row["Phone"].'</td>  
                                    <td>'.$row["Gender"].'</td>  
                               </tr>  
                               ';  
                          }  
                          ?>  
                     </table>  
                </div>  
           </div>  
      </body>  
 </html>  
 <script>  
 $(document).ready(function(){  
      $('#employee_data').DataTable();  
 });  
 </script>  
