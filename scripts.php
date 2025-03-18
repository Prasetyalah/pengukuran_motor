<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<!-- AdminLTE -->
<script src="assets_adminlte/dist/js/adminlte.js"></script>

<!-- jQuery -->
<script src="assets_adminlte/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="assets_adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- OPTIONAL SCRIPTS -->
<script src="assets_adminlte/plugins/chart.js/Chart.min.js"></script>

<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="assets_adminlte/dist/js/pages/dashboard3.js"></script>
<!-- DataTables  & Plugins -->
<script src="assets_adminlte/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="assets_adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="assets_adminlte/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="assets_adminlte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="assets_adminlte/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="assets_adminlte/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="assets_adminlte/plugins/jszip/jszip.min.js"></script>
<script src="assets_adminlte/plugins/pdfmake/pdfmake.min.js"></script>
<script src="assets_adminlte/plugins/pdfmake/vfs_fonts.js"></script>
<script src="assets_adminlte/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="assets_adminlte/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="assets_adminlte/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- AdminLTE App -->
<script src="assets_adminlte/dist/js/adminlte.min.js"></script>

<!-- Page specific script -->
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": []
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
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
<!-- SweetAlert2 -->
<script src="assets_adminlte/plugins/sweetalert2/sweetalert2.min.js"></script>
<!-- Toastr -->
<script src="assets_adminlte/plugins/toastr/toastr.min.js"></script>
