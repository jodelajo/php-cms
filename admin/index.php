<?php include "includes/admin_header.php"?>

    <div id="wrapper">
        <!-- Navigation -->
        <!-- TopNav -->
        <?php include "includes/side_nav.php"?>

        <div id="page-wrapper">
            <div class="container-fluid">
                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welkom to Admin                         
                            <small>  <?php echo $_SESSION['firstname']; ?></small>
                        </h1>         
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

        <?php include "includes/admin_footer.php"?>