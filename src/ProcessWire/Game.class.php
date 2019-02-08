<?php
    namespace TerraformingMars;
    
    use Pauldro\Util\MagicMethods;

    class Game implements CounterInterface {
        use MagicMethods;
        use CounterTraits;

        protected $id;
        protected $players;
        protected $currentplayer;
        protected $firstplayer;
        protected $structures;
        protected $tracks;
        private $pw_game;

        public function __call($method, $args) {
            if ($this->_isincrementing($method)) {
                $property = $this->get_increasedecreaseproperty($method);

                if ($this->tracks->has_property($property)) {
                    $this->tracks->call_increasedecrease($method, $args);
                } elseif($this->structures->has_property($property)) {
                    $this->structures->call_increasedecrease($method, $args);
                } else {
                   $this->error("Property $property cannot be incremented or depleted");
                }
            }
        }

        public static function load($id) {
            $gamepage = \Processwire\wire('pages')->get("template=tfm-game, gameid=$id");
            $game = new Game();
            $game->load_processwire($gamepage);
            return $game;
        }
        
        public function load_processwire($gamepage) {
            $this->id = $gamepage->id;
            $this->pw_game = $gamepage;
            
            foreach ($gamepage->players as $player) {
                $this->players[] = Player::build_fromprocesswire($player);
            }
        }
    }