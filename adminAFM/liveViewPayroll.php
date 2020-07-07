<?php require('../Connection/iBerkat.php'); 

session_start();

$noIC = $_GET['noIC'];
$month = $_GET['month'];
$year = $_GET['year'];

$colname_Recordset2 = "-1";
if (isset($_SESSION['MM_Username'])) {
  $colname_Recordset2 = $_SESSION['MM_Username'];
}

$Recordset2 = $mysqli->query("SELECT * FROM 

  (((testSalary 

  INNER JOIN employeeData ON testSalary.noIC = employeeData.noIC)
  INNER JOIN stationName ON testSalary.stationCode = stationName.stationCode)
  INNER JOIN infoParcel ON testSalary.noIC = infoParcel.noIC)

   WHERE testSalary.noIC = '$noIC' AND testSalary.month = '$month' AND testSalary.year = '$year' 
   GROUP BY testSalary.noIC, testSalary.month, testSalary.year ORDER BY testSalary.month,testSalary.year ASC");
$row_Recordset2 = mysqli_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysqli_num_rows($Recordset2);

$a=1;
?>
<?php if(!empty($row_Recordset2['stationCode'])) {?>
              <h3><?php echo strtoupper($row_Recordset2['stationName']);?></h3>
              <h5><span class="badge badge-info">Month: <?php $date=date_create($row_Recordset2['date']);echo date_format($date,"F");?></span></h5>
              <h6><span class="badge badge-info"><?php echo ucwords(strtolower($row_Recordset2['nama']));?></span></h6>
              <table id="example2" class="table table-hover table-responsive-xl">
                <thead>
                <tr>
                  <th><span class="badge badge-secondary">Earning</span></th>
                </tr>
                <tr>
                  <th>No.</th>
                  <th>Item</th>
                  <th>Info</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>1.</td>	
    	              <td>Delivery Commission</td>
                    <td><?php echo $row_Recordset2['delComm'];?></td>	
	              </tr>
                <tr>
                    <td>2.</td> 
                    <td>Comm/Fee</td>
                    <td><?php echo $row_Recordset2['comFee'];?></td> 
                </tr>
                <tr>
                    <td>3.</td> 
                    <td>Fuel</td>
                    <td><?php echo $row_Recordset2['fuel'];?></td> 
                </tr>
                <tr>
                    <td>4.</td> 
                    <td>Phone</td>
                    <td><?php echo $row_Recordset2['phone'];?></td> 
                </tr>
                <tr>
                    <td>5.</td> 
                    <td>Fix Commission</td>
                    <td><?php echo $row_Recordset2['comission'];?></td> 
                </tr>
                <tr>
                    <td>6.</td> 
                    <td>Overtime</td>
                    <td><input type="number" name="ot"></td> 
                </tr>
                <tr>
                    <td>7.</td> 
                    <td>Refund Bag</td>
                    <td><input type="number" name="refundBag"></td> 
                </tr>
                <tr>
                    <td>8.</td> 
                    <td>Attendance</td>
                    <td><?php echo $row_Recordset2['attAllow'];?></td> 
                </tr>
                </tbody>

                <thead>
                <tr>
                  <th><span class="badge badge-secondary">Deduction</span></th>
                </tr>
                <tr>
                  <th>No.</th>
                  <th>Item</th>
                  <th>Info</th>
                </tr>
                </thead>

                <tbody>
                  <tr>
                    <td>1.</td> 
                    <td>Bag Deposit</td>
                    <td><input type="number" name="bagDeposit"></td> 
                  </tr>

                  <tr>
                    <td>2.</td> 
                    <td>Penalty</td>
                    <td><input type="number" name="penalty"></td> 
                  </tr>

                  <tr>
                    <td>3.</td> 
                    <td>Incomplete POD</td>
                    <td><input type="number" name="incompletePOD"></td> 
                  </tr>

                  <tr>
                    <td>4.</td> 
                    <td>Over Payment</td>
                    <td><input type="number" name="overPayment"></td> 
                  </tr>

                  <tr>
                    <td>4.</td> 
                    <td>No Pay Leave</td>
                    <td><input type="number" name="nopayLeave"></td> 
                  </tr>
                </tbody>


              </table>
<?php }else{echo '<span class="badge badge-danger">No rider/SV data were recorded</span>';}?>