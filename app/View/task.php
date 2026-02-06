<style>
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
<h1>Добро пожаловать!</h1>
<?php
// лучше всего конечно через fetch прокидывать put и delete, но решил оставить обычный хак через hidden input
/*
fetch(`/tasks/${id}`, {
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(data)
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            window.location.href = '/tasks/';
        } else {
            alert('Ошибка: ' + (data.error || 'Неизвестная ошибка'));
        }
    })
*/
?>
<div class="taskForm">
    <h2>Форма редактирования Уведомления</h2>
    <form action="" method="post">
        <input type="hidden" name="_method" value="PUT">
        <label>
            Статус:
            <input type="checkbox" name="status" value="y"<?=$data['status'] === 'y' ? ' checked' : ''?>>
        </label>

        <input type="text" name="title" placeholder="Заголовок" value="<?=$data['title']?>">
        <textarea name="description" placeholder="Текст"><?=$data['description']?></textarea>
        <input type="submit" value="Отправить">
    </form>
</div>

<h2>Элемент <?=$data['title']?></h2>
<p>Id элемента: <?=$data['id']?></p>
<p>Text элемента: <?=$data['description']?></p>
<p>Status элемента: <?=$data['status']?></p>

<form action="" method="post">
    <input type="hidden" name="_method" value="DELETE">
    <input type="submit" value="Удалить элемент">
</form>