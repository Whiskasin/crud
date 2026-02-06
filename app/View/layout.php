<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: Arial, sans-serif; line-height: 1.6; padding: 20px; }
        header { background: #333; color: white; padding: 1rem; margin-bottom: 2rem; }
        nav a { color: white; margin-right: 15px; text-decoration: none; }
        .container { max-width: 1200px; margin: 0 auto; }
    </style>
</head>
<body>
<header>
    <nav>
        <a href="/">Главная</a>
        <a href="/tasks/">Уведомления</a>
    </nav>
</header>

<div class="container">
    <?php include $content; ?>
</div>
</body>
</html>