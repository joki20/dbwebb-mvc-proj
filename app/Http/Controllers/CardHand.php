<?php

/*
* Card class
*/

declare(strict_types=1);

// Folder \Controllers containing classes
namespace Joki20\Http\Controllers;
use Joki20\Http\Controllers\Card;

/**
 * Class CardHand.
 */

class CardHand extends Card
{
    private array $hand = [];
    private string $suits = "";
    private string $values = "";

    public function drawHand() {
        $this->hand = [
            $this->drawCard(), // 0
            $this->drawCard(), // 1
            $this->drawCard(), // 2
            $this->drawCard(), // 3
            $this->drawCard()  // 4
        ];

        return $this->hand;
    }

    public function replaceCards() { // i.e [0,3,4]
        foreach ($this->hand as $card) {
            $drawnCard = array_shift($this->deck); // top card
            $this->hand[i] = $drawnCard;
        }
    }

    public function suits() {
        for ($card = 0; $card < 5; $card++) {
            $this->suits = $this->suits . substr($this->hand[$card], 23, 1);
        }
        return $this->suits;
    }

    public function values() {
        for ($card = 0; $card < 5; $card++) {
            $this->values = $this->values . substr($this->hand[$card], 21, 2);
        }
        return $this->values;
    }

    // public function showHand() {
    //     echo '
    //     <table>
    //         <tr>' . foreach($this->hand as $card) { . '
    //
    //         }
    //             for ($card = 0; $card < 5; $card++) {
    //             <td>' .
    //
    //
    //         echo $this->hand[i];
    //     }
    //     return $this->values;
    // }

}
