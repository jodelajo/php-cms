<?php include "includes/db.php" ?>
<?php include "includes/header.php" ?>

    <!-- Navigation -->
 <?php include "includes/navigation.php" ?> 

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">
            <h1 class="page-header">
                    Wolkom!
                    <small>Ja jij!</small>
                </h1>


<?php 
$query = "SELECT * FROM posts ";
// $query = "SELECT * FROM posts WHERE post_status = 'published' ";

$select_all_posts_query = mysqli_query($connection, $query);
// sort of mapfunction
while($row = mysqli_fetch_assoc($select_all_posts_query)) {
$post_title = $row['post_title'];
$post_id = $row['post_id'];
$post_author = $row['post_author'];
$post_date = $row['post_date'];
$post_image = $row['post_image'];
$post_content = substr($row['post_content'],0,150);
$post_status = $row['post_status'];

if($post_status !== 'published') {
    echo "<h1 class='text-center'>No posts here!</h1>";
} else {
?>
               
                <!-- Blog Posts Mapped-->
                <h2>
                    <a href='post.php?p_id=<?php echo $post_id; ?>'><?php echo $post_title ?></a>
                </h2>
                <p class="lead">
                    by <a href="index.php"><?php echo $post_author; ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date; ?></p>
                <hr>
                <img class="img-responsive" src="images/<?php echo $post_image; ?>" alt="">
                <hr>
                <p><?php echo $post_content ?></p>
                <a class="btn btn-primary" href='post.php?p_id=<?php echo $post_id; ?>'>Read More <span class="glyphicon glyphicon-chevron-right"></span></a>
                <!-- <hr> -->

<?php 
}}
?>
</div>

 <!-- Blog Sidebar Widgets Column -->
            <?php include "includes/sidebar.php" ?>  
        <!-- /.row -->
        <hr>
        <!-- Footer -->
      <?php include "includes/footer.php" ?>