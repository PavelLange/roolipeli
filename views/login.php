<?php require_once "../controllers/userController.php" ?>
<main class="auth-page">

    <section class="auth-card">

        <div class="auth-heading">
            <h1>Login</h1>
            <p>Log in to continue your adventure.</p>
        </div>
        <?php if(!empty($error4)):?>
                <p class="error-message-login"><?= htmlspecialchars($error4) ?></p>
            <?php endif?>
        <form class="auth-form" action="/login" method="post">

            <div class="form-group">
                <label for="username">Username</label>
                <input
                    id="username"
                    type="text"
                    name="username"
                    maxlength="30"
                    required
                >
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input
                    id="password"
                    type="password"
                    name="password"
                    maxlength="30"
                    required
                >
            </div>

            <button class="button button-primary button-full" type="submit">
                Login
            </button>

        </form>

        <div class="auth-footer">
            <p>
                Don't have an account?
                <a href="/register">Register</a>
            </p>
        </div>

    </section>

</main>
