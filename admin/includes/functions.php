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
        // $post_comment_count =  0;
        $post_date =  date('d-m-y');
    
    
        move_uploaded_file($post_image_temp, "../images/$post_image");
    
        $query = "INSERT INTO posts(post_title, post_author, post_cat_id, post_date, post_image, post_content, post_tags, post_status) ";
        $query .= "VALUES('{$post_title}', '{$post_author}', {$post_cat_id}, now(),  '{$post_image}', '{$post_content}', '{$post_tags}', '{$post_status}') ";
    
        $create_post_query = mysqli_query($connection, $query);
        confirmQuery($create_post_query);
        header("Location: posts.php");
    }
}


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

//COMMENTS
function findAllComments() {
    global $connection;
// FIND ALL POST QUERY
    $query = "SELECT * FROM comments";
    $select_comments = mysqli_query($connection, $query);

//MAPPING OVER ARRAY OF POST
while($row = mysqli_fetch_assoc($select_comments)) {
    $comment_id =   $row['comment_id'];
    // $comment_post_id =   $row['comment_post_id'];
    $comment_author =  $row['comment_author'];
    $comment_email =   $row['comment_email'];
    $comment_post_id =  $row['comment_post_id'];
    $comment_status =  $row['comment_status'];
    $comment_content =  $row['comment_content'];
    $comment_date =  $row['comment_date'];

//OUTPUT MAP  
    echo "<tr>";
    echo "<td> $comment_id</td>";
    echo "<td> $comment_author</td>";
    echo "<td> $comment_email</td>";
    echo "<td> $comment_status</td>";
    echo "<td> $comment_content</td>";
$query = "SELECT * FROM posts WHERE post_id = $comment_post_id ";
$select_post_id_query =  mysqli_query($connection, $query);
    while ($row = mysqli_fetch_assoc($select_post_id_query)) {
        $post_id = $row['post_id'];
        $post_title = $row['post_title'];
}
    echo "<td><a href='../post.php?p_id={$post_id}'> $post_title </td>";
    echo "<td> $comment_date</td>";
    echo "<td> <a href='comments.php?approve={$comment_id}'>Approve</a></td>";
    echo "<td> <a href='comments.php?unapprove={$comment_id}'>Unapprove</a></td>";
    echo "<td> <a href='comments.php?delete={$comment_id}'>Delete</a></td>";
    echo "</tr>";
    }
}

function deleteComments() {
    global $connection;
    if(isset($_GET['delete'])) {
        $comment_id = $_GET['delete']; 
        $query = "DELETE FROM comments WHERE comment_id = {$comment_id} ";
        $delete_comment_query = mysqli_query($connection, $query);
        header("Location: comments.php");
    }
}

function unapproveComments() {
    global $connection;
    if(isset($_GET['unapprove'])) {
        $comment_id = $_GET['unapprove']; 
        $query = "UPDATE comments SET comment_status = 'unapproved' WHERE comment_id = {$comment_id} ";
        $unapprove_comment_query = mysqli_query($connection, $query); 
        header("Location: comments.php");
    }
}
function approveComments() {
    global $connection;
    if(isset($_GET['approve'])) {
        $comment_id = $_GET['approve']; 
        $query = "UPDATE comments SET comment_status = 'approved' WHERE comment_id = {$comment_id} ";
        $unapprove_comment_query = mysqli_query($connection, $query); 
        header("Location: comments.php");
    }
}
function showApprovedComments() {
    global $connection;
    if (isset($_POST['approve'])) {
        $post_id= $_GET['p_id'];
        $query = "SELECT * FROM comments WHERE comment_post_id = $post_id";
        $query .= "AND comment_status = 'approve' ";
        $query .= "ORDER BY comment_id DESC ";
        $select_comment_query = mysqli_query($connection, $query);
        confirmQuery($select_comment_query);
        while ($row = mysqli_fetch_array($select_comment_query)) {
            $comment_date = $row['comment_date'];
            $comment_content = $row['comment_content'];
            $comment_author = $row['comment_author'];
        }
    }
}

function insert_comments() {
    global $connection;
    if (isset($_POST['create_comment'])) {
        $post_id = $_GET['p_id'];
        $comment_author =  $_POST['comment_author'];
        $comment_email =  $_POST['comment_email'];
        $comment_content =  $_POST['comment_content'];
        
        $query = "INSERT INTO comments(comment_post_id, comment_author, comment_email, comment_content, comment_status, comment_date) ";
        $query .= "VALUES($post_id, '{$comment_author}', '{$comment_email}','{$comment_content}', 'unapproved', now()) ";
    
        $create_comment_query = mysqli_query($connection, $query);
        confirmQuery($create_comment_query);

        $query = "UPDATE posts SET post_comment_count = post_comment_count + 1 WHERE post_id = {$post_id} ";
        $update_query = mysqli_query($connection, $query);
        confirmQuery($update_query);
        }     
    }

    //USERS

function findAllUsers() {
    global $connection;
// FIND ALL POST QUERY
    $query = "SELECT * FROM users";
    $select_users = mysqli_query($connection, $query);

//MAPPING OVER ARRAY OF POST
while($row = mysqli_fetch_assoc($select_users)) {
    $user_id =   $row['user_id'];
    $user_email =  $row['user_email'];
    $user_password =  $row['user_password'];
    $username =  $row['username'];
    $user_firstname =   $row['user_firstname'];
    $user_lastname =  $row['user_lastname'];
    $user_role =  $row['user_role'];
    $user_image =  $row['user_image'];

//OUTPUT MAP  
    echo "<tr>";
    echo "<td> $user_id</td>";
    echo "<td> $username</td>";
    echo "<td> $user_email</td>";
    echo "<td> $user_firstname</td>";
    echo "<td> $user_lastname</td>";
    echo "<td> $user_role</td>";
    echo "<td> <a href='users.php?change_to_admin={$user_id}'>Admin</a></td>";
    echo "<td> <a href='users.php?change_to_sub={$user_id}'>Subscriber</a></td>";
    echo "<td> <a href='users.php?source=edit_user&edit_user={$user_id}'>Edit</a></td>";
    echo "<td> <a href='users.php?delete={$user_id}'>Delete</a></td>";
    echo "</tr>";
    }
}

function insert_users() {
    global $connection;
  
    if (isset($_POST['create_user'])) {

        //  $user_id =   $_POST['user_id'];
        $user_email =  $_POST['user_email'];
        $user_password =  $_POST['user_password'];
        $username =  $_POST['username'];
        $user_firstname =   $_POST['user_firstname'];
        $user_lastname =  $_POST['user_lastname'];
        $user_role =  $_POST['user_role'];
        // $user_image =   $_FILES['image']['name'];
        // $user_image_temp =  $_FILES['image']['tmp_name'];
        $user_date =  date('d-m-y');
       
    
        // move_uploaded_file($user_image_temp, "../images/$user_image");
    
        $query = "INSERT INTO users(user_email, user_password, username, user_firstname, user_lastname, user_role) ";
        $query .= "VALUES('{$user_email}', {$user_password}, '{$username}', '{$user_firstname}', '{$user_lastname}', '{$user_role}' ) ";
    
        $create_users_query = mysqli_query($connection, $query);
        confirmQuery($create_users_query);
        header("Location: users.php");
    }
}

function deleteUsers() {
    global $connection;
    if(isset($_GET['delete'])) {
        $user_id = $_GET['delete']; 
        $query = "DELETE FROM users WHERE user_id = {$user_id} ";
        $delete_user_query = mysqli_query($connection, $query);
        header("Location: users.php");
    }
}

function approveAdmin() {
    global $connection;
    if(isset($_GET['change_to_admin'])) {
        $user_id = $_GET['change_to_admin']; 
        $query = "UPDATE users SET user_role = 'admin' WHERE user_id = {$user_id} ";
        $approve_admin_query = mysqli_query($connection, $query); 
        header("Location: users.php");
    }
}

function approveSub() {
    global $connection;
    if(isset($_GET['change_to_sub'])) {
        $user_id = $_GET['change_to_sub']; 
        $query = "UPDATE users SET user_role = 'subscriber' WHERE user_id = {$user_id} ";
        $approve_sub_query = mysqli_query($connection, $query); 
        header("Location: users.php");
    }
}
?>