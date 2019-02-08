<?php
    namespace TerraformingMars;
    
    use Pauldro\Util\MagicMethods;
    use Pauldro\Util\CounterTraits;

    use TerraformingMars\CounterInterface;

    class Game implements CounterInterface {
        use MagicMethods;
        use CounterTraits;

        protected $id;
        protected $players;
        protected $currentplayer;
        protected $firstplayer;
        protected $structures;
        protected $tracks;


        public function get_player($id) {

        }

        public function add_player($id) {

        }

        public function remove_player($id) {

        }

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

        public function __construct() {
            $this->tracks = new GameTracks();
           // $this->structures new GameStructures();

           // $this->tracks->increase_generation(1);
           // $this->increase_oceans(9);
            $this->tracks->decrease_temperature(30);
        }
    }