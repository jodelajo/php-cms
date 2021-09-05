<form action="" method="post"> 
                                 <div class="form-group">
                                    <label for="cat_title">Edit Category</label>
<?php
//EDIT QUERY
if(isset($_GET['edit'])) {
    $cat_id = $_GET['edit']; 
    $query = "SELECT * FROM categories WHERE cat_id = {$cat_id} ";
    $edit_categories = mysqli_query($connection, $query);
    
//MAPPING OVER ARRAY OF CATEGORIES
while ($row = mysqli_fetch_assoc($edit_categories)) {
    $cat_id =   $row['cat_id'];
    $cat_title =   $row['cat_title'];
}
?>
<input value ="<?php if(isset($cat_title)) echo $cat_title ?>" type="text" class="form-control"   name="cat_title">
<?php } ?>


<?php 
if (isset($_POST['update_category'])) {
    $cat_title = $_POST['cat_title']; //$del_cat_id === $cat_id but different name for clearance purposes
    $query = "UPDATE categories SET cat_title = ' {$cat_title}' WHERE cat_id = {$cat_id} ";
    $update_query = mysqli_query($connection, $query);
}
?>
                                  
                                </div>
                                <div class="form-group">
                                    <input class="btn btn-primary" type="submit" name="update_category" class="submit" value="Edit Category">
                                </div>
                         </form>