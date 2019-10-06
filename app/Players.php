<?php


namespace Monopoly;

class Players
{
    public function thisPlayer($player) {
        $balance = null;
        $position = null;
        $thisPlayer = ['name' => $player, 'balance' => $balance, 'position' => $position];
        return $thisPlayer;
    }

    public function currentPlayer() {

    }
}