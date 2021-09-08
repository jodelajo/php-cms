
<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>Id</th>
            <th>Username</th>
            <th>Email</th>
            <th>Firstname</th>
            <th>Lastname</th>
            <th>Role</th>

            <tbody>
<?php 
findAllUsers();
approveAdmin();
approveSub();
deleteUsers();
?>
            </tbody>
        </tr>
    </thead>
</table>