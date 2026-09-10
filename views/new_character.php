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

                    <div class="current-race-label" id="current-race-label">
                        Select a character first.
                    </div>


                    <div class="portrait-grid" id="portrait-grid">

                        <p class="portrait-empty">
                            Select a character class to see portraits.
                        </p>

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
    document.addEventListener('DOMContentLoaded', function() {


        /*
         * =========================================
         * CHARACTER DATA
         * =========================================
         */

        const characterTypes =
            <?= json_encode($characterTypes) ?>;


        const characterCards =
            document.querySelectorAll(
                '.character-card'
            );


        const createButton =
            document.getElementById(
                'create-character-button'
            );



        /*
         * =========================================
         * CHARACTER SELECTION
         * =========================================
         */

        characterCards.forEach(function(card) {

            card.addEventListener(
                'click',
                function() {


                    /*
                     * Remove previous selection
                     */

                    characterCards.forEach(
                        function(card) {

                            card.classList.remove(
                                'selected'
                            );

                        }
                    );


                    /*
                     * Select current character
                     */

                    this.classList.add(
                        'selected'
                    );


                    const characterKey =
                        this.dataset.character;


                    const character =
                        characterTypes[
                            characterKey
                        ];


                    /*
                     * Fill hidden inputs
                     */

                    document.getElementById(
                            'selected-race'
                        ).value =
                        character.race;


                    document.getElementById(
                            'selected-class'
                        ).value =
                        characterKey;


                    document.getElementById(
                            'selected-level'
                        ).value =
                        1;


                    document.getElementById(
                            'selected-health'
                        ).value =
                        character.health;


                    document.getElementById(
                            'selected-mana'
                        ).value =
                        character.mana;


                    document.getElementById(
                            'selected-strength'
                        ).value =
                        character.strength;


                    document.getElementById(
                            'selected-constitution'
                        ).value =
                        character.constitution;


                    document.getElementById(
                            'selected-agility'
                        ).value =
                        character.agility;


                    document.getElementById(
                            'selected-intelligence'
                        ).value =
                        character.intelligence;


                    document.getElementById(
                            'selected-charisma'
                        ).value =
                        character.charisma;


                    /*
                     * Enable button
                     */

                    createButton.disabled =
                        false;


                    /*
                     * Automatically show
                     * correct race portraits.
                     */

                    loadRacePortraits(
                        character.race
                    );

                });

        });



        /*
         * =========================================
         * RACE PORTRAITS
         * =========================================
         */

        const portraitGrid =
            document.getElementById(
                'portrait-grid'
            );


        const selectedAvatar =
            document.getElementById(
                'selected-avatar'
            );


        const selectedPreview =
            document.getElementById(
                'selected-avatar-preview'
            );


        const currentRaceLabel =
            document.getElementById(
                'current-race-label'
            );



        /*
         * Load portraits dynamically
         */

        function loadRacePortraits(race) {

            const raceFolder =
                race.toLowerCase();


            currentRaceLabel.textContent =
                race + " Portraits";


            portraitGrid.innerHTML =
                '';


            /*
             * PHP-generated portrait list
             */

            const portraits =
                window.racePortraits[
                    raceFolder
                ] || [];


            if (
                portraits.length === 0
            ) {

                portraitGrid.innerHTML =
                    '<p class="portrait-empty">' +
                    'No portraits available for ' +
                    race +
                    ' yet.' +
                    '</p>';

                return;
            }


            portraits.forEach(
                function(image) {

                    const portrait =
                        document.createElement(
                            'button'
                        );


                    portrait.type =
                        'button';


                    portrait.className =
                        'portrait-card';


                    const img =
                        document.createElement(
                            'img'
                        );


                    img.src =
                        '/' + image;


                    img.alt =
                        race +
                        ' character portrait';


                    portrait.appendChild(
                        img
                    );


                    portrait.addEventListener(
                        'click',
                        function() {


                            /*
                             * Remove previous selection
                             */

                            document
                                .querySelectorAll(
                                    '.portrait-card'
                                )
                                .forEach(
                                    function(card) {

                                        card.classList.remove(
                                            'selected'
                                        );

                                    }
                                );


                            /*
                             * Select portrait
                             */

                            this.classList.add(
                                'selected'
                            );


                            /*
                             * Save path
                             */

                            selectedAvatar.value =
                                image;


                            document.getElementById(
                                    'avatar-type'
                                ).value =
                                'library';


                            /*
                             * Show preview
                             */

                            selectedPreview.innerHTML =
                                '<img src="/' +
                                image +
                                '" alt="Selected avatar">';

                        }
                    );


                    portraitGrid.appendChild(
                        portrait
                    );

                }
            );

        }



        /*
         * =========================================
         * AVATAR TABS
         * =========================================
         */

        const avatarTabs =
            document.querySelectorAll(
                '.avatar-tab'
            );


        const libraryPanel =
            document.getElementById(
                'avatar-library-panel'
            );


        const uploadPanel =
            document.getElementById(
                'avatar-upload-panel'
            );


        const avatarType =
            document.getElementById(
                'avatar-type'
            );


        avatarTabs.forEach(
            function(tab) {

                tab.addEventListener(
                    'click',
                    function() {


                        avatarTabs.forEach(
                            function(tab) {

                                tab.classList.remove(
                                    'active'
                                );

                            }
                        );


                        this.classList.add(
                            'active'
                        );


                        const type =
                            this.dataset.avatarTab;


                        /*
                         * LIBRARY
                         */

                        if (
                            type === 'library'
                        ) {

                            libraryPanel.style.display =
                                'block';


                            uploadPanel.style.display =
                                'none';


                            avatarType.value =
                                'library';


                            document.getElementById(
                                    'custom-avatar'
                                ).value =
                                '';

                        }


                        /*
                         * UPLOAD
                         */

                        if (
                            type === 'upload'
                        ) {

                            libraryPanel.style.display =
                                'none';


                            uploadPanel.style.display =
                                'block';


                            avatarType.value =
                                'upload';


                            selectedAvatar.value =
                                '';


                            document
                                .querySelectorAll(
                                    '.portrait-card'
                                )
                                .forEach(
                                    function(card) {

                                        card.classList.remove(
                                            'selected'
                                        );

                                    }
                                );

                        }

                    }
                );

            }
        );



        /*
         * =========================================
         * CUSTOM UPLOAD PREVIEW
         * =========================================
         */

        const customAvatar =
            document.getElementById(
                'custom-avatar'
            );


        const customPreview =
            document.getElementById(
                'custom-avatar-preview'
            );


        customAvatar.addEventListener(
            'change',
            function() {

                const file =
                    this.files[0];


                if (!file) {

                    customPreview.innerHTML =
                        '';

                    return;
                }


                /*
                 * Max 5 MB
                 */

                if (
                    file.size >
                    5 * 1024 * 1024
                ) {

                    alert(
                        'Image must be smaller than 5 MB.'
                    );


                    this.value =
                        '';


                    customPreview.innerHTML =
                        '';


                    return;
                }


                /*
                 * Preview
                 */

                const reader =
                    new FileReader();


                reader.onload =
                    function(event) {

                        customPreview.innerHTML =
                            '<img src="' +
                            event.target.result +
                            '" alt="Custom avatar preview">';


                        selectedPreview.innerHTML =
                            '<img src="' +
                            event.target.result +
                            '" alt="Selected avatar">';

                    };


                reader.readAsDataURL(
                    file
                );


                /*
                 * Clear library selection
                 */

                selectedAvatar.value =
                    '';


                document
                    .querySelectorAll(
                        '.portrait-card'
                    )
                    .forEach(
                        function(card) {

                            card.classList.remove(
                                'selected'
                            );

                        }
                    );

            }
        );

    });
</script>