<?php
    include 'config.php';
    $msg = 'Введите полный url (ссылку) и мы сформируем короткий адрес';
    
    if(isset($_GET['short']) AND $_GET['short']!= '' ){
        
        $short = strip_tags(trim($_GET['short']));
        $msg = "Ваша короткая ссылка <a href=\"$short\">$short</a><br>Можете создать еще";
        
    }elseif(isset($_GET['error']) AND $_GET['error']!= '' ){
        
        $short = strip_tags(trim($_GET['error']));
        $msg = "Красивая ссылка $short уже занята, выберите другое имя";
        
    }
    elseif( isset( $_SERVER['REQUEST_URI']) AND strlen($_SERVER['REQUEST_URI']) > 1){
        
        $request = 'http://animadqu.bget.ru/' . substr(strip_tags(trim($_SERVER['REQUEST_URI'])), 1);
        $sql='SELECT * FROM url WHERE short = "' . $request .'"';
        $result = $connect->query($sql);
        if($result->num_rows>0){
            while($row=$result->fetch_assoc()){
                 header('Location: ' . $row['full']);
            }
        }else{
            $msg = 'Запрашиваемой ссылки не существует. Но Вы можете её создать';
        }
    }
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Тестовая задача</title>
    <!-- b0a8e2d8ccb04b24683d347076e80d29e451a385:d3aa2e6571e673001cb012eda23bd97d02234f0b -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="main.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=PT+Sans&amp;subset=cyrillic,latin-ext" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=PT+Sans+Caption&amp;subset=cyrillic,latin-ext" rel="stylesheet">
</head>
<body>
<div class="top">
    <header>
        <a href="http://animadqu.bget.ru/" title="Главная" class="logo">
            <img src="https://cp.beget.com/i/logo.png">
        </a>
    </header>
    <main>
        <div class="octo">
            <img src="https://cp.beget.com/img/octo/octo_coffee.png">
        </div>
        <div class="alert alert-success">
            <div class="icon">
                <img src="https://cp.beget.com/i/icons/small/accept@2x.png">
            </div>
            <div class="text">
                <h1><?=$msg?></h1>
                <form action="cut.php" method="POST">
                    <input type="url" name="full" required="required" placeholder="https://example.com" /><br/>
                    <h4>Вы можете указать ниже красивое окончание для имени Вашей ссылки, или оставить пустой - тогда будет выбрано случайное имя</h4>
                    <input name="short" placeholder="solution" /><br/>
                    <button>Обрезать</button>
                </form>
            </div>
        </div>
    </main>
</div>
</body>
</html>