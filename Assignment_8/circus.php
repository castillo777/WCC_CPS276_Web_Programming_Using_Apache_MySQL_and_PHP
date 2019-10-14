<?
require_once ('lionTamer.php');
require_once ('clown.php');
require_once ('juggler.php');
require_once ('trapezeArtist.php');
require_once ('humanCannonball.php');
require_once ('mime.php');

class circus {
    private $all_performers = array();
    private $total_risk = 0;
    private $total_profit = 0;
    private $total_terror = 0;
    
    
    public function addPerformer($performer) {
        $this->all_performers[] = $performer;
    }
    
    public function getIndex() {
        foreach ($this->all_performers as $performer) {
            $this->total_risk += $performer->getRisk();
            $this->total_terror += $performer->getTerror();
            $this->total_profit += $performer->getProfit();
        }
        
       if (($this->total_profit < 1) || ($this->total_risk > $this->total_terror)) {
           return 0;
       } else {
           return number_format(100 - (($this->total_terror - $this->total_risk) / ($this->total_profit * 2) * 100));        
       }
    }
    
    public function getRate() {
        $index = $this->getIndex();
        $total = count($this->all_performers);
        return number_format(0.37 * $index * $total, 2);
    }
    
    public function getTotalRisk() {
        return $this->total_risk;
    }
    
    public function getTotalProfit() {
        return $this->total_profit;
    }
    
    public function getTotalTerror() {
        return $this->total_terror;
    }
}
