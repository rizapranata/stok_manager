 <!-- Optional JavaScript -->
 <!-- jQuery first, then Popper.js, then Bootstrap JS -->

 <!-- FOOTER -->
 <footer id="main-footer" class="py-4">
     <div class="container">
         <div class="row">
             <div class="col-12">
                 <small>
                     <?php
                        $tanggal = new DateTime('now');
                        echo "Copyright © " . $tanggal->format("Y") . " Riza Pranata";
                        ?>
                 </small>
             </div>
         </div>
     </div>
 </footer>

 <!-- <script src="assets/js/jquery-3.2.1.slim.min.js"></script> -->
 <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
 <script src="assets/js/popper.min.js"></script>
 <script src="assets/js/bootstrap.min.js"></script>
 </body>

 </html>