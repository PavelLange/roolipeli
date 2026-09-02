
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

            <p>
            Players: 
            <?= htmlspecialchars($campaign["Pelaajat"] ?? "Players")?>
            </p>
        </div>

        <div class="campaign-notes">
            <h3>Campaign notes</h3>

            <p>
                <?= htmlspecialchars(
                    $campaign["Muistiinpanot"] ?? "Campaign notes will appear here."
                ) ?>
            </p>
            <br>
            <h3>Items
            <br>
            <br>
            <?php $id = $campaign["ID"] ?>
            <a href="/view-items?id=<?=$id?>">
            <button class="button button-secondary">View items</button>
            </a>
            <a href="/new-item?id=<?=$id?>">
            <button class="button button-secondary" >Add item</button>
            </a>
            
        </div>

    </section>


    <!-- CHARACTER MANAGEMENT -->

    <section class="campaign-characters">

        <!-- LEFT: REMOVE CHARACTER -->

        <div class="character-column campaign-character-column">

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
                    <?php if($character["Tekija"] == $_SESSION["username"] || $campaign["Pelinjohtaja"] == $_SESSION["username"]):?>
                    <button
                        type="button"
                        class="button button-secondary remove-character-button"
                        data-character-id="<?= htmlspecialchars($character['ID']) ?>"
                        data-campaign-id="<?= htmlspecialchars($campaign['ID']) ?>"
                    >
                        Remove
                    </button>
                    <?php endif?>
                </article>
                <?php endforeach; ?>
            </div>

        </div>


        <!-- MIDDLE: CAMPAIGN CHARACTERS -->

        <div class="character-column characters-column">

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
                            <?php ?>
                            <form method="POST">
                            <?php if($character["Status"] == "Alive" && $campaign["Pelinjohtaja"] === $_SESSION["username"]):?>
                                <button class="set-button" name="alive" type="submit" value="<?=$character["ID"]?>">Set dead</button>
                            <?php elseif($character["Status"] == "Dead" && $campaign["Pelinjohtaja"] === $_SESSION["username"]):?>
                                <button class="set-button" name="dead" type="submit" value="<?=$character["ID"]?>" >Set alive</button>
                            <?php endif ?>
                            </form>
                        </div>

                    </article>
                <?php endforeach; ?>
            </div>

        </div>


        <!-- RIGHT: ADD CHARACTER -->

        <div class="character-column add-character-column">

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
<script>
    const username = <?= json_encode($_SESSION["username"])?>
</script>
<script>
    const gamemaster = <?= json_encode($campaign["Pelinjohtaja"])?>
</script>
<script src="js/campaign.js"></script>
