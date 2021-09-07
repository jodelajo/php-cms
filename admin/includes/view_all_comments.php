
<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>Id</th>
            <th>Author</th>
            <th>Email</th>
            <th>Status</th>
            <th>Content</th>
            <th>In response to</th>
            <th>Date</th>
            <th>Approve</th>
            <th>Unapprove</th>
            <th>Delete</th>

            <tbody>
<?php 
findAllComments();
approveComments();
unapproveComments();
deleteComments();
?>
            </tbody>
        </tr>
    </thead>
</table>