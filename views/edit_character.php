<main class="container">
    <h1>Edit Character</h1>
</main>

<form action="/edit-character" method="post">

    <input type="hidden" name="id" value= "<?= htmlspecialchars($character["ID"]) ?>">

    <label for="cname">Character Name:</label>
    <input id="cname" type="text" name="name" value= "<?= htmlspecialchars($character["Nimi"]) ?>" required>

    <label for="class">Class:</label>
    <select id="class" name="class">
        <option value="fighter" <?= $character["Hahmoluokka"] === "fighter" ? "selected" : "" ?>>Fighter</option>
        <option value="villain" <?= $character["Hahmoluokka"] === "villain" ? "selected" : "" ?>>Villain</option>
        <option value="mage" <?= $character["Hahmoluokka"] === "mage" ? "selected" : "" ?>>Mage</option>
        <option value="paladin" <?= $character["Hahmoluokka"] === "paladin" ? "selected" : "" ?>>Paladin</option>
        <option value="bard" <?= $character["Hahmoluokka"] === "bard" ? "selected" : "" ?>>Bard</option>
        <option value="priest" <?= $character["Hahmoluokka"] === "priest" ? "selected" : "" ?>>Priest</option>
        <option value="ranger" <?= $character["Hahmoluokka"] === "ranger" ? "selected" : "" ?>>Ranger</option>
    </select>

    <label for="race">Race:</label>
    <select id="race" name="race">
        <option value="Human" <?= $character["Rotu"] === "Human" ? "selected" : "" ?>>Human</option>
        <option value="Elf" <?= $character["Rotu"] === "Elf" ? "selected" : "" ?>>Elf</option>
        <option value="Dwarf" <?= $character["Rotu"] === "Dwarf" ? "selected" : "" ?>>Dwarf</option>
        <option value="Orc" <?= $character["Rotu"] === "Orc" ? "selected" : "" ?>>Orc</option>
        <option value="Gnome" <?= $character["Rotu"] === "Gnome" ? "selected" : "" ?>>Gnome</option>
    </select>

    <label for="level">Level:</label>
    <input id="level" type="number" name="level" value="<?= htmlspecialchars($character["Taso"]) ?>" required>

    <label for="health">Health Points:</label>
    <input id="health" type="number" name="health" value="<?= htmlspecialchars($character["Elamapisteet"]) ?>" required>

    <label for="mana">Magic Points:</label>
    <input id="mana" type="number" name="mana" value="<?= htmlspecialchars($character["Magiapisteet"]) ?>" required>

    <label for="strength">Strength:</label>
    <input id="strength" type="number" name="strength" value="<?= htmlspecialchars($character["Voima"]) ?>" required>

    <label for="constitution">Constitution:</label>
    <input id="constitution" type="number" name="constitution" value="<?= htmlspecialchars($character["Kestavyys"]) ?>" required>

    <label for="agility">Agility:</label>
    <input id="agility" type="number" name="agility" value="<?= htmlspecialchars($character["Ketteryys"]) ?>" required>

    <label for="intelligence">Intelligence:</label>
    <input id="intelligence" type="number" name="intelligence" value="<?= htmlspecialchars($character["Alykkyys"]) ?>" required>

    <label for="charisma">Charisma:</label>
    <input id="charisma" type="number" name="charisma" value="<?= htmlspecialchars($character["Karisma"]) ?>" required>

    <label for="creator">Creator:</label>
    <input id="creator" type="text" name="creator" value="<?= htmlspecialchars($character["Tekija"]) ?>" required>

    <label for="campaign">Campaign:</label>
    <input id="campaign" type="text" name="campaign" value="<?= htmlspecialchars($character["Kampanja"]) ?>" required>

    <label for="notes">Notes:</label>
    <textarea 
    id="notes"
    name="notes"
    rows="6"
    ><?= htmlspecialchars($character["Muistiinpanot"]) ?></textarea>

    <input id="sendbutton" type="submit" value="Save Character">
</form>