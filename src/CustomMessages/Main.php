<?php

  namespace CustomMessages;

  use pocketmine\plugin\PluginBase;
  use pocketmine\event\Listener;
  use pocketmine\event\player\PlayerJoinEvent;
  use pocketmine\event\player\PlayerQuitEvent;

  class Main extends PluginBase implements Listener {

    public function onEnable() {

      $this->getServer()->getPluginManager()->registerEvents($this, $this);

      if(!(file_exists($this->getDataFolder()))) {

        @mkdri($this->getDataFolder());
        chdir($this->getDataFolder());
        touch("config.yml");
        file_put_contents("config.yml", "join-message: \n");
        file_put_contents("config.yml", "quit-message: \n", FILE_APPEND);
        

      }

    }
