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
                            ADMIN - Categories
                            <!-- <small>Author</small> -->
                        </h1>                           
                        <div class="col-xs-6">
<?php 
insert_categories();
?>
                            <form action="" method="post"> 
                                 <div class="form-group">
                                    <label for="cat_title">Add Category</label>
                                    <input type="text" class="form-control"   name="cat_title">
                                </div>
                                <div class="form-group">
                                    <input class="btn btn-primary" type="submit" name="submit" class="submit" value="Add Category">
                                </div>
                            </form>

<?php 
updateCategories();
?>
                        </div>
                        <div class="col-xs-6">
                        <label for="category">Categories</label>
                            <table class="table table-bordered table-hover" name="category">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Category Title</th>
                                        <th>Edit</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                            
<?php 
findAllCategories();
deleteCategories();
?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
         </div>
        <!-- /#page-wrapper -->

<?php include "includes/admin_footer.php"?>