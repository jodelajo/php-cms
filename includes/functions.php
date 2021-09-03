<?php include "db.php"; ?>
<?php 

function blogSearch() {
    
    if (isset($_POST['submit'])) {
        $search = $_POST['search'];
        $query = "SELECT * FROM posts WHERE post_tags LIKE '%$search%' ";
        $search_query = mysqli_query($connection, $query);
        while ($row = mysqli_fetch_assoc($search_query)) {
            $post_title = $row['post_title'];
            // $post_author = $row['post_author'];
            // $post_date = $row['post_date'];
            // $post_image = $row['post_image'];
            // $post_content = $row['post_content'];

            if (!$search_query) {
                die("fail" . mysqli_error($connection));
            }

            $count = mysqli_num_rows($search_query);
            if ($count == 0) {
                echo "no result";
            } else {
                echo "<li> <a href='#'>{$post_title}</a> </li>";
            }
        }
    }
}

?>