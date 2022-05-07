<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!-- Script to print table -->
    <!-- <script src="../js/table2excel.js"></script> -->
    <!-- table style -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <h1>admin</h1>
    <h2>MANAGE USER RECORD</h2>
        <form action="" method="GET" >
            <!-- Employee -->
            <label for="employee_no">Employee Id: </label>

            <!-- PHP SA LOOB NG INPUT TAG TO GET VALUE USING PHP -->
            <input type="text" name="employee_no" 
                <?php if(isset($_GET['employee_no'])){echo $_GET['employee_no']; } ?>
                required><br>

            <button type="submit">SEARCH</button>
        </form>

        <!-- PASOK MO SA DIV CONTAINER NI JASON MULA DITO -->
        <!-- TABLE_RECORDS -->
        <div class="container">
            <div class="row">
                <div class="col-sm-8">
                    <?php echo $deleteMsg??''; ?>
                    <div class="table-responsive">
                        <table class="table table-bordered" id="diwar-report">
                        <thead>
                            <tr>
                                <th>EMPLOYEEd_ID</th>
                                <th>EMAIL</th>
                                <th>DEPARTMENT</th>
                                <th>NAME</th>
                                <th>HOUSE NO</th>
                                <th>BARANGAY</th>
                                <th>MUNICIPALITY</th>
                                <th>REGION</th>
                                <th>PROVINCE</th>
                                <th>POSTAL CODE</th>
                                <th>COUNTRY</th>
                                <th>CONTACT NO.</th>
                                <th>TELEPHONE NO.</th>
                                <th>PASSWORD</th>
                                <th>OPERATION</th>
                        </thead>
                        <tbody>
                        <!-- PHP CODE TO FETCH DATA -->
                        <?php 
                            //php database connection
                            $mysqli = require "../php/database_conn.php";
                            
                            //SEARCH RECORD WITH EMPLOYEE NO ONLY
                            if(isset($_GET['employee_no']))
                            {
                                $employee_no = $_GET['employee_no'];
                                $query = "SELECT * FROM `user_personal_info` WHERE `Employee_No` = '$employee_no' ";
                                $query_run = mysqli_query($mysqli, $query);
                                if(mysqli_num_rows($query_run) > 0)
                                {
                                    while ($items=mysqli_fetch_assoc($query_run))
                                    {
                                        echo "<tr><td>".$items['Employee_No']."</td>";
                                        echo "<td>".$items['Email']."</td>";
                                        echo "<td>".$items['Department']."</td>";
                                        echo "<td>".$items['Name']."</td>";
                                        echo "<td>".$items['House_no']."</td>";
                                        echo "<td>".$items['Barangay']."</td>";
                                        echo "<td>".$items['Municipality']."</td>";
                                        echo "<td>".$items['Region']."</td>";
                                        echo "<td>".$items['Province']."</td>";
                                        echo "<td>".$items['Postal_Code']."</td>";
                                        echo "<td>".$items['Country']."</td>";
                                        echo "<td>".$items['Contact_Num']."</td>";
                                        echo "<td>".$items['Telephone_Num']."</td>";
                                        echo "<td>".$items['Password_Hash']."</td>";
                                        echo "
                                        <td>
                                            <a onClick=\"javascript: return confirm('Are you sure you want to delete this user from the record?');\" href='../php/delete.php?employee=".$items['Employee_No']."'>DELETE USER</a>
                                        </td><tr>";
                                    }
                                    //DELETE

                                    // if (isset($_GET['employee']))
                                    // {   
                                    //     $employee = $_GET['employee'];
                                    //     $delete = mysqli_query(
                                    //         $mysqli, "DELETE * FROM 'user_personal_info' WHERE 'Employee_No' = '$employee' ");
                                    //         header ("Location: ./manage_user.php");
                                    //         die;
                                    // }
                                }
                                else
                                {
                                    ?>
                                        <tr>
                                            <td colspan="4">No Record Found</td>
                                        </tr>
                                    <?php
                                }
                            }
                        ?>   
                    </tbody>
                </table>    
            </div>
        </div>
    </div>
</div>           
<!-- HANGGANG DITO -->

<?php 
    
?>
  




<!-- BACK BUTTON LANG ITO DKO ALAM KUNG KAKAILANGANIN -->
<a href="../index.php">BACK</a><br>
<a href="./user_diwar.php">USER DIWAR</a><br>
<button onclick="myFunction()">Try it</button>

<script>
function confirmationDelete(anchor)
{
   var conf = confirm('Are you sure want to delete this record?');
   if(conf)
      window.location=anchor.attr("href");
}
</script>
</body>
</html>