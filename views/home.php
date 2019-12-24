<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Choco Test</title>
</head>
<body>
    <h2>Случайная запись</h2>
    <ul>
        <li><strong>ID:</strong> <?php echo $randomPromo['id']; ?></li>
        <li><strong>Название акции:</strong> <?php echo $randomPromo['name']; ?></li>
        <li><strong>Дата начала акции:</strong> <?php echo $randomPromo['start_date']; ?></li>
        <li><strong>Дата окончания:</strong> <?php echo $randomPromo['end_date']; ?></li>
        <li><strong>Статус:</strong> <?php echo $randomPromo['status']; ?></li>
    </ul>

    <h2>Все записи</h2>
    <?php foreach($allPromo as $promo): ?>
    <ul>
        <li><strong>ID:</strong> <?php echo $promo['id']; ?></li>
        <li><strong>Название акции:</strong> <?php echo $promo['name']; ?></li>
        <li><strong>Дата начала акции:</strong> <?php echo $promo['start_date']; ?></li>
        <li><strong>Дата окончания:</strong> <?php echo $promo['end_date']; ?></li>
        <li><strong>Статус:</strong> <?php echo $promo['status']; ?></li>
        <li><strong>Ссылка:</strong> <a href="<?php echo $promo['link']; ?>"><?php echo $promo['link']; ?></a></li>
    </ul>
    <?php endforeach; ?>
</body>
</html>
