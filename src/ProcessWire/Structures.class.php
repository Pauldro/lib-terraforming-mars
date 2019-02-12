<?php
    namespace TerraformingMars;

    use ProcessWire\Page;
    use Pauldro\Util\MagicMethods;
    use Pauldro\Util\CounterTraits;

    use TerraformingMars\CounterInterface;

    class Structures implements CounterInterface {
        const TEMPLATE = 'tfm-game-structures';

        protected $oceans;
        protected $forests;
        protected $cities;

        public function create($gameid = '') {
            $game_exists = boolval(\Processwire\wire('pages')->count("template=tfm-game, gameid=$gameid"));
            
            if ($game_exists) {
                $gamepage = \Processwire\wire('pages')->get("template=tfm-game, gameid=$gameid");
                $p = new Page();
                $p->of(false);
                $p->template = self::TEMPLATE;
                $p->parent = $gamepage;
                $p->title = "Structures";
                $p->name = "structures";
                $p->save();
            } else {
                // TODO Throw Error
            }
        }
    }