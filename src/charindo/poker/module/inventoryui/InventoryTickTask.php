<?php

namespace charindo\poker\module\inventoryui;

use pocketmine\scheduler\Task;
use pocketmine\Server;

class InventoryTickTask extends Task {

    private int $tick = 0;

    public function __construct(private Server $server) { }

    public function onRun(): void {
        foreach ($this->server->getOnlinePlayers() as $player) {
            $inventory = $player->getCurrentWindow();
            if ($inventory instanceof CustomInventory) $inventory->onTick($this->tick);
        }

        $this->tick++;
    }
}