<!DOCTYPE html>
<html lang="fr">

<head>
    <title><?php echo $title ?></title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1.0" />

</head>

<body>
    <nav>
        <ul class="menu">
            <?php if (isset($menu)) echo $menu; ?>
        </ul>
        <hr>
    </nav>
    <main>
    <?php echo $content['text'] ?? null ?>
    Notre Zoo contient différents animaux :
    <ul>
        <?php if(is_array($content)) ?>
            <?php echo $content['zoo']->display() ?? null ?>
    </ul>
    <a href="/?controller=zoo&action=monstres">Ajouter des monstres</a>
    </main>
</body>

</html>