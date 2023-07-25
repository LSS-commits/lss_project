<title><?= $title ?></title>
<div class="container">
    <h1>Your Profile</h1>
    <article>
        <h3>Username: <?= $_SESSION['user']['username'] ?></h3>
        <p>Email: <?= $_SESSION['user']['email'] ?></p>
        <p>Role: 
            <?php 
                if(str_contains($_SESSION['user']['roles'], 'ADMIN')){
                    echo 'Admin, User';
                }else{
                    echo 'User';
                }
            ?>
        </p>
        <p>Registered since: <?= date_format(date_create($_SESSION['user']['createdAt']), "D, d F Y - H:i") ?></p>
        <p>Coming soon: change password</p>
        <a href="/dashboard/user/<?= $_SESSION['user']['token'] ?>" class="link link-secondary">Back to dashboard</a>
    </article>
</div>