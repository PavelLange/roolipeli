<main class="character-form-page">

    <section class="character-form-card">

        <div class="character-form-heading">
            <p class="eyebrow">Character management</p>

            <h1>Edit Your Character</h1>

            <p>
                Change your character's information and save your changes.
            </p>
        </div>


        <form class="character-form" action="/edit-character" method="post">

            <input
                type="hidden"
                name="id"
                value="<?= htmlspecialchars($character["ID"]) ?>"
            >

            <div class="form-group">

                <label for="cname">Character name</label>

                <input
                    id="cname"
                    type="text"
                    name="name"
                    maxlength="30"
                    value="<?= htmlspecialchars($character["Nimi"]) ?>"
                    required
                >

            </div>

            <div class="character-edit-row">

                <div class="form-group">

                    <label for="class">Class</label>

                    <select id="class" name="class">

                        <option value="fighter" <?= $character["Hahmoluokka"] === "fighter" ? "selected" : "" ?>>
                            Fighter
                        </option>

                        <option value="villain" <?= $character["Hahmoluokka"] === "villain" ? "selected" : "" ?>>
                            Villain
                        </option>

                        <option value="mage" <?= $character["Hahmoluokka"] === "mage" ? "selected" : "" ?>>
                            Mage
                        </option>

                        <option value="paladin" <?= $character["Hahmoluokka"] === "paladin" ? "selected" : "" ?>>
                            Paladin
                        </option>

                        <option value="bard" <?= $character["Hahmoluokka"] === "bard" ? "selected" : "" ?>>
                            Bard
                        </option>

                        <option value="priest" <?= $character["Hahmoluokka"] === "priest" ? "selected" : "" ?>>
                            Priest
                        </option>

                        <option value="ranger" <?= $character["Hahmoluokka"] === "ranger" ? "selected" : "" ?>>
                            Ranger
                        </option>

                    </select>

                </div>


                <div class="form-group">

                    <label for="race">Race</label>

                    <select id="race" name="race">

                        <option value="Human" <?= $character["Rotu"] === "Human" ? "selected" : "" ?>>
                            Human
                        </option>

                        <option value="Elf" <?= $character["Rotu"] === "Elf" ? "selected" : "" ?>>
                            Elf
                        </option>

                        <option value="Dwarf" <?= $character["Rotu"] === "Dwarf" ? "selected" : "" ?>>
                            Dwarf
                        </option>

                        <option value="Orc" <?= $character["Rotu"] === "Orc" ? "selected" : "" ?>>
                            Orc
                        </option>

                        <option value="Gnome" <?= $character["Rotu"] === "Gnome" ? "selected" : "" ?>>
                            Gnome
                        </option>

                    </select>

                </div>

            </div>

            <div class="character-selection">

                <h2>Character stats</h2>

                <div class="character-stats-grid">


                    <div class="form-group">

                        <label for="level">Level</label>

                        <input
                            id="level"
                            type="number"
                            name="level"
                            value="<?= htmlspecialchars($character["Taso"]) ?>"
                            required
                        >

                    </div>


                    <div class="form-group">

                        <label for="health">Health Points</label>

                        <input
                            id="health"
                            type="number"
                            name="health"
                            value="<?= htmlspecialchars($character["Elamapisteet"]) ?>"
                            required
                        >

                    </div>


                    <div class="form-group">

                        <label for="mana">Magic Points</label>

                        <input
                            id="mana"
                            type="number"
                            name="mana"
                            value="<?= htmlspecialchars($character["Magiapisteet"]) ?>"
                            required
                        >

                    </div>


                    <div class="form-group">

                        <label for="strength">Strength</label>

                        <input
                            id="strength"
                            type="number"
                            name="strength"
                            value="<?= htmlspecialchars($character["Voima"]) ?>"
                            required
                        >

                    </div>


                    <div class="form-group">

                        <label for="constitution">Constitution</label>

                        <input
                            id="constitution"
                            type="number"
                            name="constitution"
                            value="<?= htmlspecialchars($character["Kestavyys"]) ?>"
                            required
                        >

                    </div>


                    <div class="form-group">

                        <label for="agility">Agility</label>

                        <input
                            id="agility"
                            type="number"
                            name="agility"
                            value="<?= htmlspecialchars($character["Ketteryys"]) ?>"
                            required
                        >

                    </div>


                    <div class="form-group">

                        <label for="intelligence">Intelligence</label>

                        <input
                            id="intelligence"
                            type="number"
                            name="intelligence"
                            value="<?= htmlspecialchars($character["Alykkyys"]) ?>"
                            required
                        >

                    </div>


                    <div class="form-group">

                        <label for="charisma">Charisma</label>

                        <input
                            id="charisma"
                            type="number"
                            name="charisma"
                            value="<?= htmlspecialchars($character["Karisma"]) ?>"
                            required
                        >

                    </div>

                </div>

            </div>

            <div class="form-group">

                <label for="creator">Creator</label>

                <input
                    id="creator"
                    type="text"
                    name="creator"
                    value="<?= htmlspecialchars($character["Tekija"]) ?>"
                    required
                >

            </div>

            <div class="form-group">

                <label for="campaign">Campaign</label>

                <input
                    id="campaign"
                    type="text"
                    name="campaign"
                    value="<?= htmlspecialchars($character["Kampanja"] ?? '') ?>"
                    required
                >

            </div>

            <div class="form-group character-notes">

                <label for="notes">Character notes</label>

                <textarea
                    id="notes"
                    name="notes"
                    rows="6"
                    placeholder="Write something about your character..."
                ><?= htmlspecialchars($character["Muistiinpanot"]) ?></textarea>

            </div>

            <div class="character-form-actions">

                <a href="/characters" class="button button-secondary">
                    Cancel
                </a>

                <button
                    type="submit"
                    class="button button-primary"
                    id="sendbutton"
                >
                    Save Character
                </button>

            </div>

        </form>

    </section>

</main>