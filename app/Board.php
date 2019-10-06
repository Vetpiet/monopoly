<?php

namespace Monopoly;

class Board {
    public function allBlocks() {
        $boardArray = [
            1   => ["Go", 0, 200, 0],
            2   => ["Mediterranean Ave", 1, 60, "blue"],
            3   => ["Community Chest", 0, 0, 0],
            4   => ["Baltic Ave", 1, 80, "blue"],
            5   => ["Income Tax", 1, 1200, 0],
            6   => ["Reading Railroad", 1, 200, 0],
            7   => ["Oriental Ave", 1, 100, "teal"],
            8   => ["Chance", 0, 0, 0],
            9   => ["Vermont Ave", 1, 100, "teal"],
            10  => ["Connecticut Ave", 1, 120, "teal"],
            11  => ["JAIL - Just Visiting", 0, 0],
            12  => ["St Charles Place", 1, 140, "purple"],
            13  => ["Electric Company", 1, 150, 0],
            14  => ["States Ave", 1, 140, "purple"],
            15  => ["Virginia Ave", 1, 160, "purple"],
            16  => ["Pennsylvania Railroad", 1, 200, 0],
            17  => ["St James Place", 1, 180, "orange"],
            18  => ["Community Chest", 0, 0, 0],
            19  => ["Tennessee Ave", 1, 180, "orange"],
            20  => ["New York Ave", 1, 200, "orange"],
            21  => ["Free Parking", 0, 0, 0],
            22  => ["Kentucky Ave", 1, 220, "red"],
            23  => ["Chance", 0, 0, 0],
            24  => ["Indiana Ave", 1, 220, "red"],
            25  => ["Illinois Ave", 1, 240, "red"],
            26  => ["B & O Railroad", 1, 200, 0],
            27  => ["Atlantic Ave", 1, 260, "yellow"],
            28  => ["Ventnor Ave", 1, 260, "yellow"],
            29  => ["Water Works", 1, 150, 0],
            30  => ["Marvin Gardens", 1, 280, "yellow"],
            31  => ["Go To Jail", 0, -200, 0],
            32  => ["Pacific Ave", 1, 300, "green"],
            33  => ["North Carolina Ave", 1, 300, "green"],
            34  => ["Community Chest", 0, 0, 0],
            35  => ["Pennsylvania Ave", 1, 320, "green"],
            36  => ["Short Line", 1, 200, 0],
            37  => ["Chance", 0, 0, 0],
            38  => ["Park Place", 1, 340, "violet"],
            39  => ["Luxury Tax", 0, 350, 0],
            40  => ["Boardwalk", 1, 400, "violet"]
        ];
        return $boardArray;
    }
}