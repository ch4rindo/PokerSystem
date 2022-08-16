<?php

declare(strict_types=1);

namespace charindo\poker\trump;

class Card {

    protected int $number;

    protected int $suit;

    public function __construct(int $suit = null, int $number = null) {
        if ($suit !== null) {
            $this->setSuit($suit);
        } else {
            throw new \InvalidArgumentException("Cannot assign null to a suit");
        }

        if ($number !== null) {
            $this->setNumber($number);
        } else {
            throw new \InvalidArgumentException("Cannot assign null to a number");
        }
    }

    public function getNumber() : int {
        return $this->number;
    }

    public function getNumberString() : string {
        return CardStore::NUMBERS[$this->number];
    }

    public function getSuit() : int {
        return $this->suit;
    }

    public function getSuitString() : string {
        return CardStore::SUITS[$this->suit];
    }

    public function getDescription() : string {
        return $this->getSuitString() . "'s " . $this->getNumberString();
    }

    public function getArray() : array {
        return [
            "suit" => $this->suit,
            "number" => $this->number,
        ];
    }

    public function setNumber(int $number) : void {
        if (!$this->isValidNumber($number)) {
            throw new \InvalidArgumentException("No such numbered cards exist for Trump");
        }
        $this->number = $number;
    }

    public function setSuit(int $suit) : void {
        if (!$this->isValidSuit($suit)) {
            throw new \InvalidArgumentException("No such numbered cards exist for Trump");
        }
        $this->suit = $suit;
    }

    protected function isValidNumber($value) : bool {
        return array_key_exists($value, CardStore::NUMBERS);
    }

    protected function isValidSuit($value) : bool {
        return array_key_exists($value, CardStore::SUITS);
    }
}