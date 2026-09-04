<main class="campaign-form-page">

    <section class="campaign-form-card">

        <div class="campaign-form-heading">
            <p class="eyebrow">Edit Item</p>

            <h1>Edit item
            </h1>

            <p>
                Update your item to whatever you want. Changes get applied immediately
            </p>
        </div>


        <form class="campaign-form" method="POST" action="">

            <div class="form-group">
                <label for="item-name">Item name</label>

                <input
                    type="text"
                    id="item-name"
                    name="name"
                    value="<?=$iteminfo["Esine"]?>"
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
                ><?= $iteminfo["Kuvaus"] ?></textarea>
            </div>

            <div class="form-group">
                <label for="item-amount">Item amount</label>

                <input
                    type="number"
                    id="item-amount"
                    name="amount"
                    value="<?=$iteminfo["Maara"]?>"
                    placeholder="Enter item amount..."
                    min=1
                    required
                >
            </div>


            <div class="campaign-form-actions">

                <a
                    href="/view-items?id=<?=$cid?>"
                    class="button button-secondary"
                >
                    Cancel
                </a>

                <button
                    type="submit"
                    class="button button-primary"
                >
                    Update Item
                </button>

            </div>

        </form>

    </section>

</main>