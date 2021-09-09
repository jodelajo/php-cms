<?php include "includes/admin_header.php"?>
<?php 
//FIND LOGGED IN USERPROFILE
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    $query = "SELECT * FROM users WHERE username = '{$username}' ";
    $select_user_profile_query = mysqli_query($connection, $query);
    while ($row = mysqli_fetch_array($select_user_profile_query)) {
        $user_id =   $row['user_id'];
        $user_email =  $row['user_email'];
        $user_password =  $row['user_password'];
        $username =  $row['username'];
        $user_firstname =   $row['user_firstname'];
        $user_lastname =  $row['user_lastname'];
        $user_role =  $row['user_role'];
        // $user_image =  $row['user_image'];
    }
}
?>
<?php
if (isset($_POST['edit_profile'])) {
    $user_email =  $_POST['user_email'];
    $user_password =  $_POST['user_password'];
    $username =  $_POST['username'];
    $user_firstname =   $_POST['user_firstname'];
    $user_lastname =  $_POST['user_lastname'];
    $user_role =  $_POST['user_role'];

    $query = "UPDATE users SET ";
    $query .="user_firstname = '{$user_firstname}', ";
    $query .="user_lastname = '{$user_lastname}', ";
    $query .="username = '{$username}', ";
    $query .="user_email = '{$user_email}', ";
    $query .="user_role = '{$user_role}', ";
    $query .="user_password = '{$user_password}' ";
    $query .="WHERE username = '{$username}' ";
   
    
    $edit_users_query = mysqli_query($connection, $query);
    confirmQuery($edit_users_query);
    header("Location: users.php");
}

    // if (isset($_POST['edit_profile'])) {
    //     $user_firstname = $POST['user_firstname'];
    //     $user_lastname =  $POST['user_lastname'];
    //     $username =   $_POST['username'];
    //     $user_email =  $_POST['user_email'];
        
    //     $user_role =  $POST['user_role'];
    //     $user_password =  $_POST['user_password'];
    // }
    // $query = "UPDATE users SET ";
    // $query .="user_firstname = '{$user_firstname}', ";
    // $query .="user_lastname = '{$user_lastname}', ";
    // $query .="username = '{$username}', ";
    // $query .="user_email = '{$user_email}', ";
    // $query .="user_role = '{$user_role}', ";
    // $query .="user_password = '{$user_password}' ";
    
    // $query .="WHERE user_id = '{$user_id}' ";
   


?>

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
                            ADMIN - Profile
                            <small>  <?php echo $_SESSION['firstname']; ?></small>
                        </h1>           
<form action="" method="post" enctype="multipart/form-data"> 
    <div class="form-group">
        <label for="user_firstname">Firstname</label>
        <input value="<?php echo $user_firstname; ?>" class="form-control" type="text" name="user_firstname">
    </div>
    <div class="form-group">
        <label for="user_lastname">Lastname</label>
        <input value="<?php echo $user_lastname; ?>" class="form-control" type="text" name="user_lastname">
    </div>
   
    <div class="form-group">
        <label for="username">Username</label>
        <input value="<?php echo $username; ?>" class="form-control" type="text" name="username">
    </div>
    <div class="form-group">
        <label for="user_email">Email</label>
        <input value="<?php echo $user_email ?>" class="form-control" type="text" name="user_email">
    </div>
    <div class="form-group">
        <label for="user_role">Role</label>
        <br/>
        <select name="user_role" id="user_role">
        <option value='<?php echo $user_role?>'><?php echo $user_role;?></option>
<?php 
// if($user_role == 'admin') {
//     echo   "<option value='subscriber'>subscriber</option>";
// } else {
//     echo "<option value='admin'>admin</option>";
// }      
?>   
        </select>
    </div>
    <!-- <div class="form-group">
        <label for="post_image">Post Image</label>
        <input type="file" name="image">
    </div> -->
    <div class="form-group">
        <label for="user_password">Password</label>
        <input value="<?php echo $user_password; ?>" class="form-control" type="password" name="user_password">
    </div>
    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="edit_profile" value="Update Profile">
    </div>
</form>

                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
         </div>
        <!-- /#page-wrapper -->

<?php include "includes/admin_footer.php"?>