<?php
$repository = new Repository();

$recharges =  $repository->getRechargesByUserId($_SESSION['user']->getId());
$table_content = '';

foreach ($recharges as $recharge) {
    $table_content .= '
        <tr>
            <td>'. $recharge->getStartDate() . '</td>
            <td>'. $recharge->getEndDate() . '</td>
            <td>'. $recharge->getAmount() / 100 . '</td>
            <td><input class="pure-button" type="submit" value="Modify"> / <input class="pure-button" type="submit" value="Delete"></td>
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
