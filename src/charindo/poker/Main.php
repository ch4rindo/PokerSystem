<?php

declare(strict_types=1);

namespace charindo\poker;

use charindo\poker\command\TestCommand;
use charindo\poker\event\PlayerJoin;
use charindo\poker\trump\Card;
use charindo\poker\trump\CardNumbers;
use charindo\poker\trump\CardSuits;
use charindo\poker\trump\Deck;
use pocketmine\plugin\PluginBase;
use charindo\poker\module\inventoryui\InventoryUI;

class Main extends PluginBase {

    public function onEnable(): void {
        /******************** デバック用 ********************/
        $deck = new Deck();
        $deck->initialize();
        $count = 0;

        $cards = $deck->shuffle();
        foreach ($cards as $card) {
            var_dump($card->getDescription());
        }
        $this->getLogger()->info("TOTAL NUMBER OF CARDS: " . count($deck->getCards()));
        var_dump($deck->addCard(new Card(CardSuits::SPADE, CardNumbers::ACE)));

        //var_dump($deck->takeCard()->getDescription());
        /**************************************************/

        InventoryUI::setup($this);

        /***** リスナー登録 *****/
        $events = [
            new PlayerJoin($this),
        ];
        foreach ($events as $event) {
            $this->getServer()->getPluginManager()->registerEvents($event, $this);
        }

        /***** コマンド登録 *****/
        $commands = [
            new TestCommand($this),
            "t" => new TestCommand($this),
        ];
        foreach ($commands as $key => $command) {
            if (is_int($key)) {
                $this->getServer()->getCommandMap()->register("Casino", $command);
            } else {
                $this->getServer()->getCommandMap()->register("Casino", $command, $key);
            }
        }

        $this->getLogger()->info("PokerSystemを読み込みました。");
    }
}