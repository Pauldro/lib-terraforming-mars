<?php
    namespace TerraformingMars;
    
    use Pauldro\Util\MagicMethods;

    class Player {
        use MagicMethods;
        use CounterTraits;

        protected $username;
        protected $fullname;

    }

    class PlayerSession extends Player {
        use MagicMethods;
        use CounterTraits;

        protected $gameid;
    }