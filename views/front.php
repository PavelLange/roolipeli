<? require "../libaries/auth.php" ?> 
<main class="home-page">
    <?php if(!isLoggedIn()): ?>
    <section class="hero-section">

        <div class="hero-content">

            <p class="eyebrow">YOUR ADVENTURE BEGINS HERE</p>

            <h1>
                Create your world.<br>
                <span>Build your legend.</span>
            </h1>

            <p class="hero-description">
                Create campaigns, manage characters and keep track of
                everything that happens in your tabletop adventure.
            </p>

            <div class="hero-actions">
                <a href="/register" class="button button-primary">
                    Start Your Adventure
                </a>

                <a href="/login" class="button button-secondary">
                    Log In
                </a>
            </div>

        </div>

        <div class="hero-decoration" aria-hidden="true">
            <div class="dice-symbol">✦</div>
        </div>

    </section>


    <?php endif ?>
    <section class="features-section">

        <div class="section-heading">
            <p class="eyebrow">FOR YOUR PARTY</p>
            <h2>Everything you need for your campaign</h2>
            <p>
                Keep your campaign information and characters
                organized in one place.
            </p>
        </div>


        <div class="feature-grid">

            <article class="feature-card">
                <div class="feature-icon">⚔</div>

                <h3>Campaigns</h3>

                <p>
                    Create campaigns, invite players and keep
                    your adventures organized.
                </p>
            </article>


            <article class="feature-card">
                <div class="feature-icon">♜</div>

                <h3>Characters</h3>

                <p>
                    Create your character and keep their
                    stats and progression up to date.
                </p>
            </article>


            <article class="feature-card">
                <div class="feature-icon">✎</div>

                <h3>Campaign Notes</h3>

                <p>
                    Keep important information, events and
                    ideas available to the game master.
                </p>
            </article>

        </div>

    </section>

    <?php if(!isLoggedIn()): ?>
    <section class="cta-section">

        <div>
            <p class="eyebrow">READY?</p>

            <h2>Your next adventure starts here.</h2>

            <p>
                Create an account and start building your campaign.
            </p>
        </div>

        <a href="/register" class="button button-primary">
            Create Account
        </a>

    </section>
    <?php endif ?>
</main>