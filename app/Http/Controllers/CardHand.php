<?php

/*
* Card class
*/

declare(strict_types=1);

// Folder \Controllers containing classes
namespace Joki20\Http\Controllers;
use Joki20\Http\Controllers\Deck;

/**
 * Class CardHand.
 */

class CardHand
{
    use Card;

    private ?array $hand;

    public function hand() {
        $hand = [
            $this->drawCard(), // 0
            $this->drawCard(), // 1
            $this->drawCard(), // 2
            $this->drawCard(), // 3
            $this->drawCard()  // 4
        ]

        return $hand;
    }

    public function replaceCards(cards) { // i.e [0,3,4]
        foreach (cards as $card) {
            $drawnCard = array_shift($this->deck); // top card
            $this->hand[i] = $drawnCard;
        }
    }
}
