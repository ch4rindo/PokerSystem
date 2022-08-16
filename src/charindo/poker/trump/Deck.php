<?php

declare(strict_types=1);

namespace charindo\poker\trump;

class Deck {

    protected array $cards;
    protected int $max;

    public function __construct() {
        $this->cards = [];
        $this->max = 52;
    }

    public function initialize() : void{
        foreach(CardStore::NUMBERS as $number => $value) {
             foreach(CardStore::SUITS as $suit => $val) {
                 $this->cards[] = new Card($suit, $number);
             }
        }
    }

    public function getCards() : array {
        return $this->cards;
    }

    public function getCount() : int {
        return count($this->cards);
    }

    public function shuffle() : array {
        for ($i=0; $i < 5; $i++) {
            shuffle($this->cards);
        }
        return $this->cards;
    }

    public function addCard(Card $card) : bool {
        if (!$this->canAddCard($card)) {
            return false;
        }

        $this->cards[] = $card;
        return true;
    }

    public function canAddCard(Card $card) : bool {
        $target_deck = [];

        foreach ($this->cards as $c) {
            $target_deck[] = $c->getDescription();
        }
        $target_deck[] = $card->getDescription();

        $unique_deck = array_unique($target_deck);
        if (count($unique_deck) !== count($target_deck)) { //被っているカードが存在する場合
            return false;
        }

        if (count($target_deck) > $this->max){ //デッキの合計枚数が52を超えた場合
            return false;
        }

        return true;
    }

    public function takeCard() : ?Card {
        if (count($this->getCards()) <= 0) {
            return null;
        }

        return array_shift($this->cards);
    }
}