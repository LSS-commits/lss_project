<h1>User Profile</h1>
<article>
    <h3>Username: <?= $user->username ?></h3>
    <p>Email: <?= $user->email ?></p>
    <p>Role: 
        <?php 
            if(str_contains($user->roles, 'ADMIN')){
                echo 'Admin, User';
            }else{
                echo 'User';
            }
        ?>
    </p>
    <p>Coming soon: change password</p>
    <a href="/dashboard/user/<?= $user->id ?>" class="link link-secondary">Back to dashboard</a>
</article>