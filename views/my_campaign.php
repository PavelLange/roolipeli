<?php require_once "../libraries/auth.php"?>

<main class="my-campaign-page">

    <section class="my-campaign-heading">
        <p class="eyebrow">Your Adventures</p>

        <h1>My Campaigns</h1>

        <p>
            View and manage the campaigns you have created or joined.
        </p>
    </section>


    <section class="my-campaigns">
        <?php if(empty($allowned) && empty($alljoined)):?>
            <div class="campaign-empty">

            <div class="campaign-empty-icon">
                +
            </div>

            <h2>Create your first campaign</h2>

            <p>
                You don't have any campaigns yet.
                Start a new adventure and invite your players.
            </p>

            <a
                href="/new-campaign"
                class="button button-primary"
            >
                Create Campaign
            </a>

        </div> 
        <?php else:?>
        <?php foreach ($allowned as $owned): 
        ?>
        <article class="my-campaign-card">

            <div class="my-campaign-image">
                <img
                    src="/images/camp1.jpg"
                    alt="Campaign"
                >
            </div>

            <div class="my-campaign-content">

                <p class="campaign-status">
                    <?= $owned["Pelinjohtaja"] ?>
                </p>
                <br>
                <p> 
                    <?= $owned["Pelaajat"] ?>
                </p>
                <br>
                <h2>
                    <?= $owned["Nimi"]?>
                </h2>
                <br>
                <p>
                <?= htmlspecialchars(substr($owned["Muistiinpanot"], 0, 200))  ?>
                    . . .
                </p>

                <div class="my-campaign-actions">

                    <a
                        <?php $id = $owned["ID"] ?>
                        href="/view-campaign?id=<?=$id?>"
                        class="button button-primary"
                    >
                        Open Campaign
                    </a>
                    <?php $id = $owned["ID"] ?>
                    <a
                        href="/edit-campaign?id=<?=$id?>"
                        class="button button-secondary"
                    >
                        Edit
                    </a>
                    <?php  ?>
                </div>

            </div>

        </article>
        <?php endforeach?>

        <?php foreach ($alljoined as $joined): 
        ?>
        <article class="my-campaign-card">

            <div class="my-campaign-image">
                <img
                    src="/images/camp1.jpg"
                    alt="Campaign"
                >
            </div>

            <div class="my-campaign-content">

                <p class="campaign-status">
                    <?= $joined["Pelinjohtaja"] ?>
                </p>
                <br>
                <p> 
                    <?= $joined["Pelaajat"] ?>
                </p>
                <br>
                <h2>
                    <?=  $joined["Nimi"]?>
                </h2>
                <br>
                <p>
                    <?= htmlspecialchars(substr($joined["Muistiinpanot"], 0, 200))  ?>
                    . . .
                </p>

                <div class="my-campaign-actions">

                    <a
                    <?php $id = $joined["ID"]?>
                        href="/view-campaign?id=<?=$id?>"
                        class="button button-primary"
                    >
                        Open Campaign
                    </a>

                </div>

            </div>
        </article>
        <?php endforeach?>



    </section>
<?php endif ?>
</main>