<?php

/*
* Card class
*/

declare(strict_types=1);

// Folder \Controllers containing classes
namespace Joki20\Http\Controllers;
// use Joki20\Http\Controllers\CardInterface;

/**
 * Trait Deck.
 */

trait Deck
{
    private $deck = [
        /* hearts */
        '<div class="card rank2H">2 <br/> &hearts;</div>',
        '<div class="card rank3H">3 <br/> &hearts;</div>',
        '<div class="card rank4H">4 <br/> &hearts;</div>',
        '<div class="card rank5H">5 <br/> &hearts;</div>',
        '<div class="card rank6H">6 <br/> &hearts;</div>',
        '<div class="card rank7H">7 <br/> &hearts;</div>',
        '<div class="card rank8H">8 <br/> &hearts;</div>',
        '<div class="card rank9H">9 <br/> &hearts;</div>',
        '<div class="card rank10H">10 <br/> &hearts;</div>',
        '<div class="card rankJH">J <br/> &hearts;</div>',
        '<div class="card rankQH">Q <br/> &hearts;</div>',
        '<div class="card rankKH">K <br/> &hearts;</div>',
        '<div class="card rankAH">A <br/> &hearts;</div>',
        /* spades */
        '<div class="card rank2S">2 <br/> &spades;</div>',
        '<div class="card rank3S">3 <br/> &spades;</div>',
        '<div class="card rank4S">4 <br/> &spades;</div>',
        '<div class="card rank5S">5 <br/> &spades;</div>',
        '<div class="card rank6S">6 <br/> &spades;</div>',
        '<div class="card rank7S">7 <br/> &spades;</div>',
        '<div class="card rank8S">8 <br/> &spades;</div>',
        '<div class="card rank9S">9 <br/> &spades;</div>',
        '<div class="card rank10S">10 <br/> &spades;</div>',
        '<div class="card rankJS">J <br/> &spades;</div>',
        '<div class="card rankQS">Q <br/> &spades;</div>',
        '<div class="card rankKS">K <br/> &spades;</div>',
        '<div class="card rankAS">A <br/> &spades;</div>',
        /* diamonds */
        '<div class="card rank2D">2 <br/> &diams;</div>',
        '<div class="card rank3D">3 <br/> &diams;</div>',
        '<div class="card rank4D">4 <br/> &diams;</div>',
        '<div class="card rank5D">5 <br/> &diams;</div>',
        '<div class="card rank6D">6 <br/> &diams;</div>',
        '<div class="card rank7D">7 <br/> &diams;</div>',
        '<div class="card rank8D">8 <br/> &diams;</div>',
        '<div class="card rank9D">9 <br/> &diams;</div>',
        '<div class="card rank10D">10 <br/> &diams;</div>',
        '<div class="card rankJD">J <br/> &diams;</div>',
        '<div class="card rankQD">Q <br/> &diams;</div>',
        '<div class="card rankKD">K <br/> &diams;</div>',
        '<div class="card rankAD">A <br/> &diams;</div>',
        /* clubs */
        '<div class="card rank2C">2 <br/> &clubs;</div>',
        '<div class="card rank3C">3 <br/> &clubs;</div>',
        '<div class="card rank4C">4 <br/> &clubs;</div>',
        '<div class="card rank5C">5 <br/> &clubs;</div>',
        '<div class="card rank6C">6 <br/> &clubs;</div>',
        '<div class="card rank7C">7 <br/> &clubs;</div>',
        '<div class="card rank8C">8 <br/> &clubs;</div>',
        '<div class="card rank9C">9 <br/> &clubs;</div>',
        '<div class="card rank10C">10 <br/> &clubs;</div>',
        '<div class="card rankJC">J <br/> &clubs;</div>',
        '<div class="card rankQC">Q <br/> &clubs;</div>',
        '<div class="card rankKC">K <br/> &clubs;</div>',
        '<div class="card rankAC">A <br/> &clubs;</div>'
    ];

    public function shuffleDeck() {
        return shuffle($this->deck);
    }

    public function deckSize() {
        return count($this->deck);
    }
}
