<main class="auth-page">

    <section class="auth-card">

        <div class="auth-heading">
            <h1>Register</h1>
            <p>Create an account and begin your adventure.</p>
        </div>

        <form class="auth-form" action="/register" method="post">

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
                <label for="email">Email</label>
                <input
                    id="email"
                    type="email"
                    name="email"
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
                Register
            </button>

        </form>

        <div class="auth-footer">
            <p>
                Already have an account?
                <a href="/login">Log in</a>
            </p>
        </div>

    </section>

</main>