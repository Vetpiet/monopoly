<?php

namespace Monopoly;

use Psr\Log;

class Game {
    public function players($players) {
        return $players;
    }

    public function roll() {
        $dice1 = rand(1,6);
        $dice2 = rand(1,6);
        $result = $dice1 + $dice2;
        return $result;
    }

    public function move($previous,$rolled, $player, $plCount, $balance) {
//        echo '<br>' . __METHOD__, print_r(func_get_args(), true);
        $thisBoard = new Board();
        $pos = $previous + $rolled;
        $boardPosition = $thisBoard->allBlocks();
        $newPos = $boardPosition[$pos];

        if ($newPos[1] == 1) {
            $balance = $balance - $newPos[2];
            $next = $newPos;
        } else {
            $balance = $balance + $newPos[2];
            $next = $newPos;
        }

        // On Landing on a Community Chest Tile
        $commChestTiles = [3, 18, 34];
        if (in_array($pos, $commChestTiles)) {
            $update = $this->communityChest();
            $balance = $balance + $update[1];
            $msg = $update[0];
        }

        // On Landing on a Chance Tile
        $chanceTiles = [8, 23, 37];
        if (in_array($pos, $chanceTiles)) {
            $update = $this->chance();
            $balance = $balance + $update[1];
            $msg = $update[0];
        }

        // On Landing on the Go to Jail Tile
        if ($pos == 31) {
            $pos = 11;
            $msg = '<div class="ui red tag label">Go Directly to JAIL. Do not pass GO. Do Not Collect 200</div>';
        }

//        // On passing Go
//        if ($pos + $rolled > 39) {
//            $balance = $balance + 200;
//            $pos = $pos -40;
//            $msg = '<div class="ui divider"></div>
//                    <div style="text-align:right"><a class="ui teal tag label">Passing GO</a>
//                    <br>' . $player['name'] . ' gets 200!</div>';
//        }

//        // On Landing on the Jail - Just Visiting Tile
//        if ($pos == 11) {
//            $msg = '<div class="ui green tag label">Just Visiting</div>';
//        }

        // On Landing on any Railway Station
        $railwayTiles = [6, 16, 26, 36];
        if (in_array($pos, $railwayTiles)) {
            $msg = '<i class="train icon"></i>';
        }

        // On Landing on a Tax tile
        $taxTiles = [5,39];
        if (in_array($pos, $taxTiles)) {
            $msg = '<i class="money bill alternate icon"></i>';
        }

        if ($newPos[3] != 0) {
            $colour = $newPos[3];
        }

        $thisPlayer = ['name' => $player['name'], 'balance' => $balance, 'position' => $next, 'tileNum' => $pos, 'colour' => @$colour, 'msg' => @$msg];

//        echo 'Sending: ' . print_r($thisPlayer, true);
        return $thisPlayer;
    }

    public function start($players) {
        $start = 1;
        $balance = 1500;
        $startArray = ['startTile' => $start, 'startBalance' => $balance, 'allPlayers' => $players];
        return $startArray;
    }

    public function communityChest() {
        $values = [-250, -200, -150, -100, -50, 50, 100, 150, 200, 250];

        $value = array_rand(array_flip($values));

        if ($value > 0) {
            $msg = '<i class="box icon"></i><div class="ui green tag label"><i class="smile outline icon"></i>  You have received ' . $value .'</div>';
            $val = $value;
        } else {
            $msg = '<i class="box icon"></i><div class="ui red tag label"><i class="frown outline icon"></i>  You have to pay ' . $value .'</div>';
            $val = $value;
        }

        $returnArray = [$msg, $val];

        return $returnArray;
    }

    public function chance() {
        $values = [-250, -200, -150, -100, -50, 50, 100, 150, 200, 250];

        $value = array_rand(array_flip($values));

        if ($value > 0) {
            $msg = '<i class="question icon"></i><div class="ui green tag label"><i class="smile outline icon"></i>  You have received ' . $value . '</div>';
            $val = $value;
        } else {
            $msg = '<i class="question icon"></i><div class="ui red tag label"><i class="frown outline icon"></i>  You have to pay ' . $value . '</div>';
            $val = $value;
        }

        $returnArray = [$msg, $val];

        return $returnArray;
    }
}