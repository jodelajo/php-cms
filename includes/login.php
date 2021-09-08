<?php include "db.php"; ?>
<?php include "../admin/includes/functions.php" ?>
<?php session_start(); ?>


<div>
                        <label for="category">Categories</label>
                            <table class="table table-bordered table-hover" name="category">
                                <thead>
                                    <tr>
                                        <th>Username</th>
                                        <th>Password</th>
                                        <th>Edit</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>

<?php 
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $username = mysqli_real_escape_string($connection, $username);
    $password = mysqli_real_escape_string($connection, $password);

    $query = "SELECT * FROM users WHERE username = '{$username}' ";
    $login_query = mysqli_query($connection, $query);
    confirmQuery($login_query);

    while ($row = mysqli_fetch_array($login_query)) {
        $db_user_id = $row['user_id'];
        $db_user_firstname = $row['user_firstname'];
        $db_user_role = $row['user_role'];
        $db_user_lastname = $row['user_firstname'];
        $db_username =   $row['username'];
        $db_password =  $row['user_password'];
    }
    if ($username === $db_username && $password === $db_password) {
        $_SESSION['username'] = $db_username;
        $_SESSION['firstname'] = $db_user_firstname;
        $_SESSION['lastname'] = $db_user_lastname;
        $_SESSION['user_role'] = $db_user_role;
        header("Location: ../admin/ ");
    } else {
        header("Location: ../index.php ");
    }

        echo "<tr>";
        echo "<td> {$username}</td>";
        echo "<td> {$password}</td>";
        echo "<td> <a href='categories.php?edit={$db_user_id}'>Edit</a></td>";
        echo "<td> <a href='categories.php?delete={$db_user_id}'>Delete</a></td>";
        echo "</tr>";
    }

?>

                            </tbody>
                            </table>
                        </div>

                        
                        