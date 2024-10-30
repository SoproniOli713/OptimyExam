<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>News and Comments</title>
</head>

<body>

    <?php foreach ($newsList as $news): ?>
        <h2>############ NEWS <?= htmlspecialchars($news->getTitle()) ?> ############</h2>
        <p><?= nl2br(htmlspecialchars($news->getBody())) ?></p>

        <?php foreach ($commentsList as $comment): ?>
            <?php if ($comment->getNewsId() == $news->getId()): ?>
                <p>Comment <?= htmlspecialchars($comment->getId()) ?>: <?= nl2br(htmlspecialchars($comment->getBody())) ?></p>
            <?php endif; ?>
        <?php endforeach; ?>

        <hr>
    <?php endforeach; ?>

</body>

</html>