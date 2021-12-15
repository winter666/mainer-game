<!DOCTYPE html>
<html>
    <head>
        <title>Maining Game</title>
        <meta name="charset" value="utf-8" />
        <style>
            body {
                background-color: black;
                color: #ffffff;
            }
            .records {
                display: flex;
                justify-content: space-around;
                flex-wrap: wrap;
            }
        </style>
    </head>
    <body>
        <h1>Maining Game</h1>
        <?= template('records', compact('players', 'table', 'scores')) ?>
    </body>
</html>