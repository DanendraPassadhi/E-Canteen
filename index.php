<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Canteen</title>
    <link rel="icon" href="./img/icon.png">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600&display=swap');

        :root {
            --green: #27ae60;
            --blue: #162157;
            --light-blue: #1877F2;
            --gray: #CAD8DE;
            --black: #333;
            --white: #fff;
            --bg-color: #F39237;
            --box-shadow: 0 .5rem 1rem rgba(0, 0, 0, .1);
            --border: .1rem solid var(--bg-color);
        }

        * {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            outline: none;
            border: none;
            text-decoration: none;
            text-transform: capitalize;
        }

        html {
            font-size: 62.5%;
            overflow-x: hidden;
        }

        body {
            background-image: url(./img/background.png);
            background-size: 40%;
        }

        .sambutan {
            background: var(--bg-color);
            font-size: 4rem;
            width: 69rem;
            height: 33rem;
            margin-top: 47rem;
            color: var(--white);
            padding: .8em;
            text-align: center;
            margin: auto;
            top: 20rem;
            position: relative;
            border-radius: 3rem;
        }

        .sambutan .btn-masuk {
            margin: 2rem auto;
            background: var(--light-blue);
            width: 15.8rem;
            height: 6rem;
            font-size: 1.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: 0.3s;
            border-radius: .5em;
        }

        .sambutan .btn-masuk a {
            text-decoration: none;
            color: var(--white);
            
        }

        .sambutan .btn-masuk:hover {
            background: var(--black);

        }
    </style>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script>
        $(document).ready(function () {
            $('.akhir').hide();
            $(".btn-masuk").hover(function () {
                $('.awal').hide();
                $('.akhir').show();
            },
                function () {
                    $('.akhir').hide();
                    $('.awal').show();
                });
        })
    </script>
</head>

<body>
    <div class="sambutan">
        <h2>E-Canteen</h2>
        <p style="font-size:2.4rem">Sistem Informasi Pengelolaan Menu Kantin</p>
        <div class="btn-masuk">
            <a href="canteen.php" class="awal">MASUK</a>
            <a href="canteen.php" class="akhir">Masuk aja bro, gausah sungkan</a>
        </div>
    </div>
</body>

</html>