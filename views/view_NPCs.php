<?php $campaignId = (string) $campaignid; ?>
<?php
$statLabels = [
	"STR"   => "Strength",
	"CONS"  => "Constitution",
	"AGI"   => "Agility",
	"INTEL" => "Intelligence",
	"CHA"   => "Charisma",
];
?>

<main class="npcs-page">
	<section class="npcs-heading">
		<div>
			<p class="eyebrow">Campaign cast</p>
			<h1>NPCs</h1>
			<p>Keep track of the characters your party meets along the way.</p>
		</div>

		<div class="npcs-heading-actions">
			<a href="/view-campaign?id=<?= urlencode($campaignId) ?>" class="button button-secondary">
				Back to campaign
			</a>
			<a href="/new-NPC?id=<?= urlencode($campaignId) ?>" class="button button-primary">
				Add NPC
			</a>
		</div>
	</section>

	<?php if (!empty($allNPCs)): ?>
		<section class="npcs-grid" aria-label="Campaign NPCs">
			<?php foreach ($allNPCs as $NPC): ?>
				<?php
				$level = (int) ($NPC["LVL"] ?? 0);
				$hpMax = (int) ($NPC["HPMAX"] ?? 0);
				$mpMax = (int) ($NPC["MPMAX"] ?? 0);

				$stats = [];
				foreach ($statLabels as $statKey => $statLabel) {
					if ((int) ($NPC[$statKey] ?? 0) !== 0) {
						$stats[$statLabel] = (int) $NPC[$statKey];
					}
				}
				?>
				<article class="npc-card">
					<div class="npc-card-heading">
						<div class="npc-identity">
							<p class="npc-label">NPC</p>
							<h2><?= htmlspecialchars($NPC["Nimi"] ?? "Unnamed NPC") ?></h2>

							<?php if (!empty($NPC["Type"])): ?>
								<p class="npc-type"><?= htmlspecialchars($NPC["Type"]) ?></p>
							<?php endif; ?>
						</div>

						<?php if ($level !== 0): ?>
							<div class="npc-level">
								<span>Level</span>
								<strong><?= $level ?></strong>
							</div>
						<?php endif; ?>
					</div>

					<p class="npc-notes">
						<?= htmlspecialchars($NPC["Muistiinpanot"] ?? "") ?: "No notes recorded." ?>
					</p>

					<?php if ($hpMax > 0 || $mpMax > 0): ?>
						<div class="npc-bars">
							<?php if ($hpMax > 0): ?>
								<?php $hp = max(0, min((int) ($NPC["HP"] ?? 0), $hpMax)); ?>
								<div class="npc-bar">
									<div class="npc-bar-head">
										<span>HP</span>
										<strong><?= $hp ?> / <?= $hpMax ?></strong>
									</div>
									<div class="npc-bar-track">
										<div
											class="npc-bar-fill npc-bar-hp"
											style="width: <?= round($hp / $hpMax * 100) ?>%"
										></div>
									</div>
								</div>
							<?php endif; ?>

							<?php if ($mpMax > 0): ?>
								<?php $mp = max(0, min((int) ($NPC["MP"] ?? 0), $mpMax)); ?>
								<div class="npc-bar">
									<div class="npc-bar-head">
										<span>MP</span>
										<strong><?= $mp ?> / <?= $mpMax ?></strong>
									</div>
									<div class="npc-bar-track">
										<div
											class="npc-bar-fill npc-bar-mp"
											style="width: <?= round($mp / $mpMax * 100) ?>%"
										></div>
									</div>
								</div>
							<?php endif; ?>
						</div>
					<?php endif; ?>

					<?php if (!empty($stats)): ?>
						<div class="npc-stats">
							<?php foreach ($stats as $statLabel => $statValue): ?>
								<div class="npc-stat">
									<span><?= htmlspecialchars($statLabel) ?></span>
									<strong><?= $statValue ?></strong>
								</div>
							<?php endforeach; ?>
						</div>
					<?php endif; ?>

					<div class="npc-card-actions">
						<a
							href="/edit-NPC?id=<?= urlencode((string) $NPC["ID"]) ?>&cid=<?= urlencode($campaignId) ?>"
							class="button button-secondary"
						>
							Edit
						</a>
						<a
							href="/manage-NPC?id=<?= urlencode((string) $NPC["ID"]) ?>&cid=<?= urlencode($campaignId) ?>"
							class="button button-secondary"
						>
							Manage
						</a>
						<a
							href="/delete-NPC?id=<?= urlencode((string) $NPC["ID"]) ?>&cid=<?= urlencode($campaignId) ?>"
							class="button button-danger"
							onClick="return confirm('Are you sure you want to delete this NPC?');"
						>
							Delete
						</a>
					</div>
				</article>
			<?php endforeach; ?>
		</section>
	<?php else: ?>
		<section class="npcs-empty-state">
			<p class="eyebrow">Nothing recorded</p>
			<h2>This campaign has no NPCs yet.</h2>
			<p>Add the allies, villains, and strangers your party will run into.</p>
			<a href="/new-NPC?id=<?= urlencode($campaignId) ?>" class="button button-primary">
				Create first NPC
			</a>
		</section>
	<?php endif; ?>
</main>
