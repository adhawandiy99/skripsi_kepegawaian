<?php
use LDAP\Result;
session_start();
if ($_SESSION["peran"] == "USER") {
  header("Location: logout.php");
  exit;
}
if (!isset($_SESSION["login"])) {
  header("Location: ..admin/index.php");
  exit;
}
include '../koneksi.php';

$query = mysqli_query($conn, "SELECT penggajian.id, penggajian.tahun, penggajian.bulan, penggajian.gapok,penggajian.tunjangan,penggajian.uang_makan, karyawan.nama_lengkap
FROM penggajian, karyawan WHERE karyawan.id = penggajian.karyawan_id");
$row = mysqli_fetch_assoc($query);

?>
<style>
    .style9 {
    color: #000000;
    font-size: 9pt;
    font-weight: normal;
    font-family: Arial;
}
</style>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Slip Gaji Karyawan| PRAKTIKUM FTI UNISKA 2023</title>
    <h3>

    <table width="100%">
        <tr>
            <td width="25" align="center"><img src="http://localhost/praktikum_0977/dist/img/uniska.jpg" width="80%"></td>
            <td width="50" align="center"><h3><strong>SLIP GAJI KARYAWAN</strong></h3></td>
            <td width="25" align="center"></td>
        </tr>
    </table>
    </h3>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <link rel="stylesheet" href="../dist/css/adminlte.min.css">
</head>

<body onload="window.print();">
  <div class="container-fluid">
                                <div class="card-body">
                                  <div class="table-responsive">
                                        <hr>
                                        <table id="example1" class="table table-bordered table-striped">
                                            <thead>
                                            <tr class="text-center">
                                            <th>No</th>
                                            <th>Nama Karyawan</th>
                                            <th>Tahun/Bulan</th>
                                            <th>Gaji Pokok </th>
                                            <th>Tunjangan </th>
                                            <th>Uang Makan</th>
                                            <th>Total</th>
                                        </tr>
                                            </thead>
                                            <tbody>
                                      <?php $no=1;
                                      $jml_gapok = 0;
                                      $jml_tunjangan = 0;
                                      $jml_uang_makan = 0;
                                      $jumlah = $row["gapok"]+$row["tunjangan"]+$row["uang_makan"];
                                      ?>
                                        <tr>
                                            <td class="text-center"><?php echo $no; ?></td>
                                            <td><?php echo $row["nama_lengkap"]?></td>
                                            <td class="text-center"><?php echo $row["tahun"].-$row["bulan"]?></td>
                                            <td class="text-right"><?php echo 'Rp. '. number_format($row["gapok"], 0, ',', ',').',-'; ?></td>
                                            <td class="text-right"><?php echo 'Rp. '. number_format($row["tunjangan"], 0, ',', ',').',-'; ?></td>
                                            <td class="text-right"><?php echo 'Rp. '. number_format($row["uang_makan"], 0, ',', ',').',-'; ?></td>
                                            <td class="text-right"><?php echo 'Rp. '. number_format($jumlah, 0, ',', ',').',-'; ?></td>
                                          </tr>
                                        <?php
                                          $no++;
                                          $jml_gapok += $row["gapok"];
                                          $jml_tunjangan += $row["tunjangan"];
                                          $jml_uang_makan += $row["uang_makan"];

                                        ?>
                                    </tbody>
                                    <tfoot>
                                      <tr>
                                        <th class="text-center" colspan="6">Total Keseluruhan</th>
                                        <th class="text-right"><?php echo 'Rp. '. number_format($jumlah, 0, ',', '.').',-'; ?></th>
                                      </tr>
                                    </tfoot>

                                        </table>
                                        <table width="98%" border="0" align="center">
                                          <tr>
                                              <td colspan="3">&nbsp;</td>
                                              <td colspan="3">&nbsp;</td>
                                              <td colspan="3">&nbsp;</td>
                                          </tr>

                                          <tr>
                                              <td colspan="3">&nbsp;</td>
                                              <td colspan="3">&nbsp;</td>
                                              <td colspan="3">&nbsp;</td>
                                          </tr>
                                          <tr>
                                              <td colspan="3">&nbsp;</td>
                                              <td colspan="3">&nbsp;</td>
                                              <td colspan="3">&nbsp;</td>
                                          </tr>
                                          <tr>
                                              <td width="82"><div align="right"></div>
                                            </td>
                                              <td width="89">

                                            </td>
                                              <td width="76"></td>
                                          </tr>
                                          <table width="50%" align="right" border="0" style="margin-top: 30px;">
                                              <tr>
                                                  <td width="50%"></td>
                                                  <td align="center">Banjarmasin,<small> <?php echo date('d-m-y'); ?><strong><br>Pimpinan</strong></small><br><br><br><br><small><strong>............................</strong></small><br></td>
                                               </tr>
                                          </table>
                                          </table>
                                      </div>
                                    </table>
                                  </div>
                                </div>
  </div>
  <script src="../plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script src="../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
  <script src="../plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
  <script src="../plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
  <script src="../plugins/jszip/jszip.min.js"></script>
  <script src="../plugins/pdfmake/pdfmake.min.js"></script>
  <script src="../plugins/pdfmake/vfs_fonts.js"></script>
  <script src="../plugins/datatables-buttons/js/buttons.html5.min.js"></script>
  <script src="../plugins/datatables-buttons/js/buttons.print.min.js"></script>
  <script src="../plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
  <script src="../dist/js/adminlte.min.js"></script>
  <script src="../dist/js/demo.js"></script>
  <script>
  $(function() {
  $("#example1").Datatable({
  "responsive": true,
  "lengthChange": false,
  "autoWidth": false,
  "buttons": ["copy", "csv", "excel", "pdf", "print"]
  }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
  $('#example2').Datatable({
  "paging": true,
  "lengthChange": false,
  "searching": false,
  "ordering": true,
  "info": true,
  "autoWidth": false,
  "responsive": true,
  });
  });
  </script>
</body>
</html>

