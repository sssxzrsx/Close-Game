<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('style/footer.css') }}">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
    <title>Document</title>
</head>
<body>
<footer class="footer">
    <div class="footer-container">
        <div class="footer-logo">
            <a href="{{ route('home') }}"><img src="{{ asset('images/logo.svg') }}" alt="Logo"></a>
        </div>

        <ul class="footer-links">
            <li><a href="#">ПОЛИТИКА КОНФИДИЦИАЛЬНОСТИ</a></li>
            <li><a href="#">ПОЛЬЗОВАТЕЛЬСКОЕ СОГЛАШЕНИЕ</a></li>
            <li><a href="#">ДОГОВОР-ОФЕРТА ОКАЗАНИЯ УСЛУГ</a></li>
        </ul>

        <div class="footer-social">
            <p>НАШИ СОЦ-СЕТИ:</p>
            <div class="footer-social-icons">
                <a href="https://t.me/closegame/"><i class="fab fa-telegram"></i></a>
                <a href="https://vk.com/closegame"><i class="fab fa-vk"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
            </div>
        </div>

        <div class="footer-bottom">
            <p>
                © 2025 Close Game. Все права защищены. Копирование любых материалов сайта запрещено!
                Все названия продуктов и игр, компаний и марок, логотипы, товарные знаки и другие материалы
                являются собственностью соответствующих владельцев. Только лицензионные ключи ко всем игровым
                платформам: Steam, Uplay, Battle.net, Origin и другие. Все продаваемые ключи закупаются у
                официальных дистрибьюторов и напрямую у издателей.
            </p>
        </div>
    </div>
</footer>
</body>
</html>
