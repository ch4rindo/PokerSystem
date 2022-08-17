<?php

declare(strict_types=1);

namespace charindo\poker\command;

use charindo\poker\trump\Card;
use charindo\poker\trump\CardNumbers;
use charindo\poker\trump\CardSuits;
use charindo\poker\trump\Deck;
use charindo\poker\trump\Hand;
use charindo\poker\trump\Judgement;
use charindo\poker\trump\Table;
use pocketmine\permission\DefaultPermissions;
use pocketmine\command\CommandSender;
use pocketmine\command\defaults\VanillaCommand;

use charindo\poker\Main;

class TestCommand extends VanillaCommand{

    private Main $owner;

    public function __construct(Main $owner, string $command = "test"){
        $description = "テストコマンド";
        parent::__construct($command, $description, $description, [$command]);

        $this->owner = $owner;
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args) {
        if ($sender->hasPermission(DefaultPermissions::ROOT_CONSOLE)) {
            $deck = new Deck();
            $deck->initialize();

            $table = new Table();
            $hand = new Hand();

            $deck->shuffle();
            for ($i=0; $i < 2; $i++) {
                $hand->addCard($deck->takeCard());
            }
            for ($i=0; $i < 5; $i++) {
                $table->addCard($deck->takeCard());
            }
            $cards = array_merge($hand->getCards(), $table->getCards());

            var_dump(Judgement::isFlush($cards));

            $sender->sendMessage("§a§lコマンドは正常に実行されました");
        }else{
            $sender->sendMessage("§cこのコマンドを実行する権限がありません");
        }
    }
}