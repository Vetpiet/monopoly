<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Monopoly</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.css" />
    <script src="https://code.jquery.com/jquery-3.1.1.min.js" ></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.js"></script>

</head>
<body>
    <h1 class="ui header">Monopoly Simulator</h1>
    <div class="ui container">
        <form class="ui form" method="post" action="start.php">
            <label>How many players?</label>
            <div class="ui input focused">
                <select class="ui dropdown" name="howmany" id="howmany">
                    <option value="2" selected>2</option>
                    <option>3</option>
                    <option>4</option>
                </select>
            </div>
            <button class="ui button" type="submit">Go</button>
        </form>
    </div>
</body>
</html>


