<!DOCTYPE html>
<html lang="fr">

<head>
    <title><?php echo $title ?? null ?></title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1.0" />

</head>

<body>
    <nav>
        <ul class="menu">
            <?php echo $menu ?? null; ?>
        </ul>
        <hr>
    </nav>
    <main>
        <h1>Page d'accueil</h1>
        <?php echo $content ?? null ?>
    </main>
</body>

</html>