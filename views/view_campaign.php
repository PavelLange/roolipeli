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


            <div class="campaign-character-list">

                <!-- PLACEHOLDER CHARACTER -->

                <article class="campaign-character-card">

                    <div>
                        <h3>Drakona</h3>

                        <p>
                            Human · Mage
                        </p>
                    </div>

                    <button
                        type="button"
                        class="button button-secondary"
                    >
                        Remove
                    </button>

                </article>


                <article class="campaign-character-card">

                    <div>
                        <h3>Arkon</h3>

                        <p>
                            Elf · Warrior
                        </p>
                    </div>

                    <button
                        type="button"
                        class="button button-secondary"
                    >
                        Remove
                    </button>

                </article>

            </div>

        </div>


        <!-- MIDDLE: CAMPAIGN CHARACTERS -->

        <div class="character-column">

            <h2>Characters</h2>

            <p class="column-description">
                Characters currently playing in the campaign.
            </p>


            <div class="character-list">

                <article class="character-display-card">

                    <h3>Drakona</h3>

                    <p>Human · Mage</p>

                    <div class="character-stats">

                        <span>HP: 65</span>
                        <span>Mana: 35</span>

                    </div>

                </article>


                <article class="character-display-card">

                    <h3>Arkon</h3>

                    <p>Elf · Warrior</p>

                    <div class="character-stats">

                        <span>HP: 90</span>
                        <span>Mana: 20</span>

                    </div>

                </article>

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

                <article class="available-character-card">

                    <div>
                        <h3><?php echo htmlspecialchars($character['Nimi']); ?></h3>

                        <p>
                            <?php echo htmlspecialchars($character['Rotu']); ?> · <?php echo htmlspecialchars($character['Hahmoluokka']); ?>
                        </p>
                    </div>

                    <button
                        type="button"
                        class="button button-primary"
                    >
                        Add
                    </button>

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