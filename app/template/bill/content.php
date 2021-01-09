<?php
$repository = new Repository();

$categories = $repository->getCategoriesByUserId();
?>

<h2>Categories</h2>


<table id="categoriesTable" class="display cell-border dt-center">
    <thead>
    <tr>
        <th>Name</th>
        <th></th>
        <th></th>
    </tr>
    </thead>
    <tbody>

    </tbody>
</table>

<script>
    $(document).ready(function () {
        $('#categoriesTable').DataTable();
    });
</script>