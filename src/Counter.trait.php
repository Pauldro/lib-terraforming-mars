<?php
    namespace TerraformingMars;
    
    trait CounterTraits {
        public function __call($method, $args) {
            if (!method_exists($this, $method)) {
                if ($this->_isincrementing($method)) {
                    $property = $this->get_increasedecreaseproperty($method);
                    if ($this->has_property($property)) {
                        $this->call_increasedecrease($method, $args);
                    } else {
                        echo 'error';
                        // TODO THROW ERROR
                    }
                }
            }
        }

        protected function is_counter($property) {
            if ($this->has_property($property)) {
                return true;
            } else {
                return false;
            }
        }

        protected function increase($property, $num) {
            $this->$property += $num;
            
        }

        protected function decrease($property, $num) {
            $this->$property -= $num;
        }

        protected function _isincrementing($method) {
            return preg_match(self::REGEX_INCREASE_DECREASE, $method) ? true : false; 
        }

        protected function get_increasedecreaseproperty($method) {
           return  preg_replace(self::REGEX_INCREASE_DECREASE, '', $method);
        }

        protected function call_increasedecrease($method, array $args) {
            $property = $this->get_increasedecreaseproperty($method);
            $regex_increase = "/((increase))_/i";
            $regex_decrease = "/((decrease))_/i";
            $num = $args[0];
            
            if ($this->is_counter($property)) {
                
                if (preg_match($regex_increase, $method)) {
                    $this->increase($property, $num);
                } else { 
                    $this->decrease($property, $num);
                }
            } else {
                // TODO THROW ERROR
            }
        }
    }