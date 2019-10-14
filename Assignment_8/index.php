<?
session_start();
require_once ('circus.php');

$index = NULL;
$rate = NULL;

$lion_tamers = isset($_SESSION['lion_tamers']) ? $_SESSION['lion_tamers'] : NULL; 
$lion_tamers = isset($_REQUEST['lion_tamers']) ? $_REQUEST['lion_tamers'] : $lion_tamers; 
$_SESSION['lion_tamers'] = $lion_tamers;
 
$clowns = isset($_SESSION['clowns']) ? $_SESSION['clowns'] : NULL; 
$clowns = isset($_REQUEST['clowns']) ? $_REQUEST['clowns'] : $clowns; 
$_SESSION['clowns'] = $clowns;

$jugglers = isset($_SESSION['jugglers']) ? $_SESSION['jugglers'] : NULL; 
$jugglers = isset($_REQUEST['jugglers']) ? $_REQUEST['jugglers'] : $jugglers; 
$_SESSION['jugglers'] = $jugglers;

$trapeze_artists = isset($_SESSION['trapeze_artists']) ? $_SESSION['trapeze_artists'] : NULL; 
$trapeze_artists = isset($_REQUEST['trapeze_artists']) ? $_REQUEST['trapeze_artists'] : $trapeze_artists; 
$_SESSION['trapeze_artists'] = $trapeze_artists;

$human_cannonball = isset($_SESSION['human_cannonball']) ? $_SESSION['human_cannonball'] : NULL; 
$human_cannonball = isset($_REQUEST['human_cannonball']) ? $_REQUEST['human_cannonball'] : $human_cannonball; 
$_SESSION['human_cannonball'] = $human_cannonball;
 
$mime = isset($_SESSION['mime']) ? $_SESSION['mime'] : NULL; 
$mime = isset($_REQUEST['mime']) ? $_REQUEST['mime'] : $mime; 
$_SESSION['mime'] = $mime;

if (isset($lion_tamers) || isset($clowns) || isset($jugglers)
   || isset($trapeze_artists) || isset($human_cannonball) || isset($mime)) {
    
    $circus = new circus();
    
    if (isset($lion_tamers)) {
        for ($counter = 0; $counter < $lion_tamers; $counter++) {
            $circus->addPerformer(new lionTamer());
        }
    }
    
    if (isset($clowns)) {
        for ($counter = 0; $counter < $clowns; $counter++) {
            $circus->addPerformer(new clown());
        }
    }
    
    if (isset($jugglers)) {
        for ($counter = 0; $counter < $jugglers; $counter++) {
            $circus->addPerformer(new juggler());
        }
    }
    
    if (isset($trapeze_artists)) {
        for ($counter = 0; $counter < $trapeze_artists; $counter++) {
            $circus->addPerformer(new trapezeArtist());
        }
    }
    
    if (isset($human_cannonball)) {
        for ($counter = 0; $counter < $human_cannonball; $counter++) {
            $circus->addPerformer(new humanCannonball());
        }
    }
    
    if (isset($mime)) {
        for ($counter = 0; $counter < $mime; $counter++) {
            $circus->addPerformer(new mime());
        }    

        $index = $circus->getIndex();
        $rate = $circus->getRate();
        $total_profit = $circus->getTotalProfit();
        $total_risk = $circus->getTotalRisk();
        $total_terror = $circus->getTotalTerror();
    }
}

require_once('view.php');
