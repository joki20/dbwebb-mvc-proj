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
            $this->drawCard(),
            $this->drawCard(),
            $this->drawCard(),
            $this->drawCard(),
            $this->drawCard()
        ]

        return $hand;
    }

    public function discard(cards) { // i.e card [0,3,4]
        $this->hand[i] = $this->drawCard();
    }
}
