[![Build Status](https://travis-ci.com/joki20/dbwebb-mvc-proj.svg?branch=master)](https://travis-ci.com/joki20/dbwebb-mvc-proj)

# Poker Squares

## Introduction

In this project for the course MVC in web programming spring -21 I've made a game called Poker Squares. The aim of the game is to gather as many points as possible by playing out cards and create valuable poker hands. Score high and you might place yourself on top of the highscore list!

<div><img src="public/images/pokersquares.png"
     alt="Poker Squares
     style; text-align: center" /></div>

You can try the game here:

http://www.student.bth.se/~joki20/dbwebb-kurser/mvc/me/proj/public/

#### Rules

You have a grid consisting of 5x5 empty cells. Each turn a new card in the deck shows up and you have to click on one of the empty cells to place the card there. As soon as a row or column contains five cards, points for that poker hand is valued accordingly:

  HAND                  Pts   EXPLAINATION
  Royal Straight Flush  100   10 J Q K A in same suit
  Straight Flush         75   Straight in same suit
  Four of a kind         50   Four of same value
  Full house             25   Three of a kind + Two Pairs
  Flush                  20   All cards in same suit
  Straight               15   Cards with consecutive value
  Three of a kind        10   Three of same value
  Two pairs               5   Two different sets of cards, each with equal value
  Pair                    2   Two cards with equal value

For a hand you can only score one of above. For example, If you have four of a kind, you will not also score for three of a kind.

#### Highscore

After you finished a game, you can go watch the highscore list and see where you placed. The list contains the name you chose at the start of the game and your total sum of all ten hands.

#### Histogram

In the histogram you can see the distribution of all previous hands played, in every game played (10 hands for each game). In this way you can analyze how common it is to score different kind of hands. For example, in time you can expect a Straight Flush to score less often compared to three of a kind since it is much harder to get.
