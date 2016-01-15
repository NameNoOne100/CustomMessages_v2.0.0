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

    public function onJoin(PlayerJoinEvent $event) {

      $player = $event->getPlayer();
      chdir($this->getDataFolder());
      $file = file_get_contents("config.yml");
      str_replace("{PLAYER}", $player->getName(), $file);
      $str = strstr("join-message: ", $file);

      if(preg_match("/\n/", $str, $matches)) {

        $file = str_replace("join-message: ", "", $file);
        $file = strstr($file, $matches[0], true);
        $event->setJoinMessage($file);

      }

    }

    public function onQuit(PlayerQuitEvent $event) {

      $player = $event->getPlayer();
      chdir($this->getDataFolder());
      $file = file_get_contents("config.yml");
      str_replace("{PLAYER}", $player->getName(), $file);
      $str = strstr("quit-message: ", $file);

      if(preg_match("/\n/", $str, $matches)) {

        $file = str_replace("quit-message: ", "", $file);
        $file = strstr($file, $matches[0], true);
        $event->setQuitMessage($file);

      }

    }

  }

?>
