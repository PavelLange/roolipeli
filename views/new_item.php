<main class="campaign-form-page">

    <section class="campaign-form-card">

        <div class="campaign-form-heading">
            <p class="eyebrow">New Item</p>

            <h1>Create a new item
            </h1>

            <p>
                Create a new item that can be anything you want.
                Items can be viewed in the campaign.
            </p>
        </div>


        <form class="campaign-form" method="POST" action="">

            <div class="form-group">
                <label for="item-name">Item name</label>

                <input
                    type="text"
                    id="item-name"
                    name="name"
                    placeholder="Enter item name..."
                    required
                >
            </div>


            <div class="form-group">
                <label for="item-desc">Item description</label>

                <textarea
                    id="item-desc"
                    name="desc"
                    rows="8"
                    placeholder="Write a description or notes about your item..."
                ></textarea>
            </div>

            <div class="form-group">
                <label for="item-amount">Item amount</label>

                <input
                    type="number"
                    id="item-amount"
                    name="amount"
                    placeholder="Enter item amount..."
                    min=1
                    required
                >
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