<main class="campaign-form-page">

    <section class="campaign-form-card">

        <div class="campaign-form-heading">
            <p class="eyebrow">New Adventure</p>

            <h1>Create Campaign</h1>

            <p>
                Create a new campaign and begin your adventure.
                You can add players and manage the campaign later.
            </p>
        </div>


        <form class="campaign-form" method="POST" action="" enctype="multipart/form-data">

            <div class="form-group">
                <label for="campaign-name">Campaign name</label>

                <input
                    type="text"
                    id="campaign-name"
                    name="name"
                    maxlength="60"
                    placeholder="Enter campaign name"
                    required
                >
            </div>


            <div class="form-group">
                <label for="campaign-notes">Campaign notes</label>

                <textarea
                    id="campaign-notes"
                    name="notes"
                    maxlength="1000"
                    rows="8"
                    placeholder="Write a description or notes about your campaign..."
                ></textarea>
            </div>

            <div class="form-group">
                <label>Campaign picture</label>

                <div class="image-choices">
                    <?php foreach (campaignDefaultImages() as $index => $image): ?>
                        <label class="image-choice">
                            <input
                                type="radio"
                                name="default_image"
                                value="<?= htmlspecialchars($image) ?>"
                                <?= $index === 0 ? "checked" : "" ?>
                            >
                            <img src="<?= htmlspecialchars($image) ?>" alt="">
                        </label>
                    <?php endforeach ?>
                </div>

                <input
                    type="file"
                    id="campaign-image"
                    name="image"
                    accept="image/jpeg,image/png,image/webp"
                    hidden
                >

                <label for="campaign-image" class="button button-secondary image-upload-button">
                    Or upload your own
                </label>

                <img id="image-preview" class="image-preview" alt="" hidden>
            </div>

            <div class="campaign-form-actions">

                <a
                    href="/campaigns"
                    class="button button-secondary"
                >
                    Cancel
                </a>

                <button
                    type="submit"
                    class="button button-primary"
                >
                    Create Campaign
                </button>

            </div>

        </form>

    </section>

</main>

<script src="/js/campaign-image.js"></script>