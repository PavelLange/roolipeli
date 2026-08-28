I’ll map the smallest path involved: the campaign view markup, the router/controller handling campaign actions, and the data functions for characters and campaign membership. Then I’ll turn that into a step-by-step Markdown learning guide without changing your files.

Read 

Read 

Read 

Read 

Read , lines 90 to 122

# Add Character to Campaign: Step-by-Step Guide

No files were changed. Based on your current structure, the important parts are:

- View: `view_campaign.php`
- Controller: `campaignController.php`
- Router: `index.php`
- Campaign model: `campaigns.php`
- Character model: `character.php`

## 1. Understand the Current Flow

Currently, the page works like this:

```text
GET /view-campaign?id=5
        |
        v
index.php
        |
        v
viewCampaignController()
        |
        v
getAllCampaigns($id)
getAllOwnCharacters($username)
        |
        v
view_campaign.php
```

The Add button currently does nothing because it has no:

- character ID
- campaign ID
- JavaScript event listener
- form submission
- backend route
- controller action

Start by making the button identify which character it belongs to.

## 2. Add IDs to the HTML

In `view_campaign.php`, inspect the loop:

```php
<?php foreach ($availableCharacters as $character): ?>
```

The database result contains the character ID in:

```php
$character['ID']
```

The campaign ID is available from:

```php
$_GET['id']
```

Add these as HTML data attributes:

```php
<article
    class="available-character-card"
    data-character-id="<?= htmlspecialchars($character['ID']) ?>"
>
```

Then update the button:

```php
<button
    type="button"
    class="button button-primary add-character-button"
    data-character-id="<?= htmlspecialchars($character['ID']) ?>"
    data-campaign-id="<?= htmlspecialchars($campaign['ID']) ?>"
>
    Add
</button>
```

Now JavaScript can read:

```javascript
button.dataset.characterId
button.dataset.campaignId
```

## 3. Add a JavaScript File

Create:

```text
public/campaign.js
```

Start with a simple test:

```javascript
const buttons = document.querySelectorAll(".add-character-button");

buttons.forEach((button) => {
    button.addEventListener("click", () => {
        console.log("Character ID:", button.dataset.characterId);
        console.log("Campaign ID:", button.dataset.campaignId);
    });
});
```

Load it at the bottom of `view_campaign.php`:

```php
<script src="/campaign.js"></script>
```

Open the browser developer console and click an Add button.

You should see something like:

```text
Character ID: 12
Campaign ID: 5
```

Do not continue until this works.

## 4. Decide How Characters Belong to Campaigns

Your current `Kampanjat` table has a `Pelaajat` column. That appears to store campaign users, not character IDs.

Your current function:

```php
function addUserToCampaign($uname, $id)
```

is therefore not the correct function for adding a character.

The clean database design is a separate relationship table:

```text
Kampanjahahmot
----------------
ID
KampanjaID
HahmoID
```

This allows:

```text
Campaign 1 -> Character 4
Campaign 1 -> Character 7
Campaign 2 -> Character 4
```

the Query we used:
```
CREATE TABLE Kampanjahahmot (
    ID INT NOT NULL AUTO_INCREMENT,
    KampanjaID INT NOT NULL,
    HahmoID INT NOT NULL,

    PRIMARY KEY (ID),

    CONSTRAINT fk_kampanjahahmot_kampanja
        FOREIGN KEY (KampanjaID)
        REFERENCES Kampanjat(ID)
        ON DELETE CASCADE
        ON UPDATE CASCADE,

    CONSTRAINT fk_kampanjahahmot_hahmo
        FOREIGN KEY (HahmoID)
        REFERENCES Hahmo(ID)
        ON DELETE CASCADE
        ON UPDATE CASCADE,

    CONSTRAINT uq_kampanja_hahmo
        UNIQUE (KampanjaID, HahmoID)
) ENGINE=InnoDB;
```

A character can then participate in multiple campaigns without corrupting the campaign row.

## 5. Add a Model Function

Add a function to `campaigns.php`:

```php
function addCharacterToCampaign($campaignId, $characterId) {
    $pdo = connectDB();

    $sql = "
        INSERT INTO Kampanjahahmot (KampanjaID, HahmoID)
        VALUES (?, ?)
    ";

    $statement = $pdo->prepare($sql);

    return $statement->execute([
        $campaignId,
        $characterId
    ]);
}
```

You will also eventually need a function that loads characters already in a campaign:

```php
function getCampaignCharacters($campaignId) {
    $pdo = connectDB();

    $sql = "
        SELECT Hahmo.*
        FROM Hahmo
        INNER JOIN Kampanjahahmot
            ON Hahmo.ID = Kampanjahahmot.HahmoID
        WHERE Kampanjahahmot.KampanjaID = ?
    ";

    $statement = $pdo->prepare($sql);
    $statement->execute([$campaignId]);

    return $statement->fetchAll(PDO::FETCH_ASSOC);
}
```

## 6. Add a Controller Action

In `campaignController.php`, create a controller function:

```php
function addCharacterToCampaignController() {
    if (
        !isset($_POST['campaign_id'], $_POST['character_id'])
    ) {
        http_response_code(400);
        echo json_encode([
            "error" => "Campaign ID and character ID are required"
        ]);
        exit;
    }

    $campaignId = cleanUpInput($_POST['campaign_id']);
    $characterId = cleanUpInput($_POST['character_id']);

    addCharacterToCampaign($campaignId, $characterId);

    header("Content-Type: application/json");

    echo json_encode([
        "success" => true
    ]);
}
```

The controller receives data from JavaScript, calls the model, and returns JSON.

## 7. Add a POST Route

In `index.php`, add a route:

```php
case '/add-character-to-campaign':
    if (isLoggedIn() && $method === 'post') {
        addCharacterToCampaignController();
    } else {
        http_response_code(403);
        echo "Not allowed";
    }
    break;
```

This is important because your current `/view-campaign` route only handles GET requests. A POST request to that route currently does not add a character.

## 8. Send the Request with `fetch`

Replace the console test in `public/campaign.js`:

```javascript
const buttons = document.querySelectorAll(".add-character-button");

buttons.forEach((button) => {
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
            console.log("Character added");
        }
    });
});
```

Test this in the browser Network tab. Check that:

- The request uses `POST`
- The URL is correct
- `campaign_id` is sent
- `character_id` is sent
- The response contains `"success": true`

## 9. Add the Character to the Page Immediately

First, give the existing lists IDs:

```html
<div class="campaign-character-list" id="campaign-character-list">
```

```html
<div class="character-list" id="character-list">
```

Then create a JavaScript function:

```javascript
function addCharacterToPage(character) {
    const campaignList = document.querySelector("#campaign-character-list");
    const characterList = document.querySelector("#character-list");

    const removeCard = document.createElement("article");

    removeCard.className = "campaign-character-card";

    removeCard.innerHTML = `
        <div>
            <h3>${character.name}</h3>
            <p>${character.race} · ${character.className}</p>
        </div>
        <button type="button" class="button button-secondary">
            Remove
        </button>
    `;

    campaignList.appendChild(removeCard);

    const characterCard = document.createElement("article");

    characterCard.className = "character-display-card";

    characterCard.innerHTML = `
        <h3>${character.name}</h3>
        <p>${character.race} · ${character.className}</p>
        <div class="character-stats">
            <span>HP: ${character.hp}</span>
            <span>Mana: ${character.mana}</span>
        </div>
    `;

    characterList.appendChild(characterCard);
}
```

At this stage, use test data manually:

```javascript
addCharacterToPage({
    name: "Drakona",
    race: "Human",
    className: "Mage",
    hp: 65,
    mana: 35
});
```

This lets you verify the DOM logic before connecting it to PHP.

## 10. Return Character Data from PHP

The controller should return the added character:

```php
$character = getAllCharacterInfo($characterId);

echo json_encode([
    "success" => true,
    "character" => [
        "id" => $character["ID"],
        "name" => $character["Nimi"],
        "race" => $character["Rotu"],
        "className" => $character["Hahmoluokka"],
        "hp" => $character["Elamapisteet"],
        "mana" => $character["Magiapisteet"]
    ]
]);
```

Then JavaScript can use the response:

```javascript
if (result.success) {
    addCharacterToPage(result.character);
    button.disabled = true;
    button.textContent = "Added";
}
```

## 11. Load Existing Characters When the Page Opens

Adding a character visually is not enough. After refreshing the page, the character must still appear.

In `viewCampaignController()`:

```php
$campaignCharacters = getCampaignCharacters($id);
```

Then pass it to the view:

```php
require "../views/view_campaign.php";
```

The view can render existing characters:

```php
<?php foreach ($campaignCharacters as $character): ?>
    <article class="character-display-card">
        <h3><?= htmlspecialchars($character["Nimi"]) ?></h3>
        <p>
            <?= htmlspecialchars($character["Rotu"]) ?>
            ·
            <?= htmlspecialchars($character["Hahmoluokka"]) ?>
        </p>
    </article>
<?php endforeach; ?>
```

## Recommended Learning Order

Complete these in order:

1. Add `data-character-id` and `data-campaign-id`.
2. Log both IDs with JavaScript.
3. Create the database relationship table.
4. Write the model insert function.
5. Add the controller action.
6. Add the POST route.
7. Send the `fetch()` request.
8. Confirm the database row is created.
9. Add the returned character to the page with JavaScript.
10. Load saved campaign characters when refreshing the page.
11. Add Remove functionality afterward.

The key idea is:

```text
Button click
    -> JavaScript reads IDs
    -> fetch sends IDs to PHP
    -> router selects POST route
    -> controller validates request
    -> model writes database row
    -> PHP returns JSON
    -> JavaScript updates both character lists
```

Your current placeholder cards should eventually be removed and replaced with cards generated from real database data.