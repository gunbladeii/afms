<?php require('../Connection/iBerkat.php'); 

session_start();

$colname_Recordset2 = "-1";
if (isset($_SESSION['MM_Username'])) {
  $colname_Recordset2 = $_SESSION['MM_Username'];
}

$Recordset2 = $mysqli->query("SELECT attendance.noIC, attendance.nama,attendance.year, attendance.stationCode, stationName.name AS stationName, attendance.month, attendance.time, attendance.timeOut FROM attendance INNER JOIN stationName ON attendance.stationCode = stationName.stationCode GROUP BY attendance.noIC ORDER BY attendance.nama ASC");
$row_Recordset2 = mysqli_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysqli_num_rows($Recordset2);

$a=1;
?>

<?php if(!empty($row_Recordset2['stationCode'])) {?>
              <table id="example5" class="table table-hover table-responsive-xl">
                <thead>
                <tr>
                  <th>No.</th>
                  <th>Rider/SV</th>
                  <th>Station</th>
                  <th>Code</th>
                </tr>
                </thead>
                <tbody>
                <?php do {?>    
                <tr>
                <td><?php echo $a++;?></td>	
	            <td> <span data-toggle="modal" data-target="#viewStationModal" data-whatever3="<?php echo $row_Recordset2['noIC'];?>" class="badge badge-primary" role="button" aria-pressed="true"><?php echo strtoupper($row_Recordset2['nama']);?></span></td>
	            <td><span class="badge badge-info"><?php echo $row_Recordset2['stationName'];?></span></td>
	             <td><span class="badge badge-info"><?php echo $row_Recordset2['stationCode'];?></span></td>
	            </tr>
                <?php } while ($row_Recordset2 = mysqli_fetch_assoc($Recordset2));?>
                </tbody>
                <tfoot>
                <tr>
                  <th>No.</th>
                  <th>Rider/SV</th>
                  <th>Station</th>
                  <th>Code</th>
                </tr>
                </tfoot>
              </table>
<?php }?>
<script src="plugins/datatables/jquery.dataTables.js"></script>
<script src="plugins/datatables/dataTables.bootstrap4.js"></script>
<script>
  $(function () {
    $("#example5").DataTable();
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
    });
  });
</script>