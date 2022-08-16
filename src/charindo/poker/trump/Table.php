<?php

declare(strict_types=1);

namespace charindo\poker\trump;

class Table {

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
        $target_table = [];

        foreach ($this->cards as $c) {
            $target_table[] = $c->getDescription();
        }
        $target_table[] = $card->getDescription();

        $unique_table = array_unique($target_table);
        if (count($unique_table) !== count($target_table)) { //被っているカードが存在する場合
            return false;
        }

        if (count($target_table) > $this->max){ //テーブルの合計枚数が5を超えた場合
            return false;
        }

        return true;
    }
}