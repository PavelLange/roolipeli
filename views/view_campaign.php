<main class="campaign-view-page">

    <!-- CAMPAIGN HEADER -->

    <section class="campaign-header">

        <div>
            <p class="eyebrow">Campaign</p>

            <h1>
                <?= htmlspecialchars($campaign["Nimi"] ?? "Campaign name") ?>
            </h1>

            <p>
                Game Master:
                <?= htmlspecialchars($campaign["Pelinjohtaja"] ?? "Game Master") ?>
            </p>
        </div>

        <div class="campaign-notes">
            <h3>Campaign notes</h3>

            <p>
                <?= htmlspecialchars(
                    $campaign["Muistiinpanot"] ?? "Campaign notes will appear here."
                ) ?>
            </p>
        </div>

    </section>


    <!-- CHARACTER MANAGEMENT -->

    <section class="campaign-characters">

        <!-- LEFT: REMOVE CHARACTER -->

        <div class="character-column">

            <h2>Characters in campaign</h2>

            <p class="column-description">
                Characters currently participating in this campaign.
            </p>


            <div class="campaign-character-list" id="campaign-character-list">

                <!-- PLACEHOLDER CHARACTER -->
                <?php foreach ($campaignCharacters as $character): ?>
                <article
                    class="campaign-character-card"
                    data-character-id="<?= htmlspecialchars($character['ID']) ?>"
                >

                    <div>
                        <h3><?= htmlspecialchars($character["Nimi"]) ?></h3>

                        <p>
                            <?= htmlspecialchars($character["Rotu"]) ?>
                            ·
                            <?= htmlspecialchars($character["Hahmoluokka"]) ?>
                        </p>
                    </div>

                    <button
                        type="button"
                        class="button button-secondary remove-character-button"
                        data-character-id="<?= htmlspecialchars($character['ID']) ?>"
                        data-campaign-id="<?= htmlspecialchars($campaign['ID']) ?>"
                    >
                        Remove
                    </button>
                </article>
                <?php endforeach; ?>
            </div>

        </div>


        <!-- MIDDLE: CAMPAIGN CHARACTERS -->

        <div class="character-column">

            <h2>Characters</h2>

            <p class="column-description">
                Characters currently playing in the campaign.
            </p>


            <div class="character-list" id="character-list">
                <?php foreach ($campaignCharacters as $character): ?>
                    <article
                        class="character-display-card"
                        data-character-id="<?= htmlspecialchars($character['ID']) ?>"
                    >
                        <h3><?= htmlspecialchars($character["Nimi"]) ?></h3>
                        <p><?= htmlspecialchars($character["Rotu"]) ?> · <?= htmlspecialchars($character["Hahmoluokka"]) ?></p>
                        <div class="character-stats">
                            <span>HP: <?= htmlspecialchars($character["Elamapisteet"]) ?></span>
                            <span>Mana: <?= htmlspecialchars($character["Magiapisteet"]) ?></span>
                            <span>Status: <?= htmlspecialchars($character["Status"]) ?></span>
                        </div>

                    </article>
                <?php endforeach; ?>
            </div>

        </div>


        <!-- RIGHT: ADD CHARACTER -->

        <div class="character-column">

            <h2>Add character</h2>

            <p class="column-description">
                Add an existing character to this campaign.
            </p>


            <div class="available-character-list">

                <?php foreach ($availableCharacters as $character): ?>

                <article
                    class="available-character-card"
                    data-character-id="<?= htmlspecialchars($character['ID']) ?>"
                >
                    <div>
                        <h3><?php echo htmlspecialchars($character['Nimi']); ?></h3>

                        <p>
                            <?php echo htmlspecialchars($character['Rotu']); ?> · <?php echo htmlspecialchars($character['Hahmoluokka']); ?>
                        </p>
                    </div>
                    <?php if (in_array($character['ID'], array_column($campaignCharacters, 'ID'))): ?>
                        <button
                            type="button"
                            class="button button-primary add-character-button"
                            disabled
                            data-character-id="<?= htmlspecialchars($character['ID']) ?>"
                            data-campaign-id="<?= htmlspecialchars($campaign['ID']) ?>"
                        >
                            Added
                        </button>
                    <?php else: ?>
                    <button
                        type="button"
                        class="button button-primary add-character-button"
                        data-character-id="<?= htmlspecialchars($character['ID']) ?>"
                        data-campaign-id="<?= htmlspecialchars($campaign['ID']) ?>"
                    >
                        Add
                    </button>
                    <?php endif; ?>


                </article>

                <?php endforeach; ?>

            </div>


            <!-- CREATE NEW CHARACTER -->

            <div class="create-character-box">

                <h3>Don't have a character yet?</h3>

                <p>
                    Create a new character and add it to this campaign.
                </p>

                <a
                    href="/new-character"
                    class="button button-primary"
                >
                    Create new character
                </a>

            </div>

        </div>

    </section>

</main>

<script src="js/campaign.js"></script>
