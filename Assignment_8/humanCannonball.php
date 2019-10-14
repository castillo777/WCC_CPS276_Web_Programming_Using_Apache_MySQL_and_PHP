<?
require_once ('performer.php');

class humanCannonball extends performer {
    private static $total = 0;
    
    public function __construct() {
        self::$total++;
        parent::__construct(5, 2, 3);
    }
    
    public function getRisk() {
        return parent::getRisk(self::$total);
    }
    
    public function getProfit() {
        return parent::getProfit(self::$total);
    }
    
    public function getTerror() {
        return parent::getTerror();
    }
    
    public function getTotal() {
        return self::$total;
    }
}

