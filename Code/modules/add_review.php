<form method='POST' action='add_review_act.php'>
    <input type='hidden' name='aid' value="<?php echo $article["id"] ?>">
    <input type='hidden' name='uid' value="<?php echo $user["id"] ?>">
    <textarea name="text" placeholder="Přidat komentář"></textarea>
    <input type='submit' />
</form>