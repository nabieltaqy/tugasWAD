Posts - <a href="/">Home</a><br/><br/>
<h1>Welcome</h1>
<form method="post" action="/post/doPost">
    <table>
        <tr>
            <td>UserId</td><td> : </td><td><input type="text" name="user_id" value="<?= isset($userid) ? $userid : "" ?>"/></td>
        </tr>
        <tr>
            <td>Content</td><td> : </td><td><input type="text" name="content"/></td>
        </tr>
        <tr>
            <td><input type="submit" value="Submit"/></td>
        </tr>
    </table>
</form>
<br/><br/>
<?php foreach($posts as $post): ?>
    <p>Post ID: <?php echo $post->getId(); ?>, Name: <?php echo $post->getContent(); ?></p>
<?php endforeach; ?>