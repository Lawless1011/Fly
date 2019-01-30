<?php

namespace Nerahikada\Fly;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;
use pocketmine\Player;

class Main extends PluginBase implements Listener{

	private $fly;

	public function onEnable(){
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
	}

	public function onJoin(PlayerJoinEvent $event){
		$this->fly[$event->getPlayer()->getName()] = false;
	}

	public function onCommand(CommandSender $sender, Command $command, string $label, array $args) : bool{
		if(!$sender instanceof Player){
			$sender->sendMessage("§cゲーム内で実行してください");
			return true;
		}

		$bool = !$this->fly[$sender->getName()];
		$this->fly[$sender->getName()] = $bool;

		$sender->sendMessage("飛行が" . ($bool ? "有効" : "無効") . "になりました");

		$sender->setAllowFlight($bool);
		$sender->setFlying($bool);
		return true;
	}

}