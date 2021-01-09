<?php
$repository = new Repository();
$user = unserialize($_SESSION['user']);
$categories = $repository->getCategoriesByUserId($user->getId());

$number = 1;
$tablecontent = '';
foreach ($categories as $category) {
    $tablecontent .= '
        <tr><form method="post" action="actions/bill/something.php">
            <td>' . $number . '</td>
            <td><input type="text" name="name" value="' . $category->getName() . '" required></td>
            <td>
                <input type="hidden" name="id" value="' . $category->getId() . '"
                <input type="hidden" name="user_id" value="' . $category->getUserId() . '">
                <input class="pure-button" type="submit" value="Modify" style="background: deepskyblue">
                <input class="button-error pure-button" type="submit" value="Delete" onclick="confirm(`Are you sure? This is not reversible!`)"
                style="background: red;">
            </td>
        </form></tr>
    ';
    $number++;
}
?>

<h2>Categories</h2>


<table class="pure-table pure-table-bordered" id="categoriesTable">
    <thead>
    <tr>
        <th>Nr</th>
        <th>Name</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody>
        <?=$tablecontent?>
    </tbody>
</table>

<script>
    $(document).ready(function () {
        //$('#categoriesTable').DataTable();
    });
</script>