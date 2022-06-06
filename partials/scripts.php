 <!-- jQuery -->
 <script src="../public/plugins/jquery/jquery.min.js"></script>
 <!-- Bootstrap 4 -->
 <script src="../public/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
 <!-- AdminLTE App -->
 <script src="../public/js/adminlte.min.js"></script>
 <!-- SweetAlert2 -->
 <script src="../public/plugins/sweetalert2/sweetalert2.min.js"></script>
 <!-- overlayScrollbars -->
 <script src="../public/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
 <!-- AdminLTE App -->
 <script src="dist/js/adminlte.js"></script>
 <!-- Select2 -->
 <script src="../public/plugins/select2/js/select2.full.min.js"></script>
 <!-- Data Tables CDN -->
 <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.25/datatables.min.js"></script>
 <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
 <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
 <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
 <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
 <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>
 <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.print.min.js"></script>
 <!-- Toastr -->
 <script src="../public/plugins/toastr/toastr.min.js"></script>
 <script>
     /* Stop Double Resubmission */
     if (window.history.replaceState) {
         window.history.replaceState(null, null, window.location.href);
     }
 </script>

 <script>
     $('.select2').select2()
     /* Initialize Data Tables */
     $(document).ready(function() {
         $('.table').DataTable();
         $('.table td').css('white-space', 'initial');
     });

     $(document).ready(function() {
         $('.report_table').DataTable({
             dom: 'Bfrtip',
             buttons: [
                 'csv', 'excel', 'pdf', 'print'
             ]
         });
     });
     $("input[type='number']").inputSpinner()
 </script>
 <!-- Init Sweet Alerts -->
 <?php if (isset($success)) { ?>
     <!-- Pop Success Alert -->
     <script>
         const Toast = Swal.mixin({
             toast: true,
             position: 'top-end',
             showConfirmButton: false,
             timer: 3000
         });
         Toast.fire({
             type: 'success',
             title: '<?php echo $success; ?>',
         })
     </script>

 <?php }
    if (isset($err)) { ?>
     <script>
         /* Pop Error Message */
         const Toast = Swal.mixin({
             toast: true,
             position: 'top-end',
             showConfirmButton: false,
             timer: 3000
         });
         Toast.fire({
             type: 'error',
             title: '<?php echo $err; ?>',
         })
     </script>

 <?php }
    if (isset($info)) { ?>
     <script>
         /* Pop Warning  */
         const Toast = Swal.mixin({
             toast: true,
             position: 'top-end',
             showConfirmButton: false,
             timer: 3000
         });
         Toast.fire({
             type: 'info',
             title: '<?php echo $info; ?>',
         })
     </script>

 <?php }
    ?>