<?php
    namespace TerraformingMars\ProcessWire;
        
    use Pauldro\Util\MagicMethods;
    use Pauldro\Util\CounterTraits;

    use TerraformingMars\CounterInterface;

    class Player {
        protected $id;
        protected $name;

        static function build_fromprocesswire($page) {
            $player = new Player();
            $player->id = $page->name;
            $player->name = $page->title;
        }
    }