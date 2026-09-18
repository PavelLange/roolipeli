<?php if(empty($allNPCs)):?>
<h1>Looks like you dont have any NPCs.</h1>
<?php $id = $_GET["id"]?>
<a href="new-NPC?id=<?=$id?>">
<button>CREATE NPC</button>
</a>
<?php else:?>
<?php 
foreach($allNPCs as $NPC): ?>
<div>
<h1><?=$NPC["Nimi"]?></h1>
<h2><?=$NPC["Muistiinpanot"]?></h2>
<p>
  <?php if ($NPC["LVL"] === 0): ?>
      <?php echo ""; ?>
  <?php else: ?>
      <?php echo "Level: " . $NPC["LVL"]; ?>
  <?php endif; ?>
</p>

<p>
  <?php if ($NPC["HPMAX"] === 0): ?>
      <?php echo ""; ?>
  <?php else: ?>
      <?php echo "HP: " . $NPC["HP"] . "/" . $NPC["HPMAX"]; ?>
  <?php endif; ?>
</p>

<p>
  <?php if ($NPC["MPMAX"] === 0): ?>
      <?php echo ""; ?>
  <?php else: ?>
      <?php echo "MP: " . $NPC["MP"] . "/" . $NPC["MPMAX"]; ?>
  <?php endif; ?>
</p>

<p>
  <?php if ($NPC["STR"] === 0): ?>
      <?php echo ""; ?>
  <?php else: ?>
      <?php echo "Strength: " . $NPC["STR"]; ?>
  <?php endif; ?>
</p>

<p>
  <?php if ($NPC["CONS"] === 0): ?>
      <?php echo ""; ?>
  <?php else: ?>
      <?php echo "Constitution: " . $NPC["CONS"]; ?>
  <?php endif; ?>
</p>

<p>
  <?php if ($NPC["AGI"] === 0): ?>
      <?php echo ""; ?>
  <?php else: ?>
      <?php echo "Agility: " . $NPC["AGI"]; ?>
  <?php endif; ?>
</p>

<p>
  <?php if ($NPC["INTEL"] === 0): ?>
      <?php echo ""; ?>
  <?php else: ?>
      <?php echo "Intelligence: " . $NPC["INTEL"]; ?>
  <?php endif; ?>
</p>

<p>
  <?php if ($NPC["CHA"] === 0): ?>
      <?php echo ""; ?>
  <?php else: ?>
      <?php echo "Charisma: " . $NPC["CHA"]; ?>
  <?php endif; ?>
</p>

<p>Type: <?=$NPC["Type"]?></p>
<?php $id = $_GET["id"]?>
<a href="edit-NPC?id=<?=$NPC["ID"]?>&cid=<?=$id?>">
<button>EDIT</button>
</a>
<a href="manage-NPC?id=<?=$NPC["ID"]?>&cid=<?=$id?>">
<button>MANAGE</button>
</a>
</div>
<?php endforeach;?>
<?php $id = $_GET["id"]?>
<a href="view-campaign?id=<?=$id?>">
<button>BACK</button>  
</a>
<?php endif;?>