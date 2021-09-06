<?php 
insert_posts();
?>

<form action="" method="post" enctype="multipart/form-data"> 
    <div class="form-group">
        <label for="post_title">Post Title</label>
        <input class="form-control" type="text" name="post_title">
    </div>
    <div class="form-group">
        <select name="post_cat" id="post_cat">
<?php 
//CONNECT CAT_ID WITH CAT_TITLE
$query = "SELECT * FROM categories";
$select_categories = mysqli_query($connection, $query);

//CHECK IF CONNECTION IS SET ELSE DIE
confirmQuery($select_categories);

while ($row = mysqli_fetch_assoc($select_categories)) {
$cat_id =   $row['cat_id'];
$cat_title =   $row['cat_title'];
echo   "<option value='{$cat_id}'>{$cat_title}</option>";
}
?>
        </select>
    </div>
    <div class="form-group">
        <label for="post_author">Post Author</label>
        <input class="form-control" type="text" name="post_author">
    </div>
    <div class="form-group">
        <label for="post_status">Post Status</label>
        <input class="form-control" type="text" name="post_status">
    </div>
    <div class="form-group">
        <label for="post_image">Post Image</label>
        <input type="file" name="image">
    </div>
    <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input class="form-control" type="text" name="post_tags">
    </div>
    <div class="form-group">
        <label for="post_content">Post Content</label>
        <textarea class="form-control" name="post_content"  id="" cols="30" rows="10"></textarea>
    </div>
    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="create_post" value="Publish">
    </div>
   
</form>