<?php

/*
* Card class
*/

declare(strict_types=1);

// Folder \Controllers containing classes
namespace Joki20\Http\Controllers;
use Joki20\Http\Controllers\Deck;

/**
 * Class Card.
 */

class Card
{
    use Deck;

    private ?string $removedCard;
    private ?string $drawnCard;

    public function removeCard(): void {
        $removedCard = array_shift($this->deck); // remove top card
    }

    public function drawCard() {
        $drawnCard = array_shift($this->deck); // top card
        return $drawnCard;
    }
}
