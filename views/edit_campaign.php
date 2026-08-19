<main class="campaign-form-page">

    <section class="campaign-form-card">

        <div class="campaign-form-heading">
            <p class="eyebrow">Manage Adventure</p>

            <h1>Edit Campaign</h1>

            <p> Update your campaign details and save your changes. </p>

        </div>


        <form class="campaign-form" method="POST" action="/edit-campaign">

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
                    value="<?= htmlspecialchars($campaign["Muistiinpanot"]) ?>"></textarea>
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