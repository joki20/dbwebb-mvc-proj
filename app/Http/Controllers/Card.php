<?php

/*
* Card class
*/

declare(strict_types=1);

// Folder \Controllers containing classes
namespace Joki20\Http\Controllers;
use Joki20\Http\Controllers\Deck;

/**
 * Class Cards.
 */

class Card
{
    use Deck;

    private ?string $burnedCard;
    private ?string $drawnCard;

    public function removeCard(): void {
        $burnedCard = array_shift($this->deck); // remove top card
    }

    public function drawCard() {
        $drawnCard = array_shift($this->deck); // top card
        return $drawnCard;
    }
}
