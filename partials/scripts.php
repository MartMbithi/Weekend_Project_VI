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
 <?php if (isset($success)) { ?>
     <!-- Pop Success Alert -->
     <script>
         Toast.fire({
             type: 'success',
             title: '<?php echo $success; ?>'
         })
     </script>

 <?php }
    if (isset($err)) { ?>
     <script>
         Toast.fire({
             type: 'error',
             title: '<?php echo $err; ?>'
         })
     </script>
 <?php }
    if (isset($info)) { ?>
     <script>
         Toast.fire({
             type: 'warning',
             title: '<?php echo $info; ?>'
         })
     </script>
 <?php } ?>