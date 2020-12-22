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

<script>$(document).ready(function () {
    $('#rechargeTable').DataTable();
})</script>
