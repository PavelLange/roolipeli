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


        <form class="character-form" action="/edit-character" method="post" id="edit-character-form" enctype="multipart/form-data">

            <input type="hidden" name="id" value="<?= htmlspecialchars($character["ID"]) ?>">


            <!-- Character information -->
            <div class="character-selection">
                <h2>Character information</h2>

                <div class="character-info-box">

                    <div class="character-info-item">

                        <span class="character-info-label">
                            Character name
                        </span>

                        <span class="character-info-value">
                            <?= htmlspecialchars($character["Nimi"]) ?>
                        </span>

                    </div>

                    <div class="character-info-divider"></div>

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
                        Transfer points between your stats or use points gained from leveling up.
                    </p>

                    <div class="stat-points-counter">

                        Available points:
                        <strong>
                            <span id="available-points">0</span>
                        </strong>

                    </div>

                </div>


                <div class="character-stats-grid">

                    <!-- Level -->

                    <div class="form-group">

                        <label for="level">
                            Level
                        </label>

                        <div class="stat-control">

                            <button type="button" class="stat-button" id="level-minus">
                                −
                            </button>

                            <input id="level" type="number" name="level" value="<?= (int)$character["Taso"] ?>" readonly>

                            <button type="button" class="stat-button" id="level-plus">
                                +
                            </button>

                        </div>

                    </div>


                    <!-- Health -->

                    <div class="form-group">

                        <label for="health">
                            Health Points
                        </label>

                        <div class="stat-control">

                            <button type="button" class="stat-button stat-minus" data-stat="health">
                                −
                            </button>

                            <input id="health" type="number" name="health" value="<?= htmlspecialchars($character["Elamamax"]) ?>" readonly>

                            <button type="button" class="stat-button stat-plus" data-stat="health">
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

                            <button type="button" class="stat-button stat-minus" data-stat="mana">
                                −
                            </button>

                            <input id="mana" type="number" name="mana" value="<?= htmlspecialchars($character["Magiamax"]) ?>" readonly>

                            <button type="button" class="stat-button stat-plus" data-stat="mana">
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

                            <button type="button" class="stat-button stat-minus" data-stat="strength">
                                −
                            </button>

                            <input id="strength" type="number" name="strength" value="<?= htmlspecialchars($character["Voima"]) ?>" readonly>

                            <button type="button" class="stat-button stat-plus" data-stat="strength">
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

                            <button type="button" class="stat-button stat-minus" data-stat="constitution">
                                −
                            </button>

                            <input id="constitution" type="number" name="constitution" value="<?= htmlspecialchars($character["Kestavyys"]) ?>" readonly>

                            <button type="button" class="stat-button stat-plus" data-stat="constitution">
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

                            <button type="button" class="stat-button stat-minus" data-stat="agility">
                                −
                            </button>

                            <input id="agility" type="number" name="agility" value="<?= htmlspecialchars($character["Ketteryys"]) ?>" readonly>

                            <button type="button" class="stat-button stat-plus" data-stat="agility">
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

                            <button type="button" class="stat-button stat-minus" data-stat="intelligence">
                                −
                            </button>

                            <input id="intelligence" type="number" name="intelligence" value="<?= htmlspecialchars($character["Alykkyys"]) ?>" readonly>

                            <button type="button" class="stat-button stat-plus" data-stat="intelligence">
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

                            <button type="button" class="stat-button stat-minus" data-stat="charisma">
                                −
                            </button>

                            <input id="charisma" type="number" name="charisma" value="<?= htmlspecialchars($character["Karisma"]) ?>" readonly>

                            <button type="button" class="stat-button stat-plus" data-stat="charisma">
                                +
                            </button>

                        </div>

                    </div>

                </div>

            </div>

            <!-- Avatar -->

            <div class="avatar-selection">

                <h2>
                    Choose Avatar
                </h2>

                <p class="avatar-description">
                    Change your character's portrait or keep the current one.
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


                <!-- Library -->

                <div class="avatar-panel" id="avatar-library-panel">

                    <button type="button" class="open-portrait-library" id="open-portrait-library">
                        Choose from Portrait Library
                    </button>

                </div>


                <!-- Portrait Modal -->

                <!-- AVATAR LIBRARY -->

                <div class="portrait-modal" id="portrait-modal">

                    <div class="portrait-modal-content">

                        <button type="button" class="portrait-modal-close" id="close-portrait-library">
                            ×
                        </button>

                        <h2>
                            Portrait Library
                        </h2>

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

                                <button type="button" class="portrait-card <?= $character["Avatar"] === $avatar ? "selected" : "" ?>" data-avatar="<?= htmlspecialchars($avatar) ?>">

                                    <img src="/<?= htmlspecialchars($avatar) ?>" alt="Character portrait">

                                </button>

                            <?php endforeach; ?>

                        </div>

                    </div>

                </div>


                <!-- Upload -->

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

                <input type="hidden" name="avatar_type" id="avatar-type" value="current">


                <!-- Selected avatar -->

                <input type="hidden" name="avatar" id="selected-avatar" value="<?= htmlspecialchars($character["Avatar"] ?? "") ?>">


                <!-- Current / selected preview -->

                <div class="selected-avatar-preview" id="selected-avatar-preview">

                    <?php if (!empty($character["Avatar"])) : ?>

                        <img src="/<?= htmlspecialchars($character["Avatar"]) ?>" alt="Current avatar">

                    <?php else : ?>

                        <span>
                            No avatar selected
                        </span>

                    <?php endif; ?>

                </div>

            </div>


            <!-- Notes -->

            <div class="form-group character-notes">

                <label for="notes">
                    Character notes
                </label>

                <textarea id="notes" name="notes" rows="6" placeholder="Write something about your character..."><?= htmlspecialchars($character["Muistiinpanot"]) ?></textarea>

            </div>


            <!-- Buttons -->

            <div class="character-form-actions">

                <a href="/my-characters" class="button button-secondary">
                    Cancel
                </a>

                <button type="submit" class="button button-primary">
                    Save Character
                </button>

            </div>

        </form>

    </section>

</main>

<script>
    document.addEventListener("DOMContentLoaded", function() {

        const MAX_TRANSFER = 5;
        const MAX_HEALTH_MAGIC_TRANSFER = 50;
        const POINTS_PER_LEVEL = 5;
        const MAX_LEVEL = 100;


        /* =========================
           LEVEL
        ========================= */

        const levelInput =
            document.getElementById("level");

        const levelPlus =
            document.getElementById("level-plus");

        const levelMinus =
            document.getElementById("level-minus");

        const originalLevel =
            <?= (int)$character["Taso"] ?>;


        const availablePoints =
            document.getElementById("available-points");


        /* =========================
           STATS
        ========================= */

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

        /* =========================
            AVATAR
        ========================= */

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

        /* =========================
        PORTRAIT LIBRARY MODAL
        ========================= */

        openPortraitLibrary.addEventListener("click", function() {

            portraitModal.classList.add("active");

        });


        closePortraitLibrary.addEventListener("click", function() {

            portraitModal.classList.remove("active");

        });


        portraitModal.addEventListener("click", function(event) {

            if (event.target === portraitModal) {

                portraitModal.classList.remove("active");

            }

        });

        /* =========================
        PORTRAIT SELECTION
        ========================= */

        portraitCards.forEach(function(card) {

            card.addEventListener("click", function() {

                portraitCards.forEach(function(item) {

                    item.classList.remove("selected");

                });


                this.classList.add("selected");


                const avatar =
                    this.dataset.avatar;


                selectedAvatar.value =
                    avatar;


                avatarType.value =
                    "library";


                selectedPreview.innerHTML =
                    '<img src="/' +
                    avatar +
                    '" alt="Selected avatar">';


                portraitModal.classList.remove("active");

            });

        });

        /* =========================
        AVATAR TABS
        ========================= */

        avatarTabs.forEach(function(tab) {

            tab.addEventListener("click", function() {

                avatarTabs.forEach(function(item) {

                    item.classList.remove("active");

                });


                this.classList.add("active");


                const type =
                    this.dataset.avatarTab;


                if (type === "library") {

                    libraryPanel.style.display =
                        "block";

                    uploadPanel.style.display =
                        "none";


                    avatarType.value =
                        "library";

                }


                if (type === "upload") {

                    libraryPanel.style.display =
                        "none";

                    uploadPanel.style.display =
                        "block";


                    avatarType.value =
                        "upload";

                }

            });

        });

        /* =========================
        CUSTOM AVATAR UPLOAD
        ========================= */

        customAvatar.addEventListener("change", function() {

            const file =
                this.files[0];


            if (!file) {

                customPreview.innerHTML = "";

                return;

            }


            /*
             * Maximum 5 MB
             */

            if (file.size > 5 * 1024 * 1024) {

                alert(
                    "Image must be smaller than 5 MB."
                );

                this.value = "";

                customPreview.innerHTML = "";

                return;

            }


            /*
             * Allowed types
             */

            const allowedTypes = [
                "image/jpeg",
                "image/png",
                "image/webp"
            ];


            if (!allowedTypes.includes(file.type)) {

                alert(
                    "Please upload a JPG, PNG or WEBP image."
                );

                this.value = "";

                customPreview.innerHTML = "";

                return;

            }


            /*
             * Avatar will be uploaded
             */

            avatarType.value =
                "upload";


            /*
             * Preview
             */

            const reader =
                new FileReader();


            reader.onload = function(event) {

                const imageURL =
                    event.target.result;


                customPreview.innerHTML =
                    '<img src="' +
                    imageURL +
                    '" alt="Custom avatar preview">';


                selectedPreview.innerHTML =
                    '<img src="' +
                    imageURL +
                    '" alt="Selected avatar">';

            };


            reader.readAsDataURL(file);

        });


        /* =========================
           STAT TRANSFER
        ========================= */

        function getTotalDecrease() {

            let total = 0;

            Object.values(stats).forEach(function(stat) {

                const current =
                    parseInt(stat.input.value);

                const difference =
                    stat.original - current;

                if (difference > 0) {

                    total += difference;

                }

            });

            return total;
        }


        function getTotalIncrease() {

            let total = 0;

            Object.values(stats).forEach(function(stat) {

                const current =
                    parseInt(stat.input.value);

                const difference =
                    current - stat.original;

                if (difference > 0) {

                    total += difference;

                }

            });

            return total;
        }


        function getTransferPoints() {

            const decrease =
                getTotalDecrease();

            const increase =
                getTotalIncrease();

            return decrease - increase;
        }


        /* =========================
           LEVEL POINTS
        ========================= */

        function getLevelPoints() {

            const currentLevel =
                parseInt(levelInput.value);

            const levelDifference =
                currentLevel - originalLevel;


            return Math.max(
                0,
                levelDifference * POINTS_PER_LEVEL
            );
        }


        /* =========================
           AVAILABLE POINTS
        ========================= */

        function getAvailablePoints() {

            const levelPoints =
                getLevelPoints();

            const transferPoints =
                getTransferPoints();


            return levelPoints + transferPoints;
        }


        /* =========================
           UPDATE UI
        ========================= */

        function updateUI() {

            const available =
                getAvailablePoints();


            availablePoints.textContent =
                Math.max(0, available);


            /* =========================
               STAT MINUS BUTTONS
            ========================= */

            document
                .querySelectorAll(".stat-minus")
                .forEach(function(button) {

                    const statName =
                        button.dataset.stat;

                    const stat =
                        stats[statName];

                    const current =
                        parseInt(stat.input.value);

                    if (current <= 0) {

                        button.disabled = true;

                        return;

                    }


                    const decrease =
                        stat.original - current;

                    const maxTransfer =
                        (statName === "health" || statName === "mana") ?
                        MAX_HEALTH_MAGIC_TRANSFER :
                        MAX_TRANSFER;

                    if (decrease >= maxTransfer) {

                        button.disabled = true;

                        return;

                    }


                    button.disabled = false;

                });


            /* =========================
               STAT PLUS BUTTONS
            ========================= */

            document
                .querySelectorAll(".stat-plus")
                .forEach(function(button) {

                    const statName =
                        button.dataset.stat;

                    const stat =
                        stats[statName];

                    const current =
                        parseInt(stat.input.value);


                    const maxValue =
                        (statName === "health" || statName === "mana") ?
                        1000 :
                        100;

                    if (available <= 0 || current >= maxValue) {

                        button.disabled = true;

                        return;
                    }



                    button.disabled = false;

                });


            /* =========================
               LEVEL BUTTONS
            ========================= */

            const currentLevel =
                parseInt(levelInput.value);

            if (currentLevel <= originalLevel) {

                levelMinus.disabled = true;

            } else {

                levelMinus.disabled = false;

            }

            if (currentLevel >= MAX_LEVEL) {

                levelPlus.disabled = true;

            } else {

                levelPlus.disabled = false;

            }

        }


        /* =========================
        STAT MINUS
        ========================= */

        document
            .querySelectorAll(".stat-minus")
            .forEach(function(button) {

                let interval;

                function decreaseStat() {

                    const statName =
                        button.dataset.stat;

                    const stat =
                        stats[statName];

                    const current =
                        parseInt(stat.input.value);

                    if (current <= 0) {
                        return;
                    }


                    const decrease =
                        stat.original - current;


                    const maxTransfer =
                        (statName === "health" || statName === "mana") ?
                        MAX_HEALTH_MAGIC_TRANSFER :
                        MAX_TRANSFER;


                    if (decrease >= maxTransfer) {
                        return;
                    }


                    stat.input.value =
                        current - 1;


                    updateUI();

                }


                // Single click
                button.addEventListener("click", function() {
                    if (event.button !== 0) {
                        return;
                    }
                    decreaseStat();
                });


                // Start holding the button
                button.addEventListener("mousedown", function() {

                    if (event.button !== 0) {
                        return;
                    }

                    // Wait briefly before starting
                    interval = setTimeout(function() {

                        // Decrease continuously while holding
                        interval = setInterval(function() {
                            decreaseStat();
                        }, 100);

                    }, 300);

                });


                // Stop when mouse button is released
                button.addEventListener("mouseup", function() {

                    clearTimeout(interval);
                    clearInterval(interval);

                });


                // Stop when mouse leaves the button
                button.addEventListener("mouseleave", function() {

                    clearTimeout(interval);
                    clearInterval(interval);

                });

            });



        /* =========================
        STAT PLUS
        ========================= */

        document
            .querySelectorAll(".stat-plus")
            .forEach(function(button) {

                let interval;

                function increaseStat() {

                    const available =
                        getAvailablePoints();

                    if (available <= 0) {
                        return;
                    }

                    const statName =
                        button.dataset.stat;

                    const stat =
                        stats[statName];

                    const current =
                        parseInt(stat.input.value);

                    const maxValue =
                        (statName === "health" || statName === "mana") ?
                        1000 :
                        100;

                    if (current >= maxValue) {
                        return;
                    }

                    stat.input.value =
                        current + 1;

                    updateUI();
                }


                // Single click
                button.addEventListener("click", function() {
                    if (event.button !== 0) {
                        return;
                    }
                    increaseStat();
                });


                // Start holding the button
                button.addEventListener("mousedown", function() {

                    if (event.button !== 0) {
                        return;
                    }

                    // Wait briefly before starting
                    interval = setTimeout(function() {

                        // Increase continuously while holding
                        interval = setInterval(function() {
                            increaseStat();
                        }, 100);

                    }, 300);

                });


                // Stop when the mouse button is released
                button.addEventListener("mouseup", function() {

                    clearTimeout(interval);
                    clearInterval(interval);

                });


                // Stop when the mouse leaves the button
                button.addEventListener("mouseleave", function() {

                    clearTimeout(interval);
                    clearInterval(interval);

                });

            });



        /* =========================
           LEVEL PLUS
        ========================= */

        let levelPlusInterval;

        function increaseLevel() {

            const currentLevel =
                parseInt(levelInput.value);

            if (currentLevel >= MAX_LEVEL) {
                return;
            }

            levelInput.value =
                currentLevel + 1;

            updateUI();
        }


        // Single click
        levelPlus.addEventListener("click", function() {
            if (event.button !== 0) {
                return;
            }

            increaseLevel();
        });


        // Start holding
        levelPlus.addEventListener("mousedown", function() {

            if (event.button !== 0) {
                return;
            }


            levelPlusInterval = setTimeout(function() {

                levelPlusInterval = setInterval(function() {
                    increaseLevel();
                }, 100);

            }, 300);

        });


        // Stop holding
        levelPlus.addEventListener("mouseup", function() {

            clearTimeout(levelPlusInterval);
            clearInterval(levelPlusInterval);

        });


        // Stop if mouse leaves button
        levelPlus.addEventListener("mouseleave", function() {

            clearTimeout(levelPlusInterval);
            clearInterval(levelPlusInterval);

        });


        /* =========================
           LEVEL MINUS
        ========================= */

        let levelMinusInterval;

        function decreaseLevel() {

            const currentLevel =
                parseInt(levelInput.value);

            if (currentLevel <= originalLevel) {
                return;
            }

            levelInput.value =
                currentLevel - 1;

            updateUI();
        }


        // Single click
        levelMinus.addEventListener("click", function() {

            if (event.button !== 0) {
                return;
            }

            decreaseLevel();
        });


        // Start holding
        levelMinus.addEventListener("mousedown", function() {

            if (event.button !== 0) {
                return;
            }

            levelMinusInterval = setTimeout(function() {

                levelMinusInterval = setInterval(function() {
                    decreaseLevel();
                }, 100);

            }, 300);

        });


        // Stop holding
        levelMinus.addEventListener("mouseup", function() {

            clearTimeout(levelMinusInterval);
            clearInterval(levelMinusInterval);

        });


        // Stop if mouse leaves button
        levelMinus.addEventListener("mouseleave", function() {

            clearTimeout(levelMinusInterval);
            clearInterval(levelMinusInterval);

        });


        /* =========================
           SAVE CHECK
        ========================= */

        const form =
            document.getElementById("edit-character-form");


        form.addEventListener("submit", function(event) {

            const available =
                getAvailablePoints();

            if (available > 0) {

                event.preventDefault();

                alert(
                    "You still have " +
                    available +
                    " unused ability points. " +
                    "Please use them before saving."
                );

                return;
            }

            const currentLevel =
                parseInt(levelInput.value);


            if (currentLevel < originalLevel) {

                event.preventDefault();

                alert(
                    "Character level cannot be decreased."
                );

                return;

            }

            if (currentLevel > MAX_LEVEL) {

                event.preventDefault();

                alert(
                    "Character level cannot be higher than 10."
                );

                return;

            }

        });


        /* =========================
           INITIAL UPDATE
        ========================= */

        updateUI();

    });
</script>