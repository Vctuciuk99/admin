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

            <!-- month -->
            <h6>search by month</h6>
            <label for="month">Month: </label>
            <select name="month">
                <!-- <option><//?php echo htmlspecialchars($department)?></option> -->
                <option value="Select Month">Select Month</option>
                <option value="1">January</option>
                <option value="2">February</option>
                <option value="3">March</option>
                <option value="4">April</option>
                <option value="5">May</option>
                <option value="6">June</option>
                <option value="7">July</option>
                <option value="8">August</option>
                <option value="9">September</option>
                <option value="10">October</option>
                <option value="11">November</option>
                <option value="12">December</option>

                <?php if(isset($_GET['month'])){echo $_GET['month']; } ?>
            </select><br>


            <!-- year -->
            <label for="year">YEAR: </label>

            <!-- PHP SA LOOB NG INPUT TAG TO GET VALUE USING PHP -->
            <input type="text" name="year" 
                <?php if(isset($_GET['year'])){echo $_GET['year']; } ?>
                ><p>(Optional)</p>

            <!-- date -->
            <h6>search by date</h6>
            <label for="date">Date: </label>

            <!-- PHP SA LOOB NG INPUT TAG TO GET VALUE USING PHP -->
            <input type="date" name="date" 
                <?php if(isset($_GET['date'])){echo $_GET['date']; } ?>
                ><p>(optional)</p>

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
                            
                            //SEARCH RECORD WITH EMPLOYEE NO ONLY BY MONTHLY BASIS
                            if(isset($_GET['month']) && empty($_GET['date']) && empty($_GET['year']))
                            {
                                $employee_no = $_GET['employee_no'];
                                $month = $_GET['month'];
                                //SQL COMMAND TO SORT DB
                                $query = "SELECT * FROM `user_diwar_record` WHERE `Employee_no` = '$employee_no' AND DATE_FORMAT(Date,'%c')='$month' ";
                                $query_run = mysqli_query($mysqli, $query);
                                //IF RESULT IS > 0
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
                            //SEARCH BY YEAR
                            elseif (!empty($_GET['year'])) {
                                $employee_no = $_GET['employee_no'];
                                $year = $_GET['year'];
                                $month = $_GET['month'];
                                //SQL COMMAND TO SORT BY YEAR
                                $query = "SELECT * FROM `user_diwar_record` WHERE `Employee_no` = '$employee_no' AND DATE_FORMAT(Date,'%c')='$month' AND DATE_FORMAT(Date,'%Y')='$year' ";
                                $query_run = mysqli_query($mysqli, $query);
                                //IF RESLUT IS > 0
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
                            //SEARCH BY SPECIFIC DATE
                            elseif (!empty($_GET['date'])) {
                                $employee_no = $_GET['employee_no'];
                                $date = $_GET['date'];
                                //SQL COMMAND TO SORT BY MM-
                                $query = "SELECT * FROM `user_diwar_record` WHERE `Employee_no` = '$employee_no' AND `Date` = '$date' ";
                                $query_run = mysqli_query($mysqli, $query);
                                //IF RESULT IS > 0
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