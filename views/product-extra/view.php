<?php
require __DIR__ . '/users/users.php';

if (!isset($_GET['id'])) {
    include "partials/not_found.php";
    exit;
}
$userId = $_GET['id'];

$user = getUserById($userId);
if (!$user) {
    include "partials/not_found.php";
    exit;
}

?>
<div class="container">
    <div class="card">
        <div class="card-header">
            <h3>View Product Prices day/night: <b><?php// echo $user['name'] ?></b></h3>
        </div>
        <div class="card-body">
            <a class="btn btn-secondary" href="update.php?id=<?php echo $user['id'] ?>">Update</a>
            <form style="display: inline-block" method="POST" action="delete.php">
                <input type="hidden" name="id" value="<?php echo $user['id'] ?>">
                <button class="btn btn-danger">Delete</button>
            </form>
        </div>
        </td>
                <td></td>
                <td></td>
        <table class="table">
            <tbody>
            <tr>
                <th>Description:</th>
                <td><?php
                 $user[0]['Description']  ?></td>
            </tr>
            <tr>
                <th>price:</th>
                <td><?php  echo $user[0]['Price']  ?></td>
            </tr>
            <tr>
                <th>Quantity:</th>
                <td><?php echo $user[0]['Quantity']  ?></td>
            </tr>

            </tbody>
        </table>
    </div>
</div>

