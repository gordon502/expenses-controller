<?php
$repository = new Repository();
$logged_user = unserialize($_SESSION['user']);

$recharges =  $repository->getRechargesByUserId($logged_user->getId());
$table_content = '';

foreach ($recharges as $recharge) {
    $end_date = $recharge->getEndDate() !== null ? $recharge->getEndDate() : 'not specified';
    $table_content .= '
        <tr>
            <td>' . $recharge->getStartDate() . '</td>
            <td>' . $end_date . '</td>
            <td>' . $recharge->getAmount() / 100 . '</td>
            <td><input class="pure-button" type="submit" value="Modify">
            <form class="pure-form" method="post" action="actions/recharge/delete.php">
                <input type="hidden" name="user_id" value="' . $logged_user->getId() . '">
                <input type="hidden" name="recharge_id" value="' . $recharge->getId() . '">
                <input class="pure-button" type="submit" value="Delete"></td>
            </form>
        </tr>';
}
?>

<h3 style="color: red;"><?php
    if (isset($_SESSION['error'])) {
        echo $_SESSION['error'];
        unset($_SESSION['error']);
    }
    ?>
</h3>

<table id="rechargeTable">
    <thead>
    <tr>
        <th>Start date</th>
        <th>End date</th>
        <th>Amount</th>
        <th>Actions</th>
    </tr>
    </thead>
    <tbody>
    <?= $table_content?>
    </tbody>
</table>

<h3>Add new record:</h3>
<table class="pure-table pure-table-bordered">
    <thead>
    <tr>
        <th>Start date</th>
        <th>End date</th>
        <th>Amount (in cents)</th>
        <th></th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <form action="actions/recharge/insert.php" method="post">
            <input type="hidden" name="user_id" value="<?=$logged_user->getId()?>">
            <td><input type="date" name="startdate" required></td>
            <td><input type="date" name="enddate"></td>
            <td><input type="number" name="amount" required></td>
            <td><input type="submit" name="add" value='Insert'></td>
        </form>
    </tr>
    </tbody>
</table>
<script>$(document).ready(function () {
    $('#rechargeTable').DataTable();
})</script>
