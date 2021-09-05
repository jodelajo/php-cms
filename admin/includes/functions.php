<?php 

function insert_categories() {
    global $connection;
    if (isset($_POST['submit'])) {
        $cat_title = $_POST['cat_title'];
    
        if ($cat_title == "" || empty($cat_title)) {
            echo "This field should not be empty";
        } else {
            $query = "INSERT INTO categories(cat_title) ";
            $query .= "VALUE('{$cat_title}') ";
    
            $create_category_query = mysqli_query($connection, $query);
            if(!$create_category_query) {
                die("query  failed" .  mysqli_error($connection));
            }
        }
    }
}

function findAllCategories() {
    global $connection;
// FIND ALL CATEGORIES QUERY
    $query = "SELECT * FROM categories LIMIT 10";
    $select_categories = mysqli_query($connection, $query);

//MAPPING OVER ARRAY OF CATEGORIES
while($row = mysqli_fetch_assoc($select_categories)) {
    $cat_id =   $row['cat_id'];
    $cat_title =   $row['cat_title'];

//OUTPUT MAP   
    echo "<tr>";
    echo "<td> {$cat_id}</td>";
    echo "<td> {$cat_title}</td>";
    echo "<td> <a href='categories.php?edit={$cat_id}'>Edit</a></td>";
    echo "<td> <a href='categories.php?delete={$cat_id}'>Delete</a></td>";
    echo "</tr>";
    } 
}

function deleteCategories() {
    global $connection;
//DELETE QUERY
if(isset($_GET['delete'])) {
    $del_cat_id = $_GET['delete']; //$del_cat_id === $cat_id but different name for clearance purposes
        $query = "DELETE FROM categories WHERE cat_id = {$del_cat_id} ";
        $delete_query = mysqli_query($connection, $query);
        header("Location: categories.php");
    }
}

?>