<?php

declare(strict_types=1);

namespace charindo\poker\trump;

class HandRank {

    protected array $cards;
    protected int $max;

    public function __construct() {
        $this->cards = [];
        $this->max = 5;
    }

    public function getCards() : array {
        return $this->cards;
    }

    public function addCard(Card $card) : bool {
        if (!$this->canAddCard($card)) {
            return false;
        }

        $this->cards[] = $card;
        return true;
    }

    public function getCount() : int {
        return count($this->cards);
    }

    public function canAddCard(Card $card) : bool {
        $target_hand = [];

        foreach ($this->cards as $c) {
            $target_hand[] = $c->getDescription();
        }
        $target_hand[] = $card->getDescription();

        $unique_hand = array_unique($target_hand);
        if (count($unique_hand) !== count($target_hand)) { //被っているカードが存在する場合
            return false;
        }

        if (count($target_hand) > $this->max){ //ハンドの合計枚数が2を超えた場合
            return false;
        }

        return true;
    }
}