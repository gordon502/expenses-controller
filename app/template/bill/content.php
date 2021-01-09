<?php
$repository = new Repository();
$user = unserialize($_SESSION['user']);
$categories = $repository->getCategoriesByUserId($user->getId());

$number = 1;
$tablecontent = '';
foreach ($categories as $category) {
    $tablecontent .= '
        <tr><form method="post" action="actions/bill/modify_or_delete_category.php">
            <td>' . $number . '</td>
            <td><input type="text" name="name" value="' . $category->getName() . '" required></td>
            <td>
                <input type="hidden" name="id" value="' . $category->getId() . '">
                <input type="hidden" name="user_id" value="' . $category->getUserId() . '">
                <input class="pure-button" type="submit" name="modify" value="Modify" style="background: deepskyblue">
                <input class="button-error pure-button" type="submit" name="delete" value="Delete" 
                onclick="return confirm(`Are you sure? This is not reversible!`)" style="background: red;">
            </td>
        </form></tr>
    ';
    $number++;
}
?>

<h2>Categories</h2>
<h3 style="color: red;"><?php
    if (isset($_SESSION['error'])) {
        echo $_SESSION['error'];
        unset($_SESSION['error']);
    }
    ?></h3>

<table class="pure-table pure-table-bordered" id="categoriesTable">
    <thead>
    <tr>
        <th>Nr</th>
        <th>Name</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody>
        <tr disabled>
            <form method="post" action="actions/bill/insert_category.php">
                <td>***NEW***<input type="hidden" name="user_id" value=<?=$user->getId()?>></td>
                <td><input type="text" name="name" required></td>
                <td><input class="pure-button" type="submit" value="Add"></td>
            </form>
        </tr>
        <?=$tablecontent?>
    </tbody>
</table>

<script>
    $(document).ready(function () {
        //$('#categoriesTable').DataTable();
    });
</script>