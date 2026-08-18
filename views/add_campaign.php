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


        <form class="campaign-form" method="POST" action="">

            <div class="form-group">
                <label for="campaign-name">Campaign name</label>

                <input
                    type="text"
                    id="campaign-name"
                    name="name"
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
                ></textarea>
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