<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!-- Script to print table -->
    <script src="../js/table2excel.js"></script>
    <!-- table style -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <h1>admin</h1>
    <h2>USER DIWAR</h2>
        <form action="" method="GET" >
            <!-- Employee -->
            <label for="employee_no">Employee Id: </label>

            <!-- PHP SA LOOB NG INPUT TAG TO GET VALUE USING PHP -->
            <input type="text" name="employee_no" 
                <?php if(isset($_GET['employee_no'])){echo $_GET['employee_no']; } ?>
                required><br>

            <!-- date -->
            <label for="date">Date: </label>

            <!-- PHP SA LOOB NG INPUT TAG TO GET VALUE USING PHP -->
            <input type="date" name="date" 
                <?php if(isset($_GET['date'])){echo $_GET['date']; } ?>
                required><br>

            <!-- <a href="./result_records.php" type="submit">Search</a> -->
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
                            <th>NAME</th>
                            <th>DATE</th>
                            <th>TIME_FROM</th>
                            <th>TIME_TO</th>
                            <th>OUTPUT</th>
                            <th>DETAILS</th>
                            <th>VERIFICATION</th>
                    </thead>
                    <tbody>
                        <!-- PHP CODE TO FETCH DATA -->
                        <?php 
                            //php database connection
                            $mysqli = require "../php/database_conn.php";
                            
                            //SEARCH RECORD WITH EMPLOYEE NO ONLY
                            if(isset($_GET['employee_no']) and isset($_GET['date']))
                            {
                                $employee_no = $_GET['employee_no'];
                                $date = $_GET['date'];
                                $query = "SELECT * FROM `user_diwar_record` WHERE `Employee_no` = '$employee_no' AND `Date` = '$date' ";
                                $query_run = mysqli_query($mysqli, $query);
                                
                                if(mysqli_num_rows($query_run) > 0)
                                {
                                    foreach($query_run as $items)
                                    {
                                        ?>
                                        <tr>

                                            <!-- $items['COLUMN NAME IN USER_DIWAR DB'] -->
                                            <td><?= $items['Employee_no']; ?></td>
                                            <td><?= $items['Email']; ?></td>
                                            <td><?= $items['Name']; ?></td>
                                            <td><?= $items['Date']; ?></td>
                                            <td><?= $items['Time_from']; ?></td>
                                            <td><?= $items['Time_to']; ?></td>
                                            <td><?= $items['Output']; ?></td>
                                            <td><?= $items['Details']; ?></td>
                                            <td><?= $items['Verification']; ?></td>
                                        </tr>
                                        <?php
                                    }
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
  <!-- HANGGANG DITO UNG SA LOOB NG CONTAINER NI JASON -->

<!-- BACK BUTTON LANG ITO DKO ALAM KUNG KAKAILANGANIN -->
<a href="../index.php">BACK</a><br>
        <a href="./manage_user.php">MANAGE USER RECORD</a><br>

<!-- DOWNLOAD BUTTON -->
<button id="downloadexcel">DOWNLOAD AS EXCEL FILE</button>


  <!-- SRCIPT TO PRINT TABLE  -->
  <script>
    document.getElementById('downloadexcel').addEventListener('click', function() {
      var table2Excel = new Table2Excel();
        table2Excel.export(document.querySelectorAll("#diwar-report"));
    })
  </script>
</body>
</html>