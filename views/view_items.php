<div>
<?php foreach ($allItems as $item): ?>
<div>
<h1>Item: <?= $item["Esine"]?></h1>
<h2>Description: <?= $item["Kuvaus"]?></h2>
<h2>Amount: <?= $item["Maara"]?></h2>
<a href="edit-item?id=<?=$item["ID"]?>&cid=<?=$campaignid?>">
<button>Edit</button>
</a>
<a
<?php $id = $item["ID"];?>
<?php $cid = $_GET["id"]; ?>

href="/delete-item?id=<?=$id?>&cid=<?=$cid?>"
class="button button-primary"
onClick="return confirm('Are you sure you want to delete this item?');"
>
Delete
</a>
</div>
<?php endforeach?>
<?php if(empty($allItems)):?>
<?php $cid = $_GET["id"]; ?>
<h1>Looks like you dont have any items.
</h1>    
<h2>You can create one here!</h2>
<a href="/new-item?id=<?=$cid?>">
<button>CREATE ITEM</button>
</a>
<?php endif?>
</div>