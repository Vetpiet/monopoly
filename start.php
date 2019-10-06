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
    <?php $nrOfPlayers = $_POST['howmany']; ?>
    <h1 class="ui header">Monopoly Simulator</h1>
    <div class="ui container">
        <form class="ui form" method="post" action="go.php">
            <?php
            for($x=1; $x <= $nrOfPlayers; $x++) {
                $playerArray[] = 'Player ' . $x;
            }
            foreach ($playerArray as $player) {
                echo '<div class="ui label">' . $player . '</div>';
            }
            ?>
            <input type="hidden" name="players" id="players" value='<?php echo json_encode($playerArray); ?>'>
            <button class="ui button" type="submit">Go!</button>
        </form>
    </div>
</body>
</html>