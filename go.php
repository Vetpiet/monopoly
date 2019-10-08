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
    <?php
        $players = $_POST['players'];
        $players = json_decode($players);

        require_once('vendor/autoload.php');

        use Monopoly\Game;
        use Monopoly\Board;
        use Monopoly\Players;

        $thisGame = new Game();
        $thesePlayers = $thisGame->players($players);

        $thisBoard = new Board();
        $board = $thisBoard->allBlocks();

        $allPlayers = new Players();
        $plCount = 1;
        foreach($thesePlayers as $player) {
            $thisPlayer = $allPlayers->thisPlayer($player);
            $currentPlayers[] = $thisPlayer;
            $plCount++;
        }

        $thisGame->start($thesePlayers);
        $startingBal = 1500;
        $startingPos = 1;

        $previous = $startingPos;
        $balance = $startingBal;

        $roundCount = 1;
//        $turnCount = 1;
        $participantCount = 1;
//        $playerCount = count($currentPlayers);
//        $ownershipArray = $currentPlayers;
//        $ownershipArray = [];
//        $ownershipArray['owns'] = [];
        $owned = '';

        // Start Game Iteration
        echo '<div class="ui blue message">Starting</div>';
        while($plCount > 1) {
            foreach ($currentPlayers as $player) {
                if ($participantCount > $plCount -1) {
                    $participantCount = 1;
                }

                $ownershipArray[$participantCount] = $player['name'];

                $rolled = $thisGame->roll();

                $move = $thisGame->move($previous, $rolled, $player, $participantCount, $balance);

                // Display move results
                echo '<br>
                <div class="ui large label">' . $move['name'] . '</div> rolled 
                <div class="ui label">' . $rolled . '</div> and is moving to 
                <div class="ui ' . $move['position'][3] . ' label">' . print_r($move['position'][0], true) . '</div> with value of
                <div class="ui label">' . print_r($move['position'][2], true) . '</div>';

                $balance = $move['balance'];

                echo '<br><div class="ui label">' . $move['name'] . '</div> balance is <div class="ui label">' . $move['balance'] . '</div>';

                if(!empty($move['msg'])) {
                    echo '<div style="text-align:right">' . $move['msg'] . '</div>';
                }

                // Add property to Players' portfolio except for these below
                $notForSaleTile = [3, 5, 8, 11, 18, 21, 23, 31, 34, 37, 39];
                if (!in_array($move['tileNum'], $notForSaleTile)) {
                    echo '<br><div style="text-align:center">' . $move['name'] . ' now Owns ' . $move['position'][0] . '</div>';
                }

                // Build Onwership Array of who owns what
                $ownershipArray[] = ['owner' => $move['name'], 'tile' => $move['tileNum']];

                if (!empty($ownershipArray['tile'])) {
                    while (!in_array($move['tileNum'], $ownershipArray['tile'])) {
                        $ownershipArray[] = ['owner' => $move['name'], 'tile' => $move['tileNum']];
                    }
                }

                // If Player passes GO
                if ($move['tileNum'] >= 39) {
                    echo '<div class="ui divider"></div>';
                    echo '<div style="text-align:right"><a class="ui teal tag label">Passing GO</a>';
                    echo '<br>' . $move['name'] . ' gets 200!</div>';
                    $balance = $move['balance'] + 200;
                    $previous = $move['tileNum'] - 40;
                } else {
                    $previous = $move['tileNum'];
                }

                // If a player lands on an Property owned by another player
                while ($ownershipArray['tile'] != '') {
                    foreach ($ownershipArray as $title) {
                        if ($move['tileNum'] == $title['tile']) {
                            if ($title['owner'] != $move['name']) {
                                $tileValue = $move['position'][2];
                                $propValue = $tileValue / 10;
                                $balance = $balance - $propValue;
                                echo $move['name'] . ' paid tax of ' . $propValue;
                            }
                        }
                    }
                }

                echo '<div class="ui divider"></div>';

                if ($move['balance'] <= 0) {
                    echo '<div class="ui red message">' . $move['name'] . ' loses</div><br/>';
                    unset($currentPlayers[$plCount]);
                    $plCount--;
                    if ($plCount < 2) {
                        break;
                    }
                }
                $participantCount++;
            }
            $roundCount++;
        }

    ?>
</div>
</body>
</html>





