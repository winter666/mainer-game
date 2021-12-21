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
            .records > div {
                margin: 20px;
                min-width: 600px;
                max-width: 600px;
                max-height: 400px;
                overflow-y: auto;
            }
            .event_result .event_result__data {
                display: flex;
                justify-content: space-between;
            }
        </style>
    </head>
    <body>
        <h1>Maining Game</h1>
        <div id="app">
            <?= template('records', compact('players', 'table', 'scores', 'event')) ?>
        </div>
    </body>
</html>