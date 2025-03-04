<?php include "include/header.php"; ?>
<?php include "include/message.php"; ?>

<title>Culture Connect | Главная</title>
<style>
        body, html {
            height: 100%;
            margin: 0;
            padding: 0;
        }
        
        @media (max-width: 1201px) {
            .hero-section {
                background: url('static/png/main-back.png') no-repeat center center;
                display: flex;
                align-items: center;
                justify-content: flex-end; /* Контент справа */
                padding: 50px;
            }
            .hero-content {
            max-width: 500px;
            padding: 30px;
            border-radius: 10px;
            color: #fff; /* Белый текст */
            background: rgba(0, 0, 0, 0.16); /* Затемнение фона */
            text-align: left;
            }
        }

        @media (min-width: 1201px) and (max-width: 1634px) {
                .hero-section {
                background: url('static/png/main-back.png') no-repeat center center;
                background-size: cover;
                display: flex;
                align-items: center;
                justify-content: flex-end; /* Контент справа */
                padding: 50px;
            }
        }

        @media (min-width: 1635px) {
            .hero-section {
                background: url('static/png/main-back.png') no-repeat center center;
                background-size: cover;
                display: flex;
                align-items: center;
                padding: 50px 50px 50px 1150px;
            }
        }
        .hero-content {
            max-width: 500px;
            padding: 30px;
            border-radius: 10px;
            color: #fff; /* Белый текст */
            text-align: left;
        }
        .hero-content h1 {
            font-size: 48px;
            font-weight: bold;
            margin-bottom: 10px;
        }
        .hero-content h3 {
            font-size: 24px;
            font-weight: normal;
            margin-bottom: 15px;
        }
        .hero-content p {
            font-size: 16px;
            line-height: 1.5;
            margin-bottom: 20px;
        }
        .btn-brown {
            background-color: #6d4c41;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            display: inline-block;
        }
        .btn-brown:hover {
            background-color: #54362d;
        }
    </style>
<div class="hero-section">
    <div class="hero-content">
        <h1 class="mooli-regular">Culture Connect</h1>
        <h3 class="comfortaa-regular">Слоган компании</h3>
        <p class="comfortaa-regular">Для современного мира понимание сути ресурсосберегающих технологий играет определяющее значение для новых принципов формирования материально-технической и кадровой базы.</p>
        <a href="#" class="btn btn-brown">Узнать больше</a>
    </div>
</div>
<?php include "include/footer.php"; ?>