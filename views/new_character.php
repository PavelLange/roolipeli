<main class="character-form-page">

    <section class="character-form-card">

        <div class="character-form-heading">
            <p class="eyebrow">Character creation</p>

            <h1>Create Your Character</h1>

            <p>
                Choose your character and give them a name.
            </p>
        </div>

        <form class="character-form" action="/new-character" method="post">

            <!-- Character name -->
            <div class="form-group">
                <label for="character-name">Character name</label>

                <input
                    id="character-name"
                    type="text"
                    name="name"
                    maxlength="30"
                    required
                    placeholder="Enter character name"
                >
            </div>


            <!-- Character presets -->
            <div class="character-selection">

                <h2>Choose your character</h2>

                <div class="character-grid">

                    <?php foreach ($characterTypes as $key => $character): ?>

                        <button
                            type="button"
                            class="character-card"
                            data-character="<?= htmlspecialchars($key) ?>"
                        >

                            <div class="character-card-content">

                                <h3>
                                    <?= htmlspecialchars($character['name']) ?>
                                </h3>

                                <p>
                                    <?= htmlspecialchars($character['race']) ?>
                                </p>

                                <div class="character-card-stats">

                                    <p>
                                        <strong>HP:</strong>
                                        <?= htmlspecialchars($character['health']) ?>
                                    </p>

                                    <p>
                                        <strong>Mana:</strong>
                                        <?= htmlspecialchars($character['mana']) ?>
                                    </p>

                                    <p>
                                        <strong>Strength:</strong>
                                        <?= htmlspecialchars($character['strength']) ?>
                                    </p>

                                    <p>
                                        <strong>Constitution:</strong>
                                        <?= htmlspecialchars($character['constitution']) ?>
                                    </p>

                                    <p>
                                        <strong>Agility:</strong>
                                        <?= htmlspecialchars($character['agility']) ?>
                                    </p>

                                    <p>
                                        <strong>Intelligence:</strong>
                                        <?= htmlspecialchars($character['intelligence']) ?>
                                    </p>

                                    <p>
                                        <strong>Charisma:</strong>
                                        <?= htmlspecialchars($character['charisma']) ?>
                                    </p>

                                </div>

                            </div>

                        </button>

                    <?php endforeach; ?>

                </div>
            </div>

            <input type="hidden" name="race" id="selected-race">
            <input type="hidden" name="class" id="selected-class">

            <input type="hidden" name="level" id="selected-level">
            <input type="hidden" name="health" id="selected-health">
            <input type="hidden" name="mana" id="selected-mana">

            <input type="hidden" name="strength" id="selected-strength">
            <input type="hidden" name="constitution" id="selected-constitution">
            <input type="hidden" name="agility" id="selected-agility">
            <input type="hidden" name="intelligence" id="selected-intelligence">
            <input type="hidden" name="charisma" id="selected-charisma">


            <!-- Character notes -->
            <div class="form-group character-notes">

                <label for="notes">Character notes</label>

                <textarea
                    id="notes"
                    name="notes"
                    rows="6"
                    placeholder="Write something about your character..."
                ></textarea>

            </div>


            <!-- Buttons -->
            <div class="character-form-actions">

                <a href="/" class="button button-secondary">
                    Cancel
                </a>

                <button
                    type="submit"
                    class="button button-primary"
                    id="create-character-button"
                    disabled
                >
                    Create Character
                </button>

            </div>

        </form>

    </section>

</main>


<script>
    document.addEventListener('DOMContentLoaded', function () {

        const characterCards = document.querySelectorAll('.character-card');
        const createButton = document.getElementById('create-character-button');
        const characterTypes = <?= json_encode($characterTypes) ?>;

        characterCards.forEach(function (card) {

            card.addEventListener('click', function () {

                characterCards.forEach(function (card) {
                    card.classList.remove('selected');
                });

                this.classList.add('selected');

                const characterKey = this.dataset.character;
                const character = characterTypes[characterKey];

                document.getElementById('selected-race').value = character.race;
                document.getElementById('selected-class').value = characterKey;

                document.getElementById('selected-level').value = 1;
                document.getElementById('selected-health').value = character.health;
                document.getElementById('selected-mana').value = character.mana;

                document.getElementById('selected-strength').value = character.strength;
                document.getElementById('selected-constitution').value = character.constitution;
                document.getElementById('selected-agility').value = character.agility;
                document.getElementById('selected-intelligence').value = character.intelligence;
                document.getElementById('selected-charisma').value = character.charisma;

                createButton.disabled = false;
            });
        });
    });
</script>