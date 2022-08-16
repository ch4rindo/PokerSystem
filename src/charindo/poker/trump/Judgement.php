<?php

declare(strict_types=1);

namespace charindo\poker\trump;

class Judgement {

    public static function isOnePair(array $cards) : bool {
        $pair = 1;

        $card_numbers = [];
        foreach ($cards as $card) {
            $card_numbers[] = $card->getNumber();
        }
        while (($key = array_search(1, $card_numbers)) !== false) {
            $card_numbers[$key] = CardNumbers::GOD;
        }
        arsort($card_numbers);
        var_dump($card_numbers);

        $covered_cards = array_values(array_unique(array_diff($card_numbers, array_keys(array_count_values($card_numbers), 1))));
        var_dump($covered_cards);

        if (count($covered_cards) > 0) {
            $i = 0;
            foreach ($covered_cards as $card_number) {
                $result = array_keys($card_numbers, $card_number);
                if (count($result) === 2) {
                    $i++;
                }
            }

            if ($i === $pair) {
                return true;
            }
        }
        return false;
    }

    public static function isTwoPair(array $cards) : bool {
        $pair = 2;

        $card_numbers = [];
        foreach ($cards as $card) {
            $card_numbers[] = $card->getNumber();
        }
        while (($key = array_search(1, $card_numbers)) !== false) {
            $card_numbers[$key] = CardNumbers::GOD;
        }
        arsort($card_numbers);

        $covered_cards = array_values(array_unique(array_diff($card_numbers, array_keys(array_count_values($card_numbers), 1))));

        if (count($covered_cards) > 0) {
            $i = 0;
            foreach ($covered_cards as $card_number) {
                $result = array_keys($card_numbers, $card_number);
                if (count($result) === 2) {
                    $i++;
                }
            }

            if ($i === $pair) {
                return true;
            }
        }
        return false;
    }

    public static function isThreeOfAKind(array $cards) : bool {
        $card_numbers = [];
        foreach ($cards as $card) {
            $card_numbers[] = $card->getNumber();
        }
        while (($key = array_search(1, $card_numbers)) !== false) {
            $card_numbers[$key] = CardNumbers::GOD;
        }
        arsort($card_numbers);

        $covered_cards = array_values(array_unique(array_diff($card_numbers, array_keys(array_count_values($card_numbers), 1))));

        if (count($covered_cards) > 0) {
            foreach ($covered_cards as $card_number) {
                $result = array_keys($card_numbers, $card_number);
                if (count($result) === 3) {
                    return true;
                }
            }
        }
        return false;
    }

    public static function isStraight(array $cards) : bool {
        //TODO
        return false;
    }

    public static function isFlush(array $cards) : bool {
        $card_suits = [];
        foreach ($cards as $card) {
            $card_suits[] = $card->getSuit();
        }
        foreach (CardStore::SUITS as $suit => $word) {
            $result = array_keys($card_suits, $suit);
            if (count($result) >= 5) {
                return true;
            }
        }
        return false;
    }

    public static function isFullHouse(array $cards) : bool {
        /*
        $card_numbers = [];
        foreach ($cards as $card) {
            $card_numbers[] = $card->getNumber();
        }
        while (($key = array_search(1, $card_numbers)) !== false) {
            $card_numbers[$key] = CardNumbers::GOD;
        }
        arsort($card_numbers);

        $covered_cards = array_values(array_unique(array_diff($card_numbers, array_keys(array_count_values($card_numbers), 1))));

        $isThreeCard = false;
        $isOnePair = false;
        if (count($covered_cards) > 0) {
            foreach ($covered_cards as $card_number) {
                if ($isThreeCard && $isOnePair) {
                    continue;
                }

                $result = array_keys($card_numbers, $card_number);
                if (count($result) === 3) {
                    $isThreeCard = true;
                } elseif (count($result) === 2) {
                    $isOnePair = true;
                }
            }
        }

        if($isThreeCard && $isOnePair){
            return true;
        }

        return false;
        */

        return self::isThreeOfAKind($cards) && self::isOnePair($cards);
    }

    public static function isFourOfAKind(array $cards) : bool {
        $card_numbers = [];
        foreach ($cards as $card) {
            $card_numbers[] = $card->getNumber();
        }
        while (($key = array_search(1, $card_numbers)) !== false) {
            $card_numbers[$key] = CardNumbers::GOD;
        }
        arsort($card_numbers);

        $covered_cards = array_values(array_unique(array_diff($card_numbers, array_keys(array_count_values($card_numbers), 1))));

        if (count($covered_cards) > 0) {
            foreach ($covered_cards as $card_number) {
                $result = array_keys($card_numbers, $card_number);
                if (count($result) === 4) {
                    return true;
                }
            }
        }
        return false;
    }

    public static function isStraightFlush(array $cards) : bool {
        //TODO
        return false;
    }

    public static function isRoyalFlush(array $cards) : bool {
        //TODO
        return false;
    }

    public static function mergeSuitsAndNumbers(array $suits, array $numbers) : array {
        $cards = [];
        foreach ($suits as $suit) {
            foreach ($numbers as $number){
                $cards[] = new Card($suit, $number);
            }
        }
        return $cards;
    }
}