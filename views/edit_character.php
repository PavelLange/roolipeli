<main class="character-form-page">

    <section class="character-form-card">

        <div class="character-form-heading">

            <p class="eyebrow">
                Character management
            </p>

            <h1>
                Edit Your Character
            </h1>

            <p>
                Change your character's information and save your changes.
            </p>

        </div>


        <form
            class="character-form"
            action="/edit-character"
            method="post"
        >

            <input
                type="hidden"
                name="id"
                value="<?= htmlspecialchars($character["ID"]) ?>"
            >


            <!-- Character name -->

            <div class="form-group">

                <label for="character-name">
                    Character name
                </label>

                <input
                    id="character-name"
                    type="text"
                    name="name"
                    maxlength="30"
                    value="<?= htmlspecialchars($character["Nimi"]) ?>"
                    required
                >

            </div>


            <!-- Character class and race -->

            <div class="character-edit-row">

                <div class="form-group">

                    <label for="class">
                        Class
                    </label>

                    <select
                        id="class"
                        name="class"
                        required
                    >

                        <option
                            value="fighter"
                            <?= $character["Hahmoluokka"] === "fighter" ? "selected" : "" ?>
                        >
                            Fighter
                        </option>

                        <option
                            value="villain"
                            <?= $character["Hahmoluokka"] === "villain" ? "selected" : "" ?>
                        >
                            Villain
                        </option>

                        <option
                            value="mage"
                            <?= $character["Hahmoluokka"] === "mage" ? "selected" : "" ?>
                        >
                            Mage
                        </option>

                        <option
                            value="paladin"
                            <?= $character["Hahmoluokka"] === "paladin" ? "selected" : "" ?>
                        >
                            Paladin
                        </option>

                        <option
                            value="bard"
                            <?= $character["Hahmoluokka"] === "bard" ? "selected" : "" ?>
                        >
                            Bard
                        </option>

                        <option
                            value="priest"
                            <?= $character["Hahmoluokka"] === "priest" ? "selected" : "" ?>
                        >
                            Priest
                        </option>

                        <option
                            value="ranger"
                            <?= $character["Hahmoluokka"] === "ranger" ? "selected" : "" ?>
                        >
                            Ranger
                        </option>

                    </select>

                </div>


                <div class="form-group">

                    <label for="race">
                        Race
                    </label>

                    <select
                        id="race"
                        name="race"
                        required
                    >

                        <option
                            value="Human"
                            <?= $character["Rotu"] === "Human" ? "selected" : "" ?>
                        >
                            Human
                        </option>

                        <option
                            value="Elf"
                            <?= $character["Rotu"] === "Elf" ? "selected" : "" ?>
                        >
                            Elf
                        </option>

                        <option
                            value="Dwarf"
                            <?= $character["Rotu"] === "Dwarf" ? "selected" : "" ?>
                        >
                            Dwarf
                        </option>

                        <option
                            value="Orc"
                            <?= $character["Rotu"] === "Orc" ? "selected" : "" ?>
                        >
                            Orc
                        </option>

                        <option
                            value="Gnome"
                            <?= $character["Rotu"] === "Gnome" ? "selected" : "" ?>
                        >
                            Gnome
                        </option>

                    </select>

                </div>

            </div>


            <!-- Character stats -->

            <div class="character-selection">

                <h2>
                    Character stats
                </h2>


                <div class="character-stats-grid">


                    <div class="form-group">

                        <label for="level">
                            Level
                        </label>

                        <input
                            id="level"
                            type="number"
                            name="level"
                            min="1"
                            value="<?= htmlspecialchars($character["Taso"]) ?>"
                            required
                        >

                    </div>


                    <div class="form-group">

                        <label for="health">
                            Health Points
                        </label>

                        <input
                            id="health"
                            type="number"
                            name="health"
                            min="0"
                            value="<?= htmlspecialchars($character["Elamapisteet"]) ?>"
                            required
                        >

                    </div>


                    <div class="form-group">

                        <label for="mana">
                            Magic Points
                        </label>

                        <input
                            id="mana"
                            type="number"
                            name="mana"
                            min="0"
                            value="<?= htmlspecialchars($character["Magiapisteet"]) ?>"
                            required
                        >

                    </div>


                    <div class="form-group">

                        <label for="strength">
                            Strength
                        </label>

                        <input
                            id="strength"
                            type="number"
                            name="strength"
                            min="0"
                            value="<?= htmlspecialchars($character["Voima"]) ?>"
                            required
                        >

                    </div>


                    <div class="form-group">

                        <label for="constitution">
                            Constitution
                        </label>

                        <input
                            id="constitution"
                            type="number"
                            name="constitution"
                            min="0"
                            value="<?= htmlspecialchars($character["Kestavyys"]) ?>"
                            required
                        >

                    </div>


                    <div class="form-group">

                        <label for="agility">
                            Agility
                        </label>

                        <input
                            id="agility"
                            type="number"
                            name="agility"
                            min="0"
                            value="<?= htmlspecialchars($character["Ketteryys"]) ?>"
                            required
                        >

                    </div>


                    <div class="form-group">

                        <label for="intelligence">
                            Intelligence
                        </label>

                        <input
                            id="intelligence"
                            type="number"
                            name="intelligence"
                            min="0"
                            value="<?= htmlspecialchars($character["Alykkyys"]) ?>"
                            required
                        >

                    </div>


                    <div class="form-group">

                        <label for="charisma">
                            Charisma
                        </label>

                        <input
                            id="charisma"
                            type="number"
                            name="charisma"
                            min="0"
                            value="<?= htmlspecialchars($character["Karisma"]) ?>"
                            required
                        >

                    </div>

                </div>

            </div>


            <!-- Notes -->

            <div class="form-group character-notes">

                <label for="notes">
                    Character notes
                </label>

                <textarea
                    id="notes"
                    name="notes"
                    rows="6"
                    placeholder="Write something about your character..."
                ><?= htmlspecialchars($character["Muistiinpanot"]) ?></textarea>

            </div>


            <!-- Buttons -->

            <div class="character-form-actions">

                <a
                    href="/my-characters"
                    class="button button-secondary"
                >
                    Cancel
                </a>

                <button
                    type="submit"
                    class="button button-primary"
                >
                    Save Character
                </button>

            </div>

        </form>

    </section>

</main>