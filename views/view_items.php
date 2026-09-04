<div>
<?php foreach ($allItems as $item): ?>
<div>
<h1>Item: <?= $item["Esine"]?></h1>
<h2>Description: <?= $item["Kuvaus"]?></h2>
<h2>Amount: <?= $item["Maara"]?></h2>
<a href="edit-item?id=<?=$item["ID"]?>&cid=<?=$campaignid?>">
<button>Edit</button>
</a>
</div>
<?php endforeach?>
</div>