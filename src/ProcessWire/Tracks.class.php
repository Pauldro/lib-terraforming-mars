<?php
    namespace TerraformingMars\ProcessWire;
    
    use TerraformingMars\CounterInterface;
    
    class Tracks implements CounterInterface {
        use MagicMethods;
        use CounterTraits;

        protected $temperature = 0;
        protected $oxygen = 0;
        protected $generation = 0;
    }