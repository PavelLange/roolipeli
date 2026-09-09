<?php require_once "../models/users.php";?>
<?php
$id = $_SESSION["user_id"];
$userinfo = getAllInfo($id); 
?>
<main class="profile-page">
    <section class="profile-card">
        <div class="profile-heading">
            <p class="eyebrow">Account</p>
            <h1>Your profile</h1>
            <p>Manage your account details and adventurer identity.</p>
        </div>

        <div class="profile-content">
            <div class="profile-avatar-wrap">
                <img
                    src="/images/profile_pic.jpg"
                    alt="Profile"
                    class="profile-pic"
                >
            </div>

            <dl class="profile-details">
                <div class="profile-detail">
                    <dt>Username</dt>
                    <dd><?= htmlspecialchars($userinfo["Kayttajanimi"] ?? "") ?></dd>
                </div>

                <div class="profile-detail">
                    <dt>Email</dt>
                    <dd><?= htmlspecialchars($userinfo["Sahkoposti"] ?? "") ?></dd>
                </div>

                <div class="profile-detail">
                    <dt>Member since</dt>
                    <dd><?= htmlspecialchars($userinfo["Tehty"] ?? "") ?></dd>
                </div>
            </dl>
        </div>

        <div class="profile-actions">
            <div>
                <h2>Delete account</h2>
                <p>This permanently removes your account and its data.</p>
            </div>

            <a
                href="/delete-account?id=<?= urlencode((string) $id) ?>"
                class="button button-secondary"
                onClick="return confirm('Are you sure you want to delete this account?');"
            >
                Delete account
            </a>
        </div>
    </section>
</main>
