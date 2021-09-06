<?php 

function confirmQuery($result) {
    global $connection;
    if (!$result) {
        die("query failed " .  mysqli_error($connection));
    }
}

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
            confirmQuery($create_category_query);
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
//UPDATE AND INCLUDE QUERY
function updateCategories() {
    global $connection;
if(isset($_GET['edit'])) {
    $cat_id = $_GET['edit'];
    include "includes/update_categories.php";
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

//POSTS
function insert_posts() {
    global $connection;
    if (isset($_POST['create_post'])) {
        $post_title =   $_POST['post_title'];
        $post_author =  $_POST['post_author'];
        $post_cat_id =  $_POST['post_cat'];
        $post_status =  $_POST['post_status'];
        $post_image =  $_FILES['image']['name'];
        $post_image_temp =  $_FILES['image']['tmp_name'];
        $post_tags =  $_POST['post_tags'];
        $post_content =  $_POST['post_content'];
        $post_comment_count =  4;
        $post_date =  date('d-m-y');
    
    
        move_uploaded_file($post_image_temp, "../images/$post_image");
    
        $query = "INSERT INTO posts(post_title, post_author, post_cat_id, post_date, post_image, post_content, post_tags, post_comment_count, post_status) ";
        $query .= "VALUES('{$post_title}', '{$post_author}', {$post_cat_id}, now(),  '{$post_image}', '{$post_content}', '{$post_tags}', {$post_comment_count}, '{$post_status}') ";
    
        $create_post_query = mysqli_query($connection, $query);
        confirmQuery($create_post_query);
         header("Location: posts.php");
    }
    }

    // function edit_posts() {
    //     global $connection;
    //     if (isset($_POST['edit_post'])) {
    //         $post_title =   $_POST['post_title'];
    //         $post_author =  $_POST['post_author'];
    //         $post_cat_id =  $_POST['post_cat_id'];
    //         $post_status =  $_POST['post_status'];
    //         $post_image =  $_FILES['image']['name'];
    //         $post_image_temp =  $_FILES['image']['tmp_name'];
    //         $post_tags =  $_POST['post_tags'];
    //         $post_content =  $_POST['post_content'];
    //         $post_comment_count =  4;
    //         $post_date =  date('d-m-y');
        
        
    //         move_uploaded_file($post_image_temp, "../images/$post_image");
    //         $query = "UPDATE posts SET post(post_title, post_author, post_cat_id, post_date, post_image, post_content, post_tags, post_comment_count, post_status) WHERE post_id = {$post_id}  ";
    //         // $query = "UPDATE INTO posts(post_title, post_author, post_cat_id, post_date, post_image, post_content, post_tags, post_comment_count, post_status) ";
    //         $query .= "VALUES('{$post_title}', '{$post_author}', {$post_cat_id}, now(),  '{$post_image}', '{$post_content}', '{$post_tags}', {$post_comment_count}, '{$post_status}') ";
        
    //         $create_post_query = mysqli_query($connection, $query);
    //         confirmQuery($create_post_query);
    //          header("Location: posts.php");
    //     }
    //     }


    function selectCategory($cat) {
        // $post_cat_id = $_GET['post_cat_id'];
        global $connection;
            $query = "SELECT * FROM categories WHERE  cat_id= {$cat} ";
            $select_categories = mysqli_query($connection, $query);
        
        //MAPPING OVER ARRAY OF CATEGORIES
        while($row = mysqli_fetch_assoc($select_categories)) {
            $cat_id =   $row['cat_id'];
            $cat_title =   $row['cat_title'];
    
            echo "<td>{$cat_title}</td>";
    }}


function findAllPosts() {
    global $connection;
// FIND ALL POST QUERY
    $query = "SELECT * FROM posts";
    $select_posts = mysqli_query($connection, $query);

//MAPPING OVER ARRAY OF POST
while($row = mysqli_fetch_assoc($select_posts)) {
    $post_id =   $row['post_id'];
    $post_author =  $row['post_author'];
    $post_title =   $row['post_title'];
    $post_cat_id =  $row['post_cat_id'];
    $post_status =  $row['post_status'];
    $post_image =  $row['post_image'];
    $post_tags =  $row['post_tags'];
    $post_content =  $row['post_content'];
    $post_comment_count =  $row['post_comment_count'];
    $post_date =  $row['post_date'];

//OUTPUT MAP  
    echo "<tr>";
    echo "<td> $post_id</td>";
    echo "<td> $post_author</td>";
    echo "<td> $post_title</td>";
selectCategory($post_cat_id); 
    echo "<td> $post_status</td>";
    echo "<td> <img width='100' src='../images/$post_image' 
                alt='image' /></td>";
    echo "<td> $post_tags</td>";
    echo "<td> $post_content</td>";
    echo "<td> $post_comment_count</td>";
    echo "<td> $post_date</td>";
    echo "<td> <a href='posts.php?source=edit_post&p_id={$post_id}'>Edit</a></td>";
    echo "<td> <a href='posts.php?delete={$post_id}'>Delete</a></td>";
    echo "</tr>";
    }
}

function deletePosts() {
    global $connection;
//DELETE QUERY
if(isset($_GET['delete'])) {
    $post_id = $_GET['delete']; //$del_cat_id === $cat_id but different name for clearance purposes
        $query = "DELETE FROM posts WHERE post_id = {$post_id} ";
        $delete_post_query = mysqli_query($connection, $query);
        header("Location: posts.php");
    }
}

?>