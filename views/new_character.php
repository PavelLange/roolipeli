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

            <div id="character-form-errors" class="character-form-errors" role="alert" aria-live="polite" style="display:none;">
            </div>

            <!-- Character name -->
            <div class="form-group">
                <label for="character-name">Character name</label>

                <input id="character-name" type="text" name="name" maxlength="30" required placeholder="Enter character name">
            </div>


            <!-- Race selection -->
            <div class="form-group">

                <label for="race-select">Choose Race</label>

                <select id="race-select" name="race" required>

                    <option value="">Select a race</option>

                    <option value="Human">Human</option>
                    <option value="Orc">Orc</option>
                    <option value="Elf">Elf</option>
                    <option value="Dwarf">Dwarf</option>
                    <option value="Gnome">Gnome</option>

                </select>

            </div>


            <!-- Class selection -->
            <div class="form-group">

                <label for="class-select">Choose Class</label>

                <select id="class-select" name="class" required>

                    <option value="">Select a class</option>

                    <option value="fighter">Fighter</option>
                    <option value="villain">Villain</option>
                    <option value="mage">Mage</option>
                    <option value="paladin">Paladin</option>
                    <option value="bard">Bard</option>
                    <option value="priest">Priest</option>
                    <option value="ranger">Ranger</option>

                </select>

            </div>


            <input type="hidden" name="level" value="1">

            <!-- Ability Points -->
            <div class="ability-points-section">

                <h2>Ability Points</h2>

                <p>
                    Available points:
                    <strong id="remaining-points">30</strong>
                </p>


                <div class="ability-list">

                    <div class="ability-row">

                        <label for="health">Health</label>

                        <input type="number" id="health" name="health" value="10" min="10" max="40" readonly>

                        <button type="button" class="ability-minus" data-stat="health">
                            -
                        </button>

                        <button type="button" class="ability-plus" data-stat="health">
                            +
                        </button>

                    </div>


                    <div class="ability-row">

                        <label for="mana">Mana</label>

                        <input type="number" id="mana" name="mana" value="10" min="10" max="40" readonly>

                        <button type="button" class="ability-minus" data-stat="mana">
                            -
                        </button>

                        <button type="button" class="ability-plus" data-stat="mana">
                            +
                        </button>

                    </div>


                    <div class="ability-row">

                        <label for="strength">Strength</label>

                        <input type="number" id="strength" name="strength" value="10" min="10" max="40" readonly>

                        <button type="button" class="ability-minus" data-stat="strength">
                            -
                        </button>

                        <button type="button" class="ability-plus" data-stat="strength">
                            +
                        </button>

                    </div>


                    <div class="ability-row">

                        <label for="constitution">Constitution</label>

                        <input type="number" id="constitution" name="constitution" value="10" min="10" max="40" readonly>

                        <button type="button" class="ability-minus" data-stat="constitution">
                            -
                        </button>

                        <button type="button" class="ability-plus" data-stat="constitution">
                            +
                        </button>

                    </div>


                    <div class="ability-row">

                        <label for="agility">Agility</label>

                        <input type="number" id="agility" name="agility" value="10" min="10" max="40" readonly>

                        <button type="button" class="ability-minus" data-stat="agility">
                            -
                        </button>

                        <button type="button" class="ability-plus" data-stat="agility">
                            +
                        </button>

                    </div>


                    <div class="ability-row">

                        <label for="intelligence">Intelligence</label>

                        <input type="number" id="intelligence" name="intelligence" value="10" min="10" max="40" readonly>

                        <button type="button" class="ability-minus" data-stat="intelligence">
                            -
                        </button>

                        <button type="button" class="ability-plus" data-stat="intelligence">
                            +
                        </button>

                    </div>


                    <div class="ability-row">

                        <label for="charisma">Charisma</label>

                        <input type="number" id="charisma" name="charisma" value="10" min="10" max="40" readonly>

                        <button type="button" class="ability-minus" data-stat="charisma">
                            -
                        </button>

                        <button type="button" class="ability-plus" data-stat="charisma">
                            +
                        </button>

                    </div>

                </div>

            </div>



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

                <button type="submit" class="button button-primary" id="create-character-button">
                    Create Character
                </button>

            </div>

        </form>

    </section>

</main>


<script>
document.addEventListener("DOMContentLoaded", function () {

    /*
     * =========================================
     * ELEMENTS
     * =========================================
     */

    const form =
        document.querySelector(".character-form");

    const nameInput =
        document.getElementById("character-name");

    const raceSelect =
        document.getElementById("race-select");

    const classSelect =
        document.getElementById("class-select");

    const createButton =
        document.getElementById("create-character-button");

    const remainingPointsElement =
        document.getElementById("remaining-points");

    const errorBox =
        document.getElementById("character-form-errors");

    const abilityPlusButtons =
        document.querySelectorAll(".ability-plus");

    const abilityMinusButtons =
        document.querySelectorAll(".ability-minus");

    const portraitModal =
        document.getElementById("portrait-modal");

    const openPortraitLibrary =
        document.getElementById("open-portrait-library");

    const closePortraitLibrary =
        document.getElementById("close-portrait-library");

    const portraitCards =
        document.querySelectorAll(".portrait-card");

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


    /*
     * =========================================
     * ABILITY POINTS
     * =========================================
     */

    const MAX_ABILITY_POINTS = 30;
    const MIN_STAT_VALUE = 10;
    const MAX_STAT_VALUE = 40;

    let remainingPoints =
        MAX_ABILITY_POINTS;


    function updateRemainingPoints() {

        remainingPointsElement.textContent =
            remainingPoints;


        abilityPlusButtons.forEach(function (button) {

            button.disabled =
                remainingPoints <= 0;

        });


        abilityMinusButtons.forEach(function (button) {

            const statName =
                button.dataset.stat;

            const input =
                document.getElementById(statName);

            button.disabled =
                parseInt(input.value, 10) <= MIN_STAT_VALUE;

        });

    }


    function changeAbility(button, amount) {

        const statName =
            button.dataset.stat;

        const input =
            document.getElementById(statName);

        const currentValue =
            parseInt(input.value, 10);


        /*
         * Increase
         */

        if (amount > 0) {

            if (remainingPoints <= 0) {
                return;
            }

            if (currentValue >= MAX_STAT_VALUE) {
                return;
            }

            input.value =
                currentValue + 1;

            remainingPoints--;

        }


        /*
         * Decrease
         */

        else {

            if (currentValue <= MIN_STAT_VALUE) {
                return;
            }

            input.value =
                currentValue - 1;

            remainingPoints++;

        }


        updateRemainingPoints();

    }


    /*
     * =========================================
     * PLUS BUTTONS
     * =========================================
     */

    abilityPlusButtons.forEach(function (button) {

        let interval = null;
        let timeout = null;


        /*
         * Normal click
         */

        button.addEventListener("click", function () {

            changeAbility(button, 1);

        });


        /*
         * Hold button
         */

        button.addEventListener("mousedown", function (event) {

            if (event.button !== 0) {
                return;
            }


            timeout = setTimeout(function () {

                interval = setInterval(function () {

                    changeAbility(button, 1);

                }, 100);

            }, 300);

        });


        /*
         * Stop holding
         */

        function stopIncreasing() {

            clearTimeout(timeout);
            clearInterval(interval);

            timeout = null;
            interval = null;

        }


        button.addEventListener(
            "mouseup",
            stopIncreasing
        );

        button.addEventListener(
            "mouseleave",
            stopIncreasing
        );

    });


    /*
     * =========================================
     * MINUS BUTTONS
     * =========================================
     */

    abilityMinusButtons.forEach(function (button) {

        let interval = null;
        let timeout = null;


        /*
         * Normal click
         */

        button.addEventListener("click", function () {

            changeAbility(button, -1);

        });


        /*
         * Hold button
         */

        button.addEventListener("mousedown", function (event) {

            if (event.button !== 0) {
                return;
            }


            timeout = setTimeout(function () {

                interval = setInterval(function () {

                    changeAbility(button, -1);

                }, 100);

            }, 300);

        });


        /*
         * Stop holding
         */

        function stopDecreasing() {

            clearTimeout(timeout);
            clearInterval(interval);

            timeout = null;
            interval = null;

        }


        button.addEventListener(
            "mouseup",
            stopDecreasing
        );

        button.addEventListener(
            "mouseleave",
            stopDecreasing
        );

    });


    updateRemainingPoints();


    /*
     * =========================================
     * PORTRAIT MODAL
     * =========================================
     */

    openPortraitLibrary.addEventListener(
        "click",
        function () {

            portraitModal.classList.add("active");

        }
    );


    closePortraitLibrary.addEventListener(
        "click",
        function () {

            portraitModal.classList.remove("active");

        }
    );


    /*
     * Close modal when clicking outside
     */

    portraitModal.addEventListener(
        "click",
        function (event) {

            if (event.target === portraitModal) {

                portraitModal.classList.remove("active");

            }

        }
    );


    /*
     * =========================================
     * PORTRAIT SELECTION
     * =========================================
     */

    portraitCards.forEach(function (card) {

        card.addEventListener(
            "click",
            function () {


                /*
                 * Remove previous selection
                 */

                portraitCards.forEach(function (item) {

                    item.classList.remove("selected");

                });


                /*
                 * Select current portrait
                 */

                card.classList.add("selected");


                /*
                 * Get avatar
                 */

                const avatar =
                    card.dataset.avatar;


                /*
                 * Save avatar
                 */

                selectedAvatar.value =
                    avatar;

                avatarType.value =
                    "library";


                /*
                 * Show preview
                 */

                selectedPreview.innerHTML =
                    '<img src="/' +
                    avatar +
                    '" alt="Selected avatar">';


                /*
                 * Close modal
                 */

                portraitModal.classList.remove("active");

            }
        );

    });


    /*
     * =========================================
     * AVATAR TABS
     * =========================================
     */

    avatarTabs.forEach(function (tab) {

        tab.addEventListener(
            "click",
            function () {


                /*
                 * Remove active tab
                 */

                avatarTabs.forEach(function (item) {

                    item.classList.remove("active");

                });


                /*
                 * Activate current tab
                 */

                tab.classList.add("active");


                const type =
                    tab.dataset.avatarTab;


                /*
                 * =================================
                 * LIBRARY
                 * =================================
                 */

                if (type === "library") {

                    libraryPanel.style.display =
                        "block";

                    uploadPanel.style.display =
                        "none";


                    avatarType.value =
                        "library";


                    /*
                     * Clear upload
                     */

                    customAvatar.value =
                        "";

                    customPreview.innerHTML =
                        "";


                    /*
                     * Clear selected avatar
                     */

                    selectedAvatar.value =
                        "";

                    selectedPreview.innerHTML =
                        "<span>No avatar selected</span>";

                }


                /*
                 * =================================
                 * UPLOAD
                 * =================================
                 */

                if (type === "upload") {

                    libraryPanel.style.display =
                        "none";

                    uploadPanel.style.display =
                        "block";


                    avatarType.value =
                        "upload";


                    /*
                     * Clear library selection
                     */

                    selectedAvatar.value =
                        "";

                    portraitCards.forEach(function (card) {

                        card.classList.remove("selected");

                    });


                    selectedPreview.innerHTML =
                        "<span>No avatar selected</span>";

                }

            }
        );

    });


    /*
     * =========================================
     * CUSTOM AVATAR
     * =========================================
     */

    customAvatar.addEventListener(
        "change",
        function () {

            const file =
                this.files[0];


            /*
             * No file
             */

            if (!file) {

                customPreview.innerHTML =
                    "";

                selectedPreview.innerHTML =
                    "<span>No avatar selected</span>";

                return;

            }


            const MAX_FILE_SIZE =
                5 * 1024 * 1024;


            const allowedTypes = [
                "image/jpeg",
                "image/png",
                "image/webp"
            ];


            /*
             * Check file size
             */

            if (file.size > MAX_FILE_SIZE) {

                alert(
                    "Image must be smaller than 5 MB."
                );

                this.value =
                    "";

                customPreview.innerHTML =
                    "";

                selectedPreview.innerHTML =
                    "<span>No avatar selected</span>";

                return;

            }


            /*
             * Check file type
             */

            if (!allowedTypes.includes(file.type)) {

                alert(
                    "Please upload a JPG, PNG or WEBP image."
                );

                this.value =
                    "";

                customPreview.innerHTML =
                    "";

                selectedPreview.innerHTML =
                    "<span>No avatar selected</span>";

                return;

            }


            /*
             * Clear library selection
             */

            selectedAvatar.value =
                "";

            portraitCards.forEach(function (card) {

                card.classList.remove("selected");

            });


            /*
             * Read image
             */

            const reader =
                new FileReader();


            reader.onload =
                function (event) {

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


                    avatarType.value =
                        "upload";

                };


            reader.readAsDataURL(file);

        }
    );


    /*
     * =========================================
     * FORM VALIDATION
     * =========================================
     */

    function validateForm() {

        const errors = [];


        /*
         * Name
         */

        const name =
            nameInput.value.trim();


        if (name.length === 0) {

            errors.push(
                "Character name is required."
            );

        }

        else if (name.length < 2) {

            errors.push(
                "Character name must be at least 2 characters."
            );

        }


        /*
         * Race
         */

        if (raceSelect.value === "") {

            errors.push(
                "Please choose a race."
            );

        }


        /*
         * Class
         */

        if (classSelect.value === "") {

            errors.push(
                "Please choose a class."
            );

        }


        /*
         * Ability points
         */

        if (remainingPoints !== 0) {

            errors.push(
                "You must spend exactly 30 ability points. " +
                "Remaining points: " +
                remainingPoints +
                "."
            );

        }


        /*
         * Avatar
         */

        let avatarSelected =
            false;


        if (
            avatarType.value === "library" &&
            selectedAvatar.value !== ""
        ) {

            avatarSelected =
                true;

        }


        if (
            avatarType.value === "upload" &&
            customAvatar.files.length > 0
        ) {

            avatarSelected =
                true;

        }


        if (!avatarSelected) {

            errors.push(
                "Please select an avatar."
            );

        }


        return errors;

    }


    /*
     * =========================================
     * SHOW ERRORS
     * =========================================
     */

    function showErrors(errors) {

        if (errors.length === 0) {

            errorBox.style.display =
                "none";

            errorBox.innerHTML =
                "";

            return;

        }


        errorBox.innerHTML =
            "<strong>Please complete the following:</strong>" +
            "<ul>" +
            errors
                .map(function (error) {

                    return "<li>" +
                        error +
                        "</li>";

                })
                .join("") +
            "</ul>";


        errorBox.style.display =
            "block";


        errorBox.scrollIntoView({
            behavior: "smooth",
            block: "center"
        });

    }


    /*
     * =========================================
     * FORM SUBMIT
     * =========================================
     */

    form.addEventListener(
        "submit",
        function (event) {

            const errors =
                validateForm();


            if (errors.length > 0) {

                event.preventDefault();

                showErrors(errors);

                return;

            }


            errorBox.style.display =
                "none";

        }
    );


    /*
     * =========================================
     * UPDATE ERRORS WHEN FORM CHANGES
     * =========================================
     */

    [
        nameInput,
        raceSelect,
        classSelect
    ].forEach(function (element) {


        element.addEventListener(
            "input",
            function () {

                if (
                    errorBox.style.display !==
                    "none"
                ) {

                    showErrors(
                        validateForm()
                    );

                }

            }
        );


        element.addEventListener(
            "change",
            function () {

                if (
                    errorBox.style.display !==
                    "none"
                ) {

                    showErrors(
                        validateForm()
                    );

                }

            }
        );

    });

});
</script>
