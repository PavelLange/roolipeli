<?php $campaignId = (string) $campaignid; ?>

<main class="items-page">
	<section class="items-heading">
		<div>
			<p class="eyebrow">Campaign inventory</p>
			<h1>Items</h1>
			<p>Keep track of the items and supplies available to your campaign.</p>
		</div>

		<div class="items-heading-actions">
			<a href="/view-campaign?id=<?= urlencode($campaignId) ?>" class="button button-secondary">
				Back to campaign
			</a>
			<a href="/new-item?id=<?= urlencode($campaignId) ?>" class="button button-primary">
				Add item
			</a>
		</div>
	</section>

	<?php if (!empty($allItems)): ?>
		<section class="items-grid" aria-label="Campaign items">
			<?php foreach ($allItems as $item): ?>
				<article class="item-card">
					<div class="item-card-heading">
						<div>
							<p class="item-label">Item</p>
							<h2><?= htmlspecialchars($item["Esine"] ?? "Unnamed item") ?></h2>
						</div>
						<div class="item-amount">
							<span>Amount</span>
							<strong><?= htmlspecialchars((string) ($item["Maara"] ?? 0)) ?></strong>
						</div>
					</div>

					<p class="item-description">
						<?= htmlspecialchars($item["Kuvaus"] ?? "No description provided.") ?>
					</p>

					<div class="item-card-actions">
						<a
							href="/edit-item?id=<?= urlencode((string) $item["ID"]) ?>&cid=<?= urlencode($campaignId) ?>"
							class="button button-secondary"
						>
							Edit
						</a>
						<a
							href="/delete-item?id=<?= urlencode((string) $item["ID"]) ?>&cid=<?= urlencode($campaignId) ?>"
							class="button button-danger"
							onClick="return confirm('Are you sure you want to delete this item?');"
						>
							Delete
						</a>
					</div>
				</article>
			<?php endforeach; ?>
		</section>
	<?php else: ?>
		<section class="items-empty-state">
			<p class="eyebrow">Nothing recorded</p>
			<h2>This campaign has no items yet.</h2>
			<p>Add the party's supplies, treasures, and other useful gear here.</p>
			<a href="/new-item?id=<?= urlencode($campaignId) ?>" class="button button-primary">
				Create first item
			</a>
		</section>
	<?php endif; ?>
</main>