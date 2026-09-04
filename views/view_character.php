<main class="view-character-page">

    <section class="view-character-card">

        <div class="view-character-header">

            <div class="view-character-image">

                <img
                    src="/images/<?= htmlspecialchars($character["Hahmoluokka"]) ?>.jpg"
                    alt="<?= htmlspecialchars($character["Nimi"]) ?>"
                >

            </div>


            <div class="view-character-heading">

                <p class="eyebrow">
                    Character
                </p>

                <h1>
                    <?= htmlspecialchars($character["Nimi"]) ?>
                </h1>

                <div class="view-character-meta">

                    <span>
                        <?= htmlspecialchars(ucfirst($character["Hahmoluokka"])) ?>
                    </span>

                    <span>
                        <?= htmlspecialchars($character["Rotu"]) ?>
                    </span>

                    <span>
                        Level <?= (int)$character["Taso"] ?>
                    </span>

                </div>

            </div>

        </div>


        <div class="view-character-section">

            <h2>
                Character Stats
            </h2>


            <div class="view-character-stats">

                <div class="view-stat">
                    <span>Health Points</span>
                    <strong>
                        <?= (int)$character["Elamapisteet"] ?>
                    </strong>
                </div>

                <div class="view-stat">
                    <span>Magic Points</span>
                    <strong>
                        <?= (int)$character["Magiapisteet"] ?>
                    </strong>
                </div>

                <div class="view-stat">
                    <span>Strength</span>
                    <strong>
                        <?= (int)$character["Voima"] ?>
                    </strong>
                </div>

                <div class="view-stat">
                    <span>Constitution</span>
                    <strong>
                        <?= (int)$character["Kestavyys"] ?>
                    </strong>
                </div>

                <div class="view-stat">
                    <span>Agility</span>
                    <strong>
                        <?= (int)$character["Ketteryys"] ?>
                    </strong>
                </div>

                <div class="view-stat">
                    <span>Intelligence</span>
                    <strong>
                        <?= (int)$character["Alykkyys"] ?>
                    </strong>
                </div>

                <div class="view-stat">
                    <span>Charisma</span>
                    <strong>
                        <?= (int)$character["Karisma"] ?>
                    </strong>
                </div>

            </div>

        </div>


        <div class="view-character-section">

            <h2>
                Character Notes
            </h2>

            <div class="view-character-notes">

                <?php if (!empty($character["Muistiinpanot"])): ?>

                    <p>
                        <?= nl2br(htmlspecialchars($character["Muistiinpanot"])) ?>
                    </p>

                <?php else: ?>

                    <p class="empty-notes">
                        This character has no notes.
                    </p>

                <?php endif; ?>

            </div>

        </div>


        <div class="view-character-actions">

            <a
                href="/my-characters"
                class="button button-secondary"
            >
                Back to My Characters
            </a>

            <a
                href="/edit-character?id=<?= (int)$character["ID"] ?>"
                class="button button-primary"
            >
                Edit Character
            </a>

        </div>

    </section>

</main>
