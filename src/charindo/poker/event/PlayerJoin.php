<?php

declare(strict_types=1);

namespace charindo\poker\event;

use charindo\poker\module\inventoryui\CustomInventory;
use pocketmine\event\Listener;

use charindo\poker\Main;
use pocketmine\event\player\PlayerJoinEvent;

class PlayerJoin implements Listener {

    protected Main $owner;

    public function __construct(Main $owner) {
        $owner->getLogger()->info("Loaded PlayerJoin");
        $this->owner = $owner;
    }

    public function onJoin(PlayerJoinEvent $event) : void {
        $player = $event->getPlayer();
        $name = $player->getName();

        //$player->setCurrentWindow(new CustomInventory())
    }
}