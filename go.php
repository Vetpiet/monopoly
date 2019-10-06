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
        foreach($thesePlayers as $player) {
            $thisPlayer = $allPlayers->thisPlayer($player);
            $currentPlayers[] = $thisPlayer;
        }

        $thisGame->start($thesePlayers);
        $startingBal = 1500;
        $startingPos = 1;

        $previous = $startingPos;
        $balance = $startingBal;

        $roundCount = 1;
        $turnCount = 1;
        $playerCount = count($currentPlayers);
        $ownershipArray = [];
        $ownershipArray['player']['owns'] = [];
        $owned = '';

        // Start Game Iteration
        echo '<div class="ui blue message">Starting</div>';
        while($playerCount > 1) {
            foreach ($currentPlayers as $player) {
                $ownershipArray['player'] = $player;
                $rolled = $thisGame->roll();

                $move = $thisGame->move($previous, $rolled, $player, $balance);

                while ($ownershipArray['player'] != $player) {
                    if (in_array($move['tileNum'], $ownershipArray['player']['owns'])) {
                        $propValue = $thisBoard[$move['tileNum']];
                        $charge = $propValue['2'] / 10;
                        $balance = $balance - $charge;
                        echo '<a class="ui red tag label">Pay Up ' . $charge . '</a>';
                    }
                }

                if ($move['tileNum'] >= 39) {
                    echo '<div style="text-align:right"><a class="ui teal tag label">Passing GO</a>';
                    echo '<br>' . $move['name'] . ' gets 200!</div>';
                    $balance = $move['balance'] + 200;
                    $previous = 0;
                } else {
                    $previous = $move['tileNum'];
                }

                echo '<br>
                <div class="ui large label">' . $move['name'] . '</div> rolled 
                <div class="ui label">' . $rolled . '</div> and is moving to 
                <div class="ui ' . $move['position'][3] . ' label">' . print_r($move['position'][0], true) . '</div> with value of
                <div class="ui label">' . print_r($move['position'][2], true) . '</div>';
                if(!empty($move['msg'])) {
                    echo '<div style="text-align:right">' . $move['msg'] . '</div>';
                }

                $owned.= $move['tileNum'] . ',';

                if ($ownershipArray['player']['name'] == $move['name']) {
                    $ownershipArray['player']['owns'] = array($owned);
                }

                $balance = $move['balance'];

                echo '<br><div class="ui label">' . $move['name'] . '</div> balance is <div class="ui label">' . $move['balance'] . '</div>';

                echo '<div class="ui divider"></div>';

                var_dump($ownershipArray);

                if ($move['balance'] <= 0) {
                    echo '<div class="ui red message">' . $move['name'] . ' loses</div><br/>';
                    unset($currentPlayers[$playerCount]);
                    $playerCount--;
                }
                $turnCount++;
            }
            $roundCount++;
        }

    ?>
</div>
</body>
</html>





