<?php

declare(strict_types=1);

namespace charindo\poker;

use charindo\poker\trump\Deck;
use pocketmine\plugin\PluginBase;

class Main extends PluginBase {

    public function onEnable(): void {
        /******************** デバック用 ********************/
        $deck = new Deck();
        $deck->initializeDeck();
        $count = 0;

        $cards = $deck->shuffle();
        foreach($cards as $card) {
            var_dump($card->getDescription());
        }
        $this->getLogger()->info("TOTAL NUMBER OF CARDS: " . count($deck->getCards()));
        if(!$deck->isBrokenDeck($deck->getCards())) {
            $this->getLogger()->info("デッキは正常です");
        }else{
            $this->getLogger()->error("デッキが破損しています");
        }

        var_dump($deck->takeCard()->getDescription());
        /**************************************************/

        $this->getLogger()->info("PokerSystemを読み込みました。");
    }
}