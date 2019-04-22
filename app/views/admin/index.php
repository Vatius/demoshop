<h1>Admin Panel</h1>
<a href="/admin/create">Add product</a>
<br>
<table>
    <tr style="font-weight: bold;">
        <td>id</td>
        <td>name</td>
        <td>price</td>
        <td>[action]</td>
    </tr>
    <?php foreach($data as $item) { ?>
    <tr>
        <td><?= $item['id'] ?></td>
        <td><?= $item['name'] ?></td>
        <td><?= $item['price'] ?></td>
        <td><a href="/admin/delete?id=<?= $item['id'] ?>">Delete</a></td>
    </tr>
    <?php } ?>
</table>
<br>
<h2>Orders: </h2>
<?php if(count($orders)) { foreach($orders as $item) { ?>
    <p>Order id: <?= $item['id'] ?>, name: <?= $item['name'] ?>, tel: <?= $item['tel'] ?></p>
<?php } } else { echo 'empty'; } ?>