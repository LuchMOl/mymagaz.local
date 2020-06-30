<span style="margin-left:<?= $space; ?>px">
    <a href ='/category/edit/?editId=<?= $category->id ?>'>
        <?= $category->name ?> (<?= $category->id ?>) -</a>
    Ранг: <?= $category->rank ?> -
    <?= $category->activity ? 'Активна' : 'Не активна'; ?>
    <a href ='/category/showAll/?show=topMenu'>
        <?= $category->topMenu ? ' - Топ меню' : ''; ?></a>
    <br></span>