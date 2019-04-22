<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>DemoShop</title>
    <link rel="stylesheet" href="/assets/css/main.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700&amp;subset=cyrillic" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
</head>
<body>
    <div class="container-fluid header">
        <div class="container">
            <div class="row">
                <div class="col logo">
                    <i class="fas fa-store"></i> <span>DemoShop</span>
                </div>
                <div class="col pull-right cart" id="cart">
                    <i class="fas fa-shopping-cart"></i> <span>Total: <b id="total">0</b> $</span>
                </div>
                <div style="display:none" class="some-cart">
                    <table></table>
                    <p>Empty</p>
                    <button id="clear-cart"><i class="fas fa-trash-alt"></i> Clear</button>
                    <button id="buy-now"><i class="fas fa-receipt"></i> Buy now</button>
                </div>
            </div>
        </div>
    </div>
    <section class="main-section">
        <div class="container">
            <?= $content ?>
        </div>
    </section>
    <footer>
        <div class="container">
            <p>Demo Site 2019</p>
        </div>
    </footer>
    <div class="overlay" style="display:none;"></div>
    <div class="modal" style="display:none;">
        <p>Enter your contacts</p>
        <input type="text" id="username" placeholder="Your name">
        <input type="text" id="userphone" placeholder="Phone number">
        <button id="send">SEND</button>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="/assets/js/main.js"></script>
</body>
</html>