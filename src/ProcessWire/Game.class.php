<?php
    namespace TerraformingMars;
    
    use ProcessWire\Page;
    use Pauldro\Util\MagicMethods;

    class Game implements CounterInterface {
        use MagicMethods;
        use CounterTraits;
        const TEMPLATE = 'tfm-game';

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
                }/* elseif($this->structures->has_property($property)) {

                    $this->structures->call_increasedecrease($method, $args);
                } */ else {
                    echo 'error';
                    // TODO THROW ERROR
                }
            }
        }

        public static function create() {
            $gameID = bin2hex(random_bytes(10));
            $pagecreated = self::create_page($gameID);

            if ($pagecreated) {
                Structures::create($gameID);
            }
        }

        private static function create_page($gameID = '') {
            $gamespage = \Processwire\wire('pages')->get("template=tfm-game-list");
            $p = new Page();
            $p->of(false);
            $p->template = self::TEMPLATE;
            $p->parent = $gamespage;
            $p->title = $gameID;
            $p->name = $gameID;
            $p->gameid = $gameID;
            return $p->save();
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
            $this->load_players($gamepage->tfm_players);
        }

        public function load_players($players) {
            foreach ($players as $player) {
                $playerarray = array();
                //$this->players[$player->name];
            }
        }
    }