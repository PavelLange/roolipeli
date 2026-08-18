<main class="my-campaign-page">

    <section class="my-campaign-heading">
        <p class="eyebrow">Your Adventures</p>

        <h1>My Campaigns</h1>

        <p>
            View and manage the campaigns you have created or joined.
        </p>
    </section>


    <section class="my-campaigns">

        <!-- here is an example campaign card, should get other ones fron database -->

        <article class="my-campaign-card">

            <div class="my-campaign-image">
                <img
                    src="/images/camp1.jpg"
                    alt="Campaign"
                >
            </div>

            <div class="my-campaign-content">

                <p class="campaign-status">
                    Game Master
                </p>

                <h2>The Forgotten Kingdom</h2>

                <p>
                    an example campaign. this one will later
                    come from the database we need to connect it
                </p>

                <div class="my-campaign-actions">

                    <a
                        href="/campaign"
                        class="button button-primary"
                    >
                        Open Campaign
                    </a>

                    <a
                        href="/edit-campaign"
                        class="button button-secondary"
                    >
                        Edit
                    </a>

                </div>

            </div>

        </article>


        <!-- If empty  -->

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

    </section>

</main>