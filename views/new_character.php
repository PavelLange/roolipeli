<main class="character-form-page">

    <section class="character-form-card">

        <div class="character-form-heading">
            <p class="eyebrow">Character creation</p>

            <h1>Create Your Character</h1>

            <p>
                Choose your character and give them a name.
            </p>
        </div>

        <form class="character-form" action="/new-character" method="post" enctype="multipart/form-data">

            <!-- Character name -->
            <div class="form-group">
                <label for="character-name">Character name</label>

                <input id="character-name" type="text" name="name" maxlength="30" required placeholder="Enter character name">
            </div>


            <!-- Character presets -->
            <div class="character-selection">

                <h2>Choose your character</h2>

                <div class="character-grid">

                    <?php foreach ($characterTypes as $key => $character) : ?>

                        <button type="button" class="character-card" data-character="<?= htmlspecialchars($key) ?>">

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


            <div class="avatar-selection">

                <h2>
                    Choose Avatar
                </h2>

                <p class="avatar-description">
                    Choose a portrait from your character's race or upload your own.
                </p>


                <!-- Avatar tabs -->

                <div class="avatar-tabs">

                    <button type="button" class="avatar-tab active" data-avatar-tab="library">
                        Portrait Library
                    </button>


                    <button type="button" class="avatar-tab" data-avatar-tab="upload">
                        Custom Upload
                    </button>

                </div>

                <div class="avatar-panel" id="avatar-library-panel">

                    <button type="button" class="open-portrait-library" id="open-portrait-library">
                        Choose from Portrait Library
                    </button>

                </div>


                <div class="portrait-modal" id="portrait-modal">

                    <div class="portrait-modal-content">

                        <button type="button" class="portrait-modal-close" id="close-portrait-library">
                            ×
                        </button>

                        <h2>Portrait Library</h2>

                        <div class="portrait-grid" id="portrait-grid">

                            <?php
                            $libraryAvatars = [
                                "images/fighter.jpg",
                                "images/villain.jpg",
                                "images/mage.jpg",
                                "images/paladin.jpg",
                                "images/bard.jpg",
                                "images/priest.jpg",
                                "images/ranger.jpg",
                                "images/orc.jpg",
                                "images/dwarf.jpg",
                                "images/gnome.jpg"
                            ];
                            ?>

                            <?php foreach ($libraryAvatars as $avatar) : ?>

                                <button type="button" class="portrait-card" data-avatar="<?= htmlspecialchars($avatar) ?>">

                                    <img src="/<?= htmlspecialchars($avatar) ?>" alt="Character portrait">

                                </button>

                            <?php endforeach; ?>

                        </div>

                    </div>

                </div>


                <div class="avatar-panel" id="avatar-upload-panel" style="display:none;">

                    <div class="custom-avatar-upload">

                        <label for="custom-avatar">
                            Upload your own portrait
                        </label>


                        <input type="file" id="custom-avatar" name="custom_avatar" accept="image/jpeg,image/png,image/webp">


                        <p>
                            JPG, PNG or WEBP. Maximum 5 MB.
                        </p>


                        <div id="custom-avatar-preview" class="custom-avatar-preview"></div>

                    </div>

                </div>

                <!-- Avatar type -->

                <input type="hidden" name="avatar_type" id="avatar-type" value="library">


                <!-- Selected library avatar -->

                <input type="hidden" name="avatar" id="selected-avatar" value="">


                <!-- Selected avatar preview -->

                <div class="selected-avatar-preview" id="selected-avatar-preview">

                    <span>
                        No avatar selected
                    </span>

                </div>

            </div>

            <!-- Character notes -->
            <div class="form-group character-notes">

                <label for="notes">Character notes</label>

                <textarea id="notes" name="notes" rows="6" placeholder="Write something about your character..."></textarea>

            </div>


            <!-- Buttons -->
            <div class="character-form-actions">

                <a href="/" class="button button-secondary">
                    Cancel
                </a>

                <button type="submit" class="button button-primary" id="create-character-button" disabled>
                    Create Character
                </button>

            </div>

        </form>

    </section>

</main>


<script>
    document.addEventListener("DOMContentLoaded", function() {

        /*
         * =========================================
         * CHARACTER DATA
         * =========================================
         */

        const characterTypes = <?= json_encode($characterTypes) ?>;

        const characterCards =
            document.querySelectorAll(".character-card");

        const createButton =
            document.getElementById("create-character-button");


        /*
         * =========================================
         * AVATAR ELEMENTS
         * =========================================
         */

        const portraitGrid =
            document.getElementById("portrait-grid");

        const selectedAvatar =
            document.getElementById("selected-avatar");

        const selectedPreview =
            document.getElementById("selected-avatar-preview");

        const avatarType =
            document.getElementById("avatar-type");

        const customAvatar =
            document.getElementById("custom-avatar");

        const customPreview =
            document.getElementById("custom-avatar-preview");

        const libraryPanel =
            document.getElementById("avatar-library-panel");

        const uploadPanel =
            document.getElementById("avatar-upload-panel");

        const avatarTabs =
            document.querySelectorAll(".avatar-tab");

        const portraitModal =
            document.getElementById("portrait-modal");

        const openPortraitLibrary =
            document.getElementById("open-portrait-library");

        const closePortraitLibrary =
            document.getElementById("close-portrait-library");

        const portraitCards =
            document.querySelectorAll(".portrait-card");



        /*
         * =========================================
         * AVATAR LIBRARY
         * =========================================
         */

        const libraryAvatars = [
            "images/fighter.jpg",
            "images/villain.jpg",
            "images/mage.jpg",
            "images/paladin.jpg",
            "images/bard.jpg",
            "images/priest.jpg",
            "images/ranger.jpg",
            "images/orc.jpg",
            "images/dwarf.jpg",
            "images/gnome.jpg"
        ];

        /*
         * =========================================
         * PORTRAIT LIBRARY MODAL
         * =========================================
         */

        openPortraitLibrary.addEventListener("click", function() {

            portraitModal.classList.add("active");

        });


        closePortraitLibrary.addEventListener("click", function() {

            portraitModal.classList.remove("active");

        });


        /*
         * Close modal when clicking outside
         */

        portraitModal.addEventListener("click", function(event) {

            if (event.target === portraitModal) {

                portraitModal.classList.remove("active");

            }

        });

        /*
         * =========================================
         * PORTRAIT SELECTION
         * =========================================
         */

        portraitCards.forEach(function(card) {

            card.addEventListener("click", function() {

                /*
                 * Remove old selection
                 */

                portraitCards.forEach(function(item) {

                    item.classList.remove("selected");

                });


                /*
                 * Select current portrait
                 */

                this.classList.add("selected");


                /*
                 * Get selected avatar
                 */

                const avatar =
                    this.dataset.avatar;


                /*
                 * Save avatar to hidden input
                 */

                selectedAvatar.value = avatar;

                avatarType.value = "library";


                /*
                 * Show selected avatar
                 * in preview
                 */

                selectedPreview.innerHTML =
                    '<img src="/' +
                    avatar +
                    '" alt="Selected avatar">';


                /*
                 * Close modal
                 */

                portraitModal.classList.remove("active");


                /*
                 * Update create button
                 */

                updateCreateButton();

            });

        });


        /*
         * =========================================
         * CHARACTER SELECTION
         * =========================================
         */

        characterCards.forEach(function(card) {

            card.addEventListener("click", function() {

                /*
                 * Remove old selection
                 */

                characterCards.forEach(function(item) {

                    item.classList.remove("selected");

                });


                /*
                 * Select character
                 */

                this.classList.add("selected");


                const characterKey =
                    this.dataset.character;

                const character =
                    characterTypes[characterKey];


                /*
                 * Fill hidden character inputs
                 */

                document.getElementById("selected-race").value =
                    character.race;

                document.getElementById("selected-class").value =
                    characterKey;

                document.getElementById("selected-level").value =
                    1;

                document.getElementById("selected-health").value =
                    character.health;

                document.getElementById("selected-mana").value =
                    character.mana;

                document.getElementById("selected-strength").value =
                    character.strength;

                document.getElementById("selected-constitution").value =
                    character.constitution;

                document.getElementById("selected-agility").value =
                    character.agility;

                document.getElementById("selected-intelligence").value =
                    character.intelligence;

                document.getElementById("selected-charisma").value =
                    character.charisma;


                /*
                 * Update create button
                 */

                updateCreateButton();

            });

        });



        /*
         * =========================================
         * AVATAR TABS
         * =========================================
         */

        avatarTabs.forEach(function(tab) {

            tab.addEventListener("click", function() {

                /*
                 * Remove active from all tabs
                 */

                avatarTabs.forEach(function(item) {

                    item.classList.remove("active");

                });


                /*
                 * Activate current tab
                 */

                this.classList.add("active");


                const type =
                    this.dataset.avatarTab;


                /*
                 * =================================
                 * LIBRARY
                 * =================================
                 */

                if (type === "library") {

                    libraryPanel.style.display = "block";

                    uploadPanel.style.display = "none";

                    avatarType.value = "library";


                    /*
                     * Clear custom upload
                     */

                    customAvatar.value = "";

                    customPreview.innerHTML = "";


                    /*
                     * Do NOT automatically select
                     * an avatar.
                     *
                     * User must click one.
                     */

                    selectedAvatar.value = "";


                    selectedPreview.innerHTML =
                        "<span>No avatar selected</span>";


                    updateCreateButton();

                }


                /*
                 * =================================
                 * CUSTOM UPLOAD
                 * =================================
                 */

                if (type === "upload") {

                    libraryPanel.style.display = "none";

                    uploadPanel.style.display = "block";

                    avatarType.value = "upload";


                    /*
                     * Clear library selection
                     */

                    selectedAvatar.value = "";


                    document
                        .querySelectorAll(".portrait-card")
                        .forEach(function(card) {

                            card.classList.remove("selected");

                        });


                    selectedPreview.innerHTML =
                        "<span>No avatar selected</span>";


                    updateCreateButton();

                }

            });

        });


        /*
         * =========================================
         * CUSTOM AVATAR UPLOAD
         * =========================================
         */

        customAvatar.addEventListener("change", function() {

            const file =
                this.files[0];


            /*
             * No file
             */

            if (!file) {

                customPreview.innerHTML = "";

                selectedPreview.innerHTML =
                    "<span>No avatar selected</span>";

                updateCreateButton();

                return;

            }


            /*
             * Maximum 5 MB
             */

            if (file.size > 5 * 1024 * 1024) {

                alert("Image must be smaller than 5 MB.");

                this.value = "";

                customPreview.innerHTML = "";

                selectedPreview.innerHTML =
                    "<span>No avatar selected</span>";

                updateCreateButton();

                return;

            }


            /*
             * Check image type
             */

            const allowedTypes = [
                "image/jpeg",
                "image/png",
                "image/webp"
            ];


            if (!allowedTypes.includes(file.type)) {

                alert("Please upload a JPG, PNG or WEBP image.");

                this.value = "";

                customPreview.innerHTML = "";

                selectedPreview.innerHTML =
                    "<span>No avatar selected</span>";

                updateCreateButton();

                return;

            }


            /*
             * Clear library selection
             */

            selectedAvatar.value = "";

            document
                .querySelectorAll(".portrait-card")
                .forEach(function(card) {

                    card.classList.remove("selected");

                });


            /*
             * Read image
             */

            const reader =
                new FileReader();


            reader.onload = function(event) {

                const imageURL =
                    event.target.result;


                /*
                 * Upload preview
                 */

                customPreview.innerHTML =
                    '<img src="' +
                    imageURL +
                    '" alt="Custom avatar preview">';


                /*
                 * Selected avatar preview
                 */

                selectedPreview.innerHTML =
                    '<img src="' +
                    imageURL +
                    '" alt="Selected avatar">';


                /*
                 * Mark avatar as selected
                 */

                avatarType.value = "upload";


                updateCreateButton();

            };


            reader.readAsDataURL(file);

        });


        /*
         * =========================================
         * CREATE BUTTON
         * =========================================
         *
         * Character + avatar are both required.
         */

        function updateCreateButton() {

            const characterSelected =
                document.querySelector(
                    ".character-card.selected"
                );


            let avatarSelected = false;


            /*
             * Library avatar
             */

            if (
                avatarType.value === "library" &&
                selectedAvatar.value !== ""
            ) {

                avatarSelected = true;

            }


            /*
             * Custom upload
             */

            if (
                avatarType.value === "upload" &&
                customAvatar.files.length > 0
            ) {

                avatarSelected = true;

            }


            /*
             * Enable only when BOTH
             * character and avatar exist.
             */

            createButton.disabled = !characterSelected ||
                !avatarSelected;

        }


        /*
         * =========================================
         * INITIAL STATE
         * =========================================
         */

        createButton.disabled = true;

        selectedAvatar.value = "";

        avatarType.value = "library";

    });
</script>