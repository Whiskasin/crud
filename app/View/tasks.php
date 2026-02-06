<?php
$isPost = $_SERVER['REQUEST_METHOD'] === 'POST';
?>
<h1>Добро пожаловать!</h1>
<style>
    .element {
        margin-bottom: 30px;
    }
    .taskForm form {
        width: 30%;
        display: flex;
        flex-direction: column;
    }
    .taskForm form input,
    .taskForm form textarea {
        margin-bottom: 10px;
    }
</style>

<div class="taskForm">
    <h2>Форма создания Уведомлений</h2>
    <form action="" method="post">
        <input type="text" name="title" placeholder="Заголовок">
        <textarea name="description" placeholder="Текст"></textarea>
        <input type="submit" value="Отправить">
    </form>
</div>

<?php if (!$isPost):?>
<h2>Список элементов</h2>
<div class="elements">
    <?php foreach ($data as $item):?>
        <div class="element">
            <?php if ($item['status'] === 'y'):?>
                <a href="/tasks/<?=$item['id']?>" class="title"><?=$item['title']?></a>
            <?php else: //например, скрыть из публикации или еще чего?>
                <a href="/tasks/<?=$item['id']?>" class="title">Не активный элемент - <?=$item['title']?></a>
            <?php endif;?>
            <p class="text"><?=$item['description']?></p>
        </div>
    <?php endforeach;?>
</div>
<?php endif;?>