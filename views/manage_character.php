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
                    value="<?=$character["Elamapisteet"] ?>"
                    placeholder="Enter item amount..."
                    min=0
                    max=<?= $character["Elamamax"] ?>
                    required
                ><p>Max HP: <?= $character["Elamamax"]?></p>
            </div>

            <div class="form-group">
                <label for="mpamount">Current mana:</label>

                <input
                    type="number"
                    id="mpamount"
                    name="mpamount"
                    value="<?=$character["Magiapisteet"] ?>"
                    placeholder="Enter item amount..."
                    min=0
                    max=<?= $character["Magiamax"] ?>
                    required
                ><p>Max MP: <?= $character["Magiamax"]?></p>
            </div>

            <div class="form-group">
                <label for="mpamount">Current status:</label>

                <select name="charstatus">
                <option <?php echo ($character["Status"] === "Alive") ? 'selected' : '';?> value="Alive">Alive</option>
                <option <?php echo ($character["Status"] === "Dead") ? 'selected' : '';?> value="Dead">Dead</option>
                <option <?php echo ($character["Status"] === "Undead") ? 'selected' : '';?> value="Undead">Undead</option>
                <option <?php echo ($character["Status"] === "Banished") ? 'selected' : '';?> value="Banished">Banished</option>
                </select>
                <p>Current Status: <?= $character["Status"]?></p>
            </div>


            <div class="campaign-form-actions">

                <a
                    href="/view-campaign?id=<?=$cid?>"
                    class="button button-secondary"
                >
                    Cancel
                </a>

                <button
                    type="submit"
                    class="button button-primary"
                >
                    Update character
                </button>

            </div>

        </form>

    </section>

</main>