<?php

namespace charindo\poker\trump;

class Card {

    protected int $number;

    protected string $suit;

    protected array $cardNumbers = [
        CardNumbers::ACE => "Ace",
        CardNumbers::TWO => "Two",
        CardNumbers::THREE => "Three",
        CardNumbers::FOUR => "Four",
        CardNumbers::FIVE => "Five",
        CardNumbers::SIX => "Six",
        CardNumbers::SEVEN => "Seven",
        CardNumbers::EIGHT => "Eight",
        CardNumbers::NINE => "Nine",
        CardNumbers::TEN => "Ten",
        CardNumbers::JACK => "Jack",
        CardNumbers::QUEEN => "Queen",
        CardNumbers::KING => "King",
    ];

    protected array $cardSuits = [
        CardSuits::SPADE => "Spade",
        CardSuits::HEART => "Heart",
        CardSuits::DIAMOND => "Diamond",
        CardSuits::CLUB => "Club",
    ];

    public function __construct(int $suit = null, $number = null) {
        if(!is_null($suit)) {
            $this->setSuit($suit);
        }

        if(!is_null($number)) {
            $this->setValue($number);
        }
    }

    public function getNumber() : int {
        return $this->number;
    }

    public function getNumberString() : string {
        return $this->cardNumbers[$this->number];
    }

    public function getSuit() : int {
        return $this->suit;
    }

    public function getSuitString() : string {
        return $this->cardSuits[$this->suit];
    }

    public function getDescription() : string {
        return $this->getSuitString() . "'s " . $this->getNumberString();
    }

    public function setValue($value) : void {
        if(!$this->isValidNumber($value)){
            throw new \InvalidArgumentException("No such numbered cards exist for Trump");
        }
        $this->number = $value;
    }

    public function setSuit($suit) : void {
        if(!$this->isValidSuit($suit)){
            throw new \InvalidArgumentException("No such numbered cards exist for Trump");
        }
        $this->suit = $suit;
    }

    protected function isValidNumber($value) : bool {
        return array_key_exists($value, $this->cardNumbers);
    }

    protected function isValidSuit($value) : bool {
        return array_key_exists($value, $this->cardSuits);
    }
}