<main class="campaign-form-page">

    <section class="campaign-form-card">

        <div class="campaign-form-heading">
            <p class="eyebrow">Manage Adventure</p>

            <h1>Edit Campaign</h1>

            <p> Update your campaign details and save your changes. </p>

        </div>


        <form class="campaign-form" method="POST" action="/edit-campaign" enctype="multipart/form-data">

        <input
        type="hidden"
        name="id"
        value="<?= htmlspecialchars($campaign["ID"]) ?>"
        >

            <div class="form-group">
                <label for="campaign-name">Campaign name</label>

                <input
                    type="text"
                    id="campaign-name"
                    name="name"
                    value="<?= htmlspecialchars($campaign["Nimi"] ?? "") ?>"
                    placeholder="Enter campaign name"
                    required    
                >
            </div>


            <div class="form-group">
                <label for="campaign-notes">Campaign notes</label>

                <textarea
                id="campaign-notes"
                name="notes"
                rows="8"
                placeholder="Write a description or notes about your campaign..."
                ><?= htmlspecialchars($campaign["Muistiinpanot"]) ?></textarea>
                
            </div>


            <div class="form-group">
                <label>Campaign picture</label>

                <div class="image-choices">
                    <label class="image-choice">
                        <input type="radio" name="default_image" value="" checked>
                        <img src="<?= htmlspecialchars($campaign["ReittiKuvaan"] ?: "/images/camp1.jpg") ?>" alt="">
                        <span class="image-choice-tag">Current</span>
                    </label>

                    <?php foreach (campaignDefaultImages() as $image): ?>
                        <label class="image-choice">
                            <input
                                type="radio"
                                name="default_image"
                                value="<?= htmlspecialchars($image) ?>"
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
                    Save Changes
                </button>

            </div>

        </form>

    </section>

</main>

<script src="/js/campaign-image.js"></script>
