# php-cms

### get data from database
db.php:
```php
<?php 
$db['db_host'] = "localhost";
$db['db_user'] = "root";
$db['db_password'] = "";
$db['db_name'] = "cms";

foreach($db as $key => $value) {
define(strtoupper($key), $value);
}

$connection = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
if(!$connection) {
    die("failed database connection" .  mysqli_error($connection));
}
?>
```


another_file.php:
```php
<?php include "includes/db.php" ?>
<?php 
$query = "SELECT * FROM posts";

$select_all_posts_query = mysqli_query($connection, $query);
// sort of mapfunction
while($row = mysqli_fetch_assoc($select_all_posts_query)) {
    $post_title = $row['post_title'];
    $post_author = $row['post_author'];
    $post_date = $row['post_date'];
    $post_image = $row['post_image'];
    $post_content = $row['post_content'];
?>
```
### search functionality
search.php:
```php
<?php include "includes/db.php" ?>
<?php
if (isset($_POST['submit'])) {
    $search = $_POST['search'];
    $query = "SELECT * FROM posts WHERE post_tags LIKE '%$search%' ";
    $search_query = mysqli_query($connection, $query);
    while ($row = mysqli_fetch_assoc($search_query)) {
        $post_title = $row['post_title'];
        
        if (!$search_query) {
            die("fail" . mysqli_error($connection));
        }

        $count = mysqli_num_rows($search_query);
        if ($count == 0) {
            echo "no result";
        } else { 
            echo $post_title;
        }
?>
```
### Update Database form categories
```php
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
//OUTPUT SELECTED CATEGORY IN FORM
<input value ="<?php if(isset($cat_title)) echo $cat_title ?>" type="text" class="form-control"   name="cat_title">

<?php }

//UPDATE DB
if (isset($_POST['update_category'])) {
    $cat_title = $_POST['cat_title']; 
    $query = "UPDATE categories SET cat_title = ' {$cat_title}' WHERE cat_id = {$cat_id} ";
    $update_query = mysqli_query($connection, $query);
}
?>                          
    </div>
    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="update_category" class="submit" value="Edit Category">
    </div>
</form>
```
### MySql commands
```php
$query = "SELECT * FROM posts";
$query = "INSERT INTO categories(cat_title) ";
$query = "UPDATE categories SET cat_title = ' {$cat_title}' WHERE cat_id = {$cat_id} ";
$query = "DELETE FROM categories WHERE cat_id = {$cat_id} ";

$cat_title = $_POST['cat_title']; //INSERT IN DB
$cat_title = $_GET['cat_title']; //GET FROM DB
```
### Navigation (& reload page)
```php
header("Location: categories.php");
```
### Edit post link
```php
 echo "<td> <a href='posts.php?source=edit_post&post_id={$post_id}'>Edit</a></td>";
 ```
### create excerpt
0 - 150 characters. 
```php
$post_content = substr($row['post_content'],0,150);
```


