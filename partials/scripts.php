 <!-- jQuery -->
 <script src="../public/plugins/jquery/jquery.min.js"></script>
 <!-- Bootstrap 4 -->
 <script src="../public/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
 <!-- AdminLTE App -->
 <script src="../public/js/adminlte.min.js"></script>
 <!-- SweetAlert2 -->
 <script src="../public/plugins/sweetalert2/sweetalert2.min.js"></script>
 <!-- Toastr -->
 <script src="../public/plugins/toastr/toastr.min.js"></script>
 <script>
     /* Stop Double Resubmission */
     if (window.history.replaceState) {
         window.history.replaceState(null, null, window.location.href);
     }
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