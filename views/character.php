<main class="campaign-page">

    <h1>Characters</h1>
    <p>Manage your characters.</p>

    <div class="campaign-grid">
    <?php if(isLoggedIn()):?>
        <a href="/new-character" class="campaign-card">
    <?php else: ?>
        <a href="/login" class="campaign-card">
    <?php endif?>
            <img src="/images/Image.jpg" alt="Create a new character">

            <div class="campaign-card-content">
                <h2>Create Character</h2>
                <p>Build Your Character Your Way.</p>
            </div>
        </a>
        <?php if(isLoggedIn()):?>
        <a href="/edit-character" class="campaign-card">
        <?php else: ?>
        <a href="/login" class="campaign-card">
        <?php endif?>
            <img src="/images/Image2.jpg" alt="Edit Character">

            <div class="campaign-card-content">
                <h2>Edit Character</h2>
                <p>Make Changes To Your Character.</p>
            </div>
        </a>

    </div>

</main>