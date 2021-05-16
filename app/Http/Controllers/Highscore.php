<?php

/*
* Card class
*/

declare(strict_types=1);

// Folder \Controllers containing classes
namespace Joki20\Http\Controllers;


/**
 * Trait Deck.
 */

class Highscore
{
    protected ?string $stack = '';
    protected ?array $deck = [
        /* hearts */
        '<div class="card rank02H">2 <br/> &hearts;</div>',
        '<div class="card rank03H">3 <br/> &hearts;</div>',
        '<div class="card rank04H">4 <br/> &hearts;</div>',
        '<div class="card rank05H">5 <br/> &hearts;</div>',
        '<div class="card rank06H">6 <br/> &hearts;</div>',
        '<div class="card rank07H">7 <br/> &hearts;</div>',
        '<div class="card rank08H">8 <br/> &hearts;</div>',
        '<div class="card rank09H">9 <br/> &hearts;</div>',
        '<div class="card rank10H">10 <br/> &hearts;</div>',
        '<div class="card rank11H">J <br/> &hearts;</div>',
        '<div class="card rank12H">Q <br/> &hearts;</div>',
        '<div class="card rank13H">K <br/> &hearts;</div>',
        '<div class="card rank14H">A <br/> &hearts;</div>',
        /* spades */
        '<div class="card rank02S">2 <br/> &spades;</div>',
        '<div class="card rank03S">3 <br/> &spades;</div>',
        '<div class="card rank04S">4 <br/> &spades;</div>',
        '<div class="card rank05S">5 <br/> &spades;</div>',
        '<div class="card rank06S">6 <br/> &spades;</div>',
        '<div class="card rank07S">7 <br/> &spades;</div>',
        '<div class="card rank08S">8 <br/> &spades;</div>',
        '<div class="card rank09S">9 <br/> &spades;</div>',
        '<div class="card rank10S">10 <br/> &spades;</div>',
        '<div class="card rank11S">J <br/> &spades;</div>',
        '<div class="card rank12S">Q <br/> &spades;</div>',
        '<div class="card rank13S">K <br/> &spades;</div>',
        '<div class="card rank14S">A <br/> &spades;</div>',
        /* diamonds */
        '<div class="card rank02D">2 <br/> &diams;</div>',
        '<div class="card rank03D">3 <br/> &diams;</div>',
        '<div class="card rank04D">4 <br/> &diams;</div>',
        '<div class="card rank05D">5 <br/> &diams;</div>',
        '<div class="card rank06D">6 <br/> &diams;</div>',
        '<div class="card rank07D">7 <br/> &diams;</div>',
        '<div class="card rank08D">8 <br/> &diams;</div>',
        '<div class="card rank09D">9 <br/> &diams;</div>',
        '<div class="card rank10D">10 <br/> &diams;</div>',
        '<div class="card rank11D">J <br/> &diams;</div>',
        '<div class="card rank12D">Q <br/> &diams;</div>',
        '<div class="card rank13D">K <br/> &diams;</div>',
        '<div class="card rank14D">A <br/> &diams;</div>',
        /* clubs */
        '<div class="card rank02C">2 <br/> &clubs;</div>',
        '<div class="card rank03C">3 <br/> &clubs;</div>',
        '<div class="card rank04C">4 <br/> &clubs;</div>',
        '<div class="card rank05C">5 <br/> &clubs;</div>',
        '<div class="card rank06C">6 <br/> &clubs;</div>',
        '<div class="card rank07C">7 <br/> &clubs;</div>',
        '<div class="card rank08C">8 <br/> &clubs;</div>',
        '<div class="card rank09C">9 <br/> &clubs;</div>',
        '<div class="card rank10C">10 <br/> &clubs;</div>',
        '<div class="card rank11C">J <br/> &clubs;</div>',
        '<div class="card rank12C">Q <br/> &clubs;</div>',
        '<div class="card rank13C">K <br/> &clubs;</div>',
        '<div class="card rank14C">A <br/> &clubs;</div>'
    ];

    public function deckSize(array $sessionDeck) {
        return count($sessionDeck);
    }

    public function returnDeck() {
        return $this->deck;
    }
}
