<?php

declare(strict_types=1);

namespace charindo\poker\trump;

class CardStore {

    public const NUMBERS = [
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
        CardNumbers::GOD => "King",
    ];

    public const SUITS = [
        CardSuits::SPADE => "Spade",
        CardSuits::HEART => "Heart",
        CardSuits::DIAMOND => "Diamond",
        CardSuits::CLUB => "Club",
    ];


}