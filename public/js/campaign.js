const addButtons = document.querySelectorAll(".add-character-button");
const removeButtons = document.querySelectorAll(".remove-character-button");
const inviteButton = document.querySelector("#invite-button");
const inviteInput = document.querySelector("#invite-input");
const inviteSuggestions = document.querySelector("#invite-suggestions");
const cancelInvitationButtons = document.querySelectorAll(".cancel-invitation-button");
const removePlayerButtons = document.querySelectorAll(".remove-player-button");

// Store selected player data
let selectedPlayer = { id: null, name: null };
let allPlayers = [];

// Initialize player list from data attribute
const inviteBox = document.querySelector(".invite-box-container");
if (inviteBox && inviteBox.dataset.players) {
    try {
        allPlayers = JSON.parse(inviteBox.dataset.players);
    } catch (e) {
        console.error("Error parsing players data:", e);
    }
}

// Input autocomplete functionality
if (inviteInput) {
    inviteInput.addEventListener("input", (e) => {
        const searchTerm = e.target.value.toLowerCase().trim();
        
        if (!searchTerm) {
            inviteSuggestions.style.display = "none";
            selectedPlayer = { id: null, name: null };
            return;
        }

        // Filter players
        const matches = allPlayers.filter(player => 
            player.Kayttajanimi.toLowerCase().includes(searchTerm)
        );

        if (matches.length === 0) {
            inviteSuggestions.innerHTML = '<div class="invite-suggestion" style="color: var(--text-muted);">No players found</div>';
            inviteSuggestions.style.display = "block";
            return;
        }

        // Display suggestions
        inviteSuggestions.innerHTML = matches.map(player => `
            <div class="invite-suggestion" data-player-id="${player.ID}" data-player-name="${player.Kayttajanimi}">
                ${player.Kayttajanimi}
            </div>
        `).join('');

        inviteSuggestions.style.display = "block";

        // Add click handlers to suggestions
        document.querySelectorAll(".invite-suggestion").forEach(suggestion => {
            suggestion.addEventListener("click", () => {
                const playerId = suggestion.dataset.playerId;
                const playerName = suggestion.dataset.playerName;
                
                selectedPlayer = { id: playerId, name: playerName };
                inviteInput.value = playerName;
                inviteSuggestions.style.display = "none";
            });
        });
    });

    // Hide suggestions when clicking outside
    document.addEventListener("click", (e) => {
        if (!inviteBox.contains(e.target)) {
            inviteSuggestions.style.display = "none";
        }
    });
}

// Character management event listeners
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

// Invite player functionality
if (inviteButton) {
    inviteButton.addEventListener("click", async () => {
        const messageElement = document.querySelector("#invite-message");
        const inviteBox = document.querySelector(".invite-box");
        const campaignId = inviteBox?.dataset.campaignId;

        if (!selectedPlayer.id) {
            messageElement.textContent = "Please select a player to invite";
            messageElement.style.color = "red";
            messageElement.style.display = "block";
            return;
        }

        if (!campaignId) {
            messageElement.textContent = "Campaign ID not found";
            messageElement.style.color = "red";
            messageElement.style.display = "block";
            return;
        }
        
        const formData = new FormData();
        formData.append("player_id", selectedPlayer.id);
        formData.append("campaign_id", campaignId);

        try {
            const response = await fetch("/send-invitation", {
                method: "POST",
                body: formData
            });

            const result = await response.json();

            if (result.success) {
                messageElement.textContent = "Invitation sent!";
                messageElement.style.color = "green";
                messageElement.style.display = "block";
                
                // Add the invitation to pending list immediately
                addPendingInvitationCard(selectedPlayer.name);
                
                // Store the ID before resetting
                const invitedPlayerId = selectedPlayer.id;
                
                // Clear input and reset
                inviteInput.value = "";
                selectedPlayer = { id: null, name: null };
                
                // Remove player from list
                const playerIndex = allPlayers.findIndex(p => p.ID == invitedPlayerId);
                if (playerIndex > -1) {
                    allPlayers.splice(playerIndex, 1);
                }
                
                // Hide message after 3 seconds
                setTimeout(() => {
                    messageElement.style.display = "none";
                }, 3000);
            } else {
                messageElement.textContent = result.error || "Failed to send invitation";
                messageElement.style.color = "red";
                messageElement.style.display = "block";
            }
        } catch (error) {
            messageElement.textContent = "Error sending invitation";
            messageElement.style.color = "red";
            messageElement.style.display = "block";
            console.error("Error:", error);
        }
    });
}

// Helper function to add a pending invitation card
function addPendingInvitationCard(playerName) {
    const pendingList = document.querySelector(".player-column .player-list");
    if (!pendingList) return;

    // Check if empty state exists and remove it
    const emptyState = pendingList.querySelector(".empty-state");
    if (emptyState) {
        emptyState.remove();
    }

    const card = document.createElement("article");
    card.className = "player-card pending";
    card.innerHTML = `
        <div>
            <h3>${playerName}</h3>
            <p class="status">⏳ Pending</p>
        </div>
        <button 
            type="button" 
            class="button button-secondary cancel-invitation-button"
            data-invitation-id="pending-new"
        >
            Cancel
        </button>
    `;

    pendingList.appendChild(card);
}

// Cancel invitation functionality
cancelInvitationButtons.forEach((button) => {
    button.addEventListener("click", async () => {
        const invitationId = button.dataset.invitationId;
        
        if (!confirm("Are you sure you want to cancel this invitation?")) {
            return;
        }

        const formData = new FormData();
        formData.append("invitation_id", invitationId);

        try {
            const response = await fetch("/cancel-invitation", {
                method: "POST",
                body: formData
            });

            const result = await response.json();

            if (result.success) {
                // Remove the card from the DOM
                button.closest(".player-card").remove();
            } else {
                alert(result.error || "Failed to cancel invitation");
            }
        } catch (error) {
            alert("Error canceling invitation");
            console.error("Error:", error);
        }
    });
});

// Remove player functionality
removePlayerButtons.forEach((button) => {
    button.addEventListener("click", async () => {
        const playerName = button.dataset.playerName;
        const campaignId = button.dataset.campaignId;
        
        if (!confirm(`Are you sure you want to remove ${playerName} from the campaign?`)) {
            return;
        }

        const formData = new FormData();
        formData.append("player_name", playerName);
        formData.append("campaign_id", campaignId);

        try {
            const response = await fetch("/remove-player-from-campaign", {
                method: "POST",
                body: formData
            });

            const result = await response.json();

            if (result.success) {
                // Remove the card from the DOM
                button.closest(".player-card").remove();
            } else {
                alert(result.error || "Failed to remove player");
            }
        } catch (error) {
            alert("Error removing player");
            console.error("Error:", error);
        }
    });
});