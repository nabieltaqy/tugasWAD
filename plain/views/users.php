Users - <a href="/">Home</a><br/><br/>
<h1>Welcome</h1>
<?php foreach($users as $user): ?>
    <p>User ID: <?php echo $user->getId(); ?>, Name: <?php echo $user->getUsername(); ?></p>
<?php endforeach; ?>