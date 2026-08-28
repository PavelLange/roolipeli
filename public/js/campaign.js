const addButtons = document.querySelectorAll(".add-character-button");
const removeButtons = document.querySelectorAll(".remove-character-button");

addButtons.forEach((button) => {
    button.addEventListener("click", async () => {
        const characterId = button.dataset.characterId;
        const campaignId = button.dataset.campaignId;

        const formData = new FormData();

        formData.append("character_id", characterId);
        formData.append("campaign_id", campaignId);

        const response = await fetch("/add-character-to-campaign", {
            method: "POST",
            body: formData
        });

        const result = await response.json();

        if (result.success) {
            addCharacterToPage(result.character);
            button.disabled = true;
            button.textContent = "Added";
        }

    });
});

removeButtons.forEach((button) => {
    button.addEventListener("click", async () => {
        const characterId = button.dataset.characterId;
        const campaignId = button.dataset.campaignId;

        const formData = new FormData();

        formData.append("character_id", characterId);
        formData.append("campaign_id", campaignId);

        const response = await fetch("/remove-character-from-campaign", {
            method: "POST",
            body: formData
        });

        const result = await response.json();
        console.log(result);
        if (result.success) {
            removeCharacterFromPage(characterId);
        }   

    });
});

function addCharacterToPage(character) {
    const campaignList = document.querySelector("#campaign-character-list");
    const characterList = document.querySelector("#character-list");

    const removeCard = document.createElement("article");

    removeCard.className = "campaign-character-card";
    removeCard.dataset.characterId = character.id;

    removeCard.innerHTML = `
        <div>
            <h3>${character.name}</h3>
            <p>${character.race} · ${character.className}</p>
        </div>
        <button
            type="button"
            class="button button-secondary remove-character-button"
            data-character-id="${character.id}"
            data-campaign-id="${document.querySelector(".add-character-button")?.dataset.campaignId ?? ""}"
        >
            Remove
        </button>
    `;

    campaignList.appendChild(removeCard);

    const removeButton = removeCard.querySelector(".remove-character-button");
    removeButton.addEventListener("click", removeCharacterFromCampaign);

    const characterCard = document.createElement("article");

    characterCard.className = "character-display-card";
    characterCard.dataset.characterId = character.id;

    characterCard.innerHTML = `
        <h3>${character.name}</h3>
        <p>${character.race} · ${character.className}</p>
        <div class="character-stats">
            <span>HP: ${character.hp}</span>
            <span>Mana: ${character.mana}</span>
            <span>Status: ${character.status}</span>
        </div>
    `;

    characterList.appendChild(characterCard);
}

async function removeCharacterFromCampaign(event) {
    const button = event.currentTarget;
    const characterId = button.dataset.characterId;
    const campaignId = button.dataset.campaignId;

    const formData = new FormData();
    formData.append("character_id", characterId);
    formData.append("campaign_id", campaignId);

    const response = await fetch("/remove-character-from-campaign", {
        method: "POST",
        body: formData
    });

    const result = await response.json();

    if (result.success) {
        removeCharacterFromPage(characterId);
    }
}

function removeCharacterFromPage(characterId) {
    const campaignList = document.querySelector("#campaign-character-list");
    const characterList = document.querySelector("#character-list");

    const removeCard = campaignList.querySelector(`.campaign-character-card[data-character-id="${characterId}"]`);
    if (removeCard) {
        campaignList.removeChild(removeCard);
    }

    const characterCard = characterList.querySelector(`.character-display-card[data-character-id="${characterId}"]`);
    if (characterCard) {
        characterList.removeChild(characterCard);
    }

    // Re-enable the "Add" button for the removed character
    const addButton = document.querySelector(`.add-character-button[data-character-id="${characterId}"]`);
    if (addButton) {
        addButton.disabled = false;
        addButton.textContent = "Add";
    }
}