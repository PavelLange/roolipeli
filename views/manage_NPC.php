<main class="campaign-form-page">

    <section class="campaign-form-card">

        <div class="campaign-form-heading">
            <p class="eyebrow">Manage character</p>

            <h1>Manage character
            </h1>

            <p>
                Update your character's health and mana.
            </p>
        </div>


        <form class="campaign-form" method="POST" action="">


            <div class="form-group">
                <label for="hpamount">Current health:</label>

                <input
                    type="number"
                    id="hpamount"
                    name="hpamount"
                    value="<?=$npc["HP"] ?>"
                    placeholder="Enter item amount..."
                    min=0
                    max=<?= $npc["HPMAX"] ?>
                    required
                ><p>Max HP: <?= $npc["HPMAX"]?></p>
            </div>

            <div class="form-group">
                <label for="mpamount">Current mana:</label>

                <input
                    type="number"
                    id="mpamount"
                    name="mpamount"
                    value="<?=$npc["MP"] ?>"
                    placeholder="Enter item amount..."
                    min=0
                    max=<?= $npc["MPMAX"] ?>
                    required
                ><p>Max MP: <?= $npc["MPMAX"]?></p>
            </div>


            <div class="campaign-form-actions">

                <a
                    href="/view-NPCs?id=<?=$cid?>"
                    class="button button-secondary"
                >
                    Cancel
                </a>

                <button
                    type="submit"
                    class="button button-primary"
                >
                    Update NPC
                </button>

            </div>

        </form>

    </section>

</main>