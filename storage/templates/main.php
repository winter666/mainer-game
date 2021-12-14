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
        </style>
    </head>
    <body>
        <h1>Maining Game</h1>
        <?= template('table', compact('players', 'table')); ?>
    </body>
</html>