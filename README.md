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


another_file.php
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
search.php
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

### MySql commands
```php
$query = "SELECT * FROM posts";
$query = "INSERT INTO categories(cat_title) ";
```
