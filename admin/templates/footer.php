</div>
<footer id="footer" class="footer" >
    <div class="container-fluid">
        <nav>
            
            <p style="min-width: 80%;" class="copyright text-center">
                ©
                <script>
                    document.write(new Date().getFullYear())
                </script>
                <a href="http://www.creative-tim.com">Creative Tim</a>, made with love for a better web
            </p>
        </nav>
    </div>
</footer>
        </div>
    </div>
    
  
    <script src="<?php  echo $config['admin_assets'] ?>js/core/jquery.3.2.1.min.js" type="text/javascript"></script>
    <script src="<?php  echo $config['admin_assets'] ?>js/core/popper.min.js" type="text/javascript"></script>
    <script src="<?php  echo $config['admin_assets'] ?>js/core/bootstrap.min.js" type="text/javascript"></script>
    <!--  Plugin for Switches, full documentation here: http://www.jque.re/plugins/version3/bootstrap.switch/ -->
        <script src="<?php  echo $config['admin_assets'] ?>js/plugins/bootstrap-switch.js"></script>
        <!--  Google Maps Plugin    -->
        <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
        <!--  Chartist Plugin  -->
        <script src="<?php  echo $config['admin_assets'] ?>js/plugins/chartist.min.js"></script>
        <!--  Notifications Plugin    -->
        <script src="<?php  echo $config['admin_assets'] ?>js/plugins/bootstrap-notify.js"></script>
        <!-- Control Center for Light Bootstrap Dashboard: scripts for the example pages etc -->
        <script src="<?php  echo $config['admin_assets'] ?>js/light-bootstrap-dashboard.js?v=2.0.0 " type="text/javascript"></script>
        <!-- Light Bootstrap Dashboard DEMO methods, don't include it in your project! -->
        <script src="<?php  echo $config['admin_assets'] ?>js/demo.js"></script>
        <script> 
            // Add the following code if you want the name of the file appear on select

            $(".custom-file-input").on("change", function() {
                var fileName = $(this).val().split("\\").pop();
                $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
            });
        </script>
        <?php 
            if( isset($_SESSION["is_logged"]) || !isset($_SESSION['is_logged']) || isset($_SESSION['success_message'])){
                echo "
                <script>
                let alertBox = document.getElementById('logged_in');
                    alertBox.style.display = 'block';
                    setTimeout(function(){
                        alertBox.style.display = 'none';
                        
                    },4000)
                    setTimeout(function(){
                        location.href = 'index.php';
                        
                    },3000)
                </script>
                ";
            
            }
        ?>



</body>
</html>
    