<?php
session_start();

if ( !$_SESSION['loggedInUser'] ) {
  # code...
  header("Location: index.php");
}

include('includes/connection.php');

$query = "SELECT * FROM clients";
$result = mysqli_query( $conn, $query );

mysqli_close($conn);

include('includes/header.php');
?>

<h1>Client Address Book</h1>

<table class="table table-striped table-bordered">
    <tr>
        <th>Name</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Address</th>
        <th>Company</th>
        <th>Notes</th>
        <th>Edit</th>
    </tr>

    <?php
      if ( mysqli_num_rows($result) > 0 ) {
        # code...
        while ($row = mysqli_fetch_assoc($result) ) {
          # code...
          echo "<tr>";

          echo "<td>" . $row['name'] . "</td><td>" . $row['email'] . "</td><td>" . $row['phone'] . "</td><td>" . $row['address'] . "</td><td>" . $row['company'] . "</td><td>" . $row['notes'] . "</td>";

          echo '<td><a href="edit.php?id=' . $row['id'] . '" type="button" class="btn btn-primary btn-sm">
                <span class="glyphicon glyphicon-edit"></span>
                </a></td>';

          echo "</tr>";
        }

      }else{
        echo '<div class="alert alert-warning">You Have no clients!</div>';
      }

      mysqli_close($conn);

     ?>

    <tr>
        <td colspan="7"><div class="text-center"><a href="add.php" type="button" class="btn btn-sm btn-success"><span class="glyphicon glyphicon-plus"></span> Add Client</a></div></td>
    </tr>
</table>

<?php
include('includes/footer.php');
?>
