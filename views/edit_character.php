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
                Change your character's name, notes or transfer up to 5 stat points.
            </p>

        </div>


        <form
            class="character-form"
            action="/edit-character"
            method="post"
            id="edit-character-form"
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


            <!-- Character information -->

            <div class="character-selection">

                <h2>Character information</h2>

                <div class="character-info-box">

                    <div class="character-info-item">

                        <span class="character-info-label">
                            Class
                        </span>

                        <span class="character-info-value">
                            <?= htmlspecialchars(ucfirst($character["Hahmoluokka"])) ?>
                        </span>

                    </div>

                    <div class="character-info-divider"></div>

                    <div class="character-info-item">

                        <span class="character-info-label">
                            Race
                        </span>

                        <span class="character-info-value">
                            <?= htmlspecialchars($character["Rotu"]) ?>
                        </span>

                    </div>

                </div>

            </div>



            <!-- Character stats -->

            <div class="character-selection">

                <div class="character-stats-heading">

                    <h2>
                        Character stats
                    </h2>

                    <p>
                        Transfer points between your stats.
                    </p>

                    <div class="stat-points-counter">

                        Available points:
                        <strong>
                            <span id="available-points">0</span> / 5
                        </strong>

                    </div>

                </div>


                <div class="character-stats-grid">


                    <!-- Health -->

                    <div class="form-group">

                        <label for="health">
                            Health Points
                        </label>

                        <div class="stat-control">

                            <button
                                type="button"
                                class="stat-button stat-minus"
                                data-stat="health"
                            >
                                −
                            </button>

                            <input
                                id="health"
                                type="number"
                                name="health"
                                value="<?= htmlspecialchars($character["Elamapisteet"]) ?>"
                                readonly
                            >

                            <button
                                type="button"
                                class="stat-button stat-plus"
                                data-stat="health"
                            >
                                +
                            </button>

                        </div>

                    </div>


                    <!-- Mana -->

                    <div class="form-group">

                        <label for="mana">
                            Magic Points
                        </label>

                        <div class="stat-control">

                            <button
                                type="button"
                                class="stat-button stat-minus"
                                data-stat="mana"
                            >
                                −
                            </button>

                            <input
                                id="mana"
                                type="number"
                                name="mana"
                                value="<?= htmlspecialchars($character["Magiapisteet"]) ?>"
                                readonly
                            >

                            <button
                                type="button"
                                class="stat-button stat-plus"
                                data-stat="mana"
                            >
                                +
                            </button>

                        </div>

                    </div>


                    <!-- Strength -->

                    <div class="form-group">

                        <label for="strength">
                            Strength
                        </label>

                        <div class="stat-control">

                            <button
                                type="button"
                                class="stat-button stat-minus"
                                data-stat="strength"
                            >
                                −
                            </button>

                            <input
                                id="strength"
                                type="number"
                                name="strength"
                                value="<?= htmlspecialchars($character["Voima"]) ?>"
                                readonly
                            >

                            <button
                                type="button"
                                class="stat-button stat-plus"
                                data-stat="strength"
                            >
                                +
                            </button>

                        </div>

                    </div>


                    <!-- Constitution -->

                    <div class="form-group">

                        <label for="constitution">
                            Constitution
                        </label>

                        <div class="stat-control">

                            <button
                                type="button"
                                class="stat-button stat-minus"
                                data-stat="constitution"
                            >
                                −
                            </button>

                            <input
                                id="constitution"
                                type="number"
                                name="constitution"
                                value="<?= htmlspecialchars($character["Kestavyys"]) ?>"
                                readonly
                            >

                            <button
                                type="button"
                                class="stat-button stat-plus"
                                data-stat="constitution"
                            >
                                +
                            </button>

                        </div>

                    </div>


                    <!-- Agility -->

                    <div class="form-group">

                        <label for="agility">
                            Agility
                        </label>

                        <div class="stat-control">

                            <button
                                type="button"
                                class="stat-button stat-minus"
                                data-stat="agility"
                            >
                                −
                            </button>

                            <input
                                id="agility"
                                type="number"
                                name="agility"
                                value="<?= htmlspecialchars($character["Ketteryys"]) ?>"
                                readonly
                            >

                            <button
                                type="button"
                                class="stat-button stat-plus"
                                data-stat="agility"
                            >
                                +
                            </button>

                        </div>

                    </div>


                    <!-- Intelligence -->

                    <div class="form-group">

                        <label for="intelligence">
                            Intelligence
                        </label>

                        <div class="stat-control">

                            <button
                                type="button"
                                class="stat-button stat-minus"
                                data-stat="intelligence"
                            >
                                −
                            </button>

                            <input
                                id="intelligence"
                                type="number"
                                name="intelligence"
                                value="<?= htmlspecialchars($character["Alykkyys"]) ?>"
                                readonly
                            >

                            <button
                                type="button"
                                class="stat-button stat-plus"
                                data-stat="intelligence"
                            >
                                +
                            </button>

                        </div>

                    </div>


                    <!-- Charisma -->

                    <div class="form-group">

                        <label for="charisma">
                            Charisma
                        </label>

                        <div class="stat-control">

                            <button
                                type="button"
                                class="stat-button stat-minus"
                                data-stat="charisma"
                            >
                                −
                            </button>

                            <input
                                id="charisma"
                                type="number"
                                name="charisma"
                                value="<?= htmlspecialchars($character["Karisma"]) ?>"
                                readonly
                            >

                            <button
                                type="button"
                                class="stat-button stat-plus"
                                data-stat="charisma"
                            >
                                +
                            </button>

                        </div>

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


<script>

document.addEventListener("DOMContentLoaded", function () {

    const MAX_TRANSFER = 5;

    const availablePoints = document.getElementById("available-points");


    const stats = {

        health: {
            input: document.getElementById("health"),
            original: <?= (int)$character["Elamapisteet"] ?>
        },

        mana: {
            input: document.getElementById("mana"),
            original: <?= (int)$character["Magiapisteet"] ?>
        },

        strength: {
            input: document.getElementById("strength"),
            original: <?= (int)$character["Voima"] ?>
        },

        constitution: {
            input: document.getElementById("constitution"),
            original: <?= (int)$character["Kestavyys"] ?>
        },

        agility: {
            input: document.getElementById("agility"),
            original: <?= (int)$character["Ketteryys"] ?>
        },

        intelligence: {
            input: document.getElementById("intelligence"),
            original: <?= (int)$character["Alykkyys"] ?>
        },

        charisma: {
            input: document.getElementById("charisma"),
            original: <?= (int)$character["Karisma"] ?>
        }

    };


    function getTotalDecrease() {

        let total = 0;

        Object.values(stats).forEach(function (stat) {

            const current = parseInt(stat.input.value);
            const difference = stat.original - current;

            if (difference > 0) {
                total += difference;
            }

        });

        return total;
    }



    function getTotalIncrease() {

        let total = 0;

        Object.values(stats).forEach(function (stat) {

            const current = parseInt(stat.input.value);
            const difference = current - stat.original;

            if (difference > 0) {
                total += difference;
            }

        });

        return total;
    }


    function getAvailablePoints() {

        const decrease = getTotalDecrease();
        const increase = getTotalIncrease();

        return decrease - increase;
    }


    function updateUI() {

        const decrease = getTotalDecrease();
        const increase = getTotalIncrease();

        const available = getAvailablePoints();


        availablePoints.textContent = Math.max(0, available);



        document.querySelectorAll(".stat-minus").forEach(function (button) {

            const statName = button.dataset.stat;
            const stat = stats[statName];

            const current = parseInt(stat.input.value);


            if (current <= 0) {

                button.disabled = true;
                return;

            }


            if (decrease >= MAX_TRANSFER) {

                button.disabled = true;
                return;

            }


            button.disabled = false;

        });


        document.querySelectorAll(".stat-plus").forEach(function (button) {

            const statName = button.dataset.stat;
            const stat = stats[statName];

            const current = parseInt(stat.input.value);



            if (available <= 0) {

                button.disabled = true;
                return;

            }


            button.disabled = false;

        });

    }


    document.querySelectorAll(".stat-minus").forEach(function (button) {

        button.addEventListener("click", function () {

            const statName = this.dataset.stat;
            const stat = stats[statName];

            const current = parseInt(stat.input.value);

            const decrease = getTotalDecrease();


            if (current <= 0) {
                return;
            }



            if (decrease >= MAX_TRANSFER) {
                return;
            }


            stat.input.value = current - 1;

            updateUI();

        });

    });


    document.querySelectorAll(".stat-plus").forEach(function (button) {

        button.addEventListener("click", function () {

            const statName = this.dataset.stat;
            const stat = stats[statName];

            const current = parseInt(stat.input.value);

            const available = getAvailablePoints();



            if (available <= 0) {
                return;
            }


            stat.input.value = current + 1;

            updateUI();

        });

    });


    updateUI();

});

</script>
