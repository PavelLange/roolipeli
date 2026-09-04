<main class="my-campaign-page">

    <section class="my-campaign-heading">

        <p class="eyebrow">Your Characters</p>

        <h1>My Characters</h1>

        <p>
            View and manage the characters you have created.
        </p>

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

                        <img src="/images/<?= htmlspecialchars($character["Hahmoluokka"]) ?>.jpg" alt="<?= htmlspecialchars($character["Nimi"]) ?>">

                    </div>


                    <div class="my-campaign-content">

                        <p class="campaign-status">
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

</main>