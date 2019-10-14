<?
abstract class performer {
    private $risk = 0;
    private $terror = 0;
    private $profit = 0;
    private static $total_performers = 0;
    
    public function __construct($risk, $profit, $terror) {
        $this->risk = $risk;
        $this->terror = $terror;
        $this->profit = $profit;
        self::$total_performers++;
    }
    
    protected function getRisk($child_total) {
        if ($child_total / self::$total_performers > 0.5) {
            return $this->risk * $this->risk; // rule 3
        } elseif ($child_total / self::$total_performers > 0.2) {
            return $this->risk * 2; // rule 4
        }
        
        return $this->risk;            
    }
    
    protected function getProfit($child_total) {
        if ($child_total / self::$total_performers > 0.5) {
            return $this->profit * 2; // rule 3
        } elseif ($child_total / self::$total_performers > 0.2) {
            return $this->profit * 1.5; // rule 4
        }
        
        return $this->profit;
    }
    
    public function getTerror() {
        return $this->terror;
    }
    
    abstract function getTotal();
}
