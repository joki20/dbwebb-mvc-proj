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
    private ?string $drawnCard;

    public function drawCard() {
        $drawnCard = array_shift($this->deck); // first card in array
        return $drawnCard;
    }
}
