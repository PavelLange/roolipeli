<?php require_once "../controllers/campaignController.php";?>
<main class="campaign-form-page">

    <section class="campaign-form-card">

        <div class="campaign-form-heading">
            <p class="eyebrow">Edit NPC</p>

            <h1>Edit NPC
            </h1>

            <p>
                Create a new NPC that can be a hostile, neutral or a merchant.
                NPC can be viewed in the campaign.
            </p>
        </div>


        <form class="campaign-form" method="POST" action="">

            <div class="form-group">
                <label for="NPC-name">NPC name</label>

                <input
                    type="text"
                    id="NPC-name"
                    name="name"
                    placeholder="Enter NPC name..."
                    required
                    value=<?=$npcinfo["Nimi"]?>
                >
            </div>


            <div class="form-group">
                <label for="NPC-desc">NPC description</label>

                <textarea
                    id="NPC-desc"
                    name="desc"
                    rows="8"
                    placeholder="Write a description or notes about your NPC..."
                ><?=$npcinfo["Muistiinpanot"]?></textarea>
            </div>

            <div class="form-group">
                <label for="NPC-level">NPC Level</label>

                <input
                    type="number"
                    id="NPC-level"
                    name="level"
                    placeholder="Enter level amount..."
                    min=1
                    max=100
                    value=<?=$npcinfo["LVL"]?>
                ><p>Optional!</p>
            </div>

            <div class="form-group">
                <label for="NPC-level">NPC MAX Health</label>

                <input
                    type="number"
                    id="NPC-health"
                    name="health"
                    placeholder="Enter health amount..."
                    min=1
                    value=<?=$npcinfo["HPMAX"]?>
                ><p>Optional!</p>
            </div>

            <div class="form-group">
                <label for="NPC-level">NPC MAX Mana</label>

                <input
                    type="number"
                    id="NPC-mana"
                    name="mana"
                    placeholder="Enter mana amount..."
                    min=1
                    value=<?=$npcinfo["MPMAX"]?>
                ><p>Optional!</p>
            </div>

            <div class="form-group">
                <label for="NPC-level">NPC Strength</label>

                <input
                    type="number"
                    id="NPC-str"
                    name="str"
                    placeholder="Enter strength amount..."
                    min=1
                    max=100
                    value=<?=$npcinfo["STR"]?>
                ><p>Optional!</p>
            </div>

            <div class="form-group">
                <label for="NPC-level">NPC Constitution</label>

                <input
                    type="number"
                    id="NPC-con"
                    name="const"
                    placeholder="Enter constitution amount..."
                    min=1
                    max=100
                    value=<?=$npcinfo["CONS"]?>
                ><p>Optional!</p>
            </div>

            <div class="form-group">
                <label for="NPC-level">NPC Agility</label>

                <input
                    type="number"
                    id="NPC-agi"
                    name="agility"
                    placeholder="Enter agility amount..."
                    min=1
                    max=100
                    value=<?=$npcinfo["AGI"]?>
                ><p>Optional!</p>
            </div>

            <div class="form-group">
                <label for="NPC-level">NPC Intelligence</label>

                <input
                    type="number"
                    id="NPC-int"
                    name="int"
                    placeholder="Enter intelligence amount..."
                    min=1
                    max=100
                    value=<?=$npcinfo["INTEL"]?>
                ><p>Optional!</p>
            </div>

            <div class="form-group">
                <label for="NPC-level">NPC Charisma</label>

                <input
                    type="number"
                    id="NPC-char"
                    name="char"
                    placeholder="Enter charisma amount..."
                    min=1
                    max=100
                    value=<?=$npcinfo["CHA"]?>
                ><p>Optional!</p>
            </div>

            <div class="form-group">
                <label for="type">NPC type </label>
                <select id="type" name="type">
                    <option <?php echo ($npcinfo["Type"] === "Hostile") ? 'selected' : '';?>>Hostile</option>
                    <option <?php echo ($npcinfo["Type"] === "Neutral") ? 'selected' : '';?>>Neutral</option>
                    <option <?php echo ($npcinfo["Type"] === "Friendly") ? 'selected' : '';?>>Friendly</option>
                    <option <?php echo ($npcinfo["Type"] === "Merchant") ? 'selected' : '';?>>Merchant</option>
                </select>
            </div> 


            <div class="campaign-form-actions">

                <a
                <?php $id = $_GET["id"]?>
                    href="/view-campaign?id=<?=$id?>"
                    class="button button-secondary"
                >
                    Cancel
                </a>

                <button
                    type="submit"
                    class="button button-primary"
                >
                    Create Item
                </button>

            </div>

        </form>

    </section>

</main>