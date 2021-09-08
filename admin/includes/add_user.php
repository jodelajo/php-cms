<?php 
insert_users();
?>

<form action="" method="post" enctype="multipart/form-data"> 
    <div class="form-group">
        <label for="user_firstname">Firstname</label>
        <input class="form-control" type="text" name="user_firstname">
    </div>
    <div class="form-group">
        <label for="user_lastname">Lastname</label>
        <input class="form-control" type="text" name="user_lastname">
    </div>
   
    <div class="form-group">
        <label for="username">Username</label>
        <input class="form-control" type="text" name="username">
    </div>
    <div class="form-group">
        <label for="user_email">Email</label>
        <input class="form-control" type="text" name="user_email">
    </div>
    <div class="form-group">
        <label for="user_role">Role</label>
        <br/>
        <select name="user_role" id="user_role">
        <option value="subscriber">Select Options</option>
            <option value="admin">Admin</option>
            <option value="subscriber">Subscriber</option>
        </select>
    </div>

    <!-- <div class="form-group">
        <label for="post_image">Post Image</label>
        <input type="file" name="image">
    </div> -->
    <div class="form-group">
        <label for="user_password">Password</label>
        <input class="form-control" type="text" name="user_password">
    </div>
    <!-- <div class="form-group">
        <label for="post_content">Post Content</label>
        <textarea class="form-control" name="post_content"  id="" cols="30" rows="10"></textarea>
    </div> -->
    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="create_user" value="Add User">
    </div>
   
</form>