<footer class="site-footer">

    <div class="footer-inner">

        <div class="footer-brand">

            <a href="/" class="footer-logo">
                <span class="footer-logo-mark">✦</span>
                <span>Roolipeli</span>
            </a>

            <p>
                Your campaigns. Your characters.
                Your adventure.
            </p>

        </div>


        <div class="footer-links">

            <div class="footer-column">

                <h3>Explore</h3>

                <a href="/">Home</a>
                <a href="/campaigns">Campaigns</a>
                <a href="/new-character">Characters</a>

            </div>


            <div class="footer-column">

                <h3>Account</h3>
                <?php if(isLoggedIn()):?>
                <a href="/profile">Profile</a>
                <?php else:?>
                <a href="/login">Log in</a>
                <a href="/register">Create account</a>
                <?php endif?>
            </div>

        </div>

    </div>


    <div class="footer-bottom">

        <div class="footer-divider"></div>

        <div class="footer-bottom-content">

            <p>
                &copy; <?php echo date("Y"); ?> Roolipeli
            </p>

            <p>
                Built for tabletop adventures.
            </p>

        </div>

    </div>
</footer>

</body>
</html>