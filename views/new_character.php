<?php require "../partials/header.php"; ?>

<main class="container">
    <h1>Create a Character</h1>
    <p>This is where character creation will eventually happen.</p>
</main>

<form action="/new_character" method="post">
    <label for="cname">Character Name:</label>
    <input id="cname" type="text" name="name" placeholder="Enter character name" required>

    <label for="class">Class:</label>
    <select id="class" name="class">
        <option value="Warrior">Warrior</option>
        <option value="Mage">Mage</option>
        <option value="Archer">Archer</option>
        <option value="Rogue">Rogue</option>
    </select>

    <label for="race">Race:</label>
    <select id="race" name="race">
        <option value="Human">Human</option>
        <option value="Elf">Elf</option>
        <option value="Dwarf">Dwarf</option>
        <option value="Orc">Orc</option>
    </select>

    <label for="level">Level:</label>
    <input id="level" type="number" name="level" value="1" min="1" required>

    <label for="health">Health Points:</label>
    <input id="health" type="number" name="health" value="100" min="0" required>

    <label for="mana">Magic Points:</label>
    <input id="mana" type="number" name="mana" value="50" min="0" required>

    <label for="strength">Strength:</label>
    <input id="strength" type="number" name="strength" value="10" min="0" required>

    <label for="agility">Agility:</label>
    <input id="agility" type="number" name="agility" value="10" min="0" required>

    <label for="intelligence">Intelligence:</label>
    <input id="intelligence" type="number" name="intelligence" value="10" min="0" required>

    <label for="charisma">Charisma:</label>
    <input id="charisma" type="number" name="charisma" value="10" min="0" required>

    <label for="creator">Creator:</label>
    <input id="creator" type="text" name="creator" placeholder="Enter creator name" required>

    <label for="campaign">Campaign:</label>
    <input id="campaign" type="text" name="campaign" placeholder="Enter campaign name" required>

    <label for="notes">Notes:</label>
    <textarea
    id="notes" name="description" rows="5" cols="40"
    placeholder="Enter character description...">
    </textarea>

    <input id="sendbutton" type="submit" value="Save Character">
</form>


<?php require "../partials/footer.php"; ?>