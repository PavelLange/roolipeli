<main class="my-campaign-page">

    <section class="my-campaign-heading">

        <p class="eyebrow">Your Characters</p>

        <h1>My Characters</h1>

        <p>
            View and manage the characters you have created.
        </p>

    </section>

    <section class="character-summary">

        <div class="summary-card">
            <span>Characters</span>
            <strong><?= $totalCharacters ?></strong>
        </div>

    </section>

    <section class="my-campaigns">

        <?php if (empty($characters)) : ?>

            <div class="campaign-empty">

                <div class="campaign-empty-icon">
                    +
                </div>

                <h2>Create your first character</h2>

                <p>
                    You don't have any characters yet.
                    Create your first character and begin your adventure.
                </p>

                <a href="/new-character" class="button button-primary">
                    Create Character
                </a>

            </div>

        <?php else : ?>

            <?php foreach ($characters as $character) : ?>

                <article class="my-campaign-card">

                    <div class="my-character-image">

                        <?php

                        if (!empty($character["Avatar"])) {

                            $characterAvatar =
                                $character["Avatar"];
                        } else {

                            $characterAvatar =
                                "images/"
                                . $character["Hahmoluokka"]
                                . ".jpg";
                        }

                        ?>

                        <img src="/<?= htmlspecialchars($characterAvatar) ?>" alt="<?= htmlspecialchars($character["Nimi"]) ?>">

                    </div>


                    <div class="my-campaign-content">

                        <p class="campaign-status <?= htmlspecialchars($character["Hahmoluokka"]) ?>">
                            <?= htmlspecialchars($character["Hahmoluokka"]) ?>
                        </p>


                        <br>

                        <p>
                            <?= htmlspecialchars($character["Rotu"]) ?>
                        </p>

                        <br>

                        <h2>
                            <?= htmlspecialchars($character["Nimi"]) ?>
                        </h2>

                        <br>

                        <p>
                            Level:
                            <?= htmlspecialchars($character["Taso"]) ?>
                        </p>

                        <p>
                            HP:
                            <?= htmlspecialchars($character["Elamapisteet"]) ?>
                        </p>


                        <div class="my-campaign-actions">

                            <a href="/view-character?id=<?= (int)$character["ID"] ?>" class="button button-primary">
                                View Character
                            </a>

                            <a href="/edit-character?id=<?= htmlspecialchars($character["ID"]) ?>" class="button button-primary">
                                Edit Character
                            </a>

                            <a href="/delete-character?id=<?= htmlspecialchars($character["ID"]) ?>" class="button button-secondary" onclick="return confirm('Are you sure you want to delete this character?');">
                                Delete
                            </a>

                        </div>

                    </div>

                </article>

            <?php endforeach; ?>

        <?php endif; ?>

    </section>

    <a href="/new-character" class="button button-primary bottom-action">
        + Create New Character
    </a>

    <a href="/" class="button button-secondary bottom-action">
        ← Back to Home
    </a>

    <?php if (!empty($characters)): ?>
        <section class="danger-zone">
            <div class="danger-zone-copy">
                <p class="eyebrow">Danger zone</p>
                <h2>Delete all characters</h2>
                <p>
                    Removes the <?= count($characters) ?> character<?= count($characters) === 1 ? "" : "s" ?>
                    you created, and takes them out of every campaign.
                    Items stay with the campaign. This cannot be undone.
                </p>
            </div>

            <form
                method="POST"
                action="/delete-all-characters"
                onsubmit="return confirm('Delete all <?= count($characters) ?> of your characters?\n\nThis cannot be undone.');"
            >
                <?= formTokenField("delete_all_characters") ?>
                <button type="submit" class="button button-danger">
                    Delete all characters
                </button>
            </form>
        </section>
    <?php endif ?>
</main>
