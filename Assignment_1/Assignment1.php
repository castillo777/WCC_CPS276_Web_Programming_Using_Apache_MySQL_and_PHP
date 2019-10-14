<?
    define('GLASS_COST_PER_SQUARE_INCH', 0.03); // Glass cost in dollars
    define('WATER_COST_PER_CUBIC_INCH', 0.001); // Water cost in dollars

    $height = filter_input(INPUT_POST, 'height');    
    $width = filter_input(INPUT_POST, 'width');
    $depth = filter_input(INPUT_POST, 'depth'); 
    
    if (!is_numeric($height) || !is_numeric($width) || !is_numeric($depth)) {
        $height = null;
        $width = null;
        $depth = null;
    }
    
    $total_aquarium_surface_area = 0.000;
    $total_water_volume = 0.000;
    $total_glass_cost = 0.000;
    $total_water_cost = 0.000;
    $total_aquarium_cost = null;
    
    if ($height && $width && $depth) {
        $total_aquarium_surface_area = (2 * ($width * $height)) + (2 * ($width * $depth)) + (2 * ($height * $depth));
        $total_aquarium_volume = ($height * $width * $depth);
        $total_glass_cost = ($total_aquarium_surface_area * GLASS_COST_PER_SQUARE_INCH);
        $total_water_cost = ($total_aquarium_volume * WATER_COST_PER_CUBIC_INCH);
        $total_aquarium_cost = "$".number_format(($total_glass_cost + $total_water_cost), 2);       
    }
 
?>
<!DOCTYPE html>
<html>
    Aquarium Cost Estimator
    <br><br>
    
    <form action="Assignment1.php" method="post">
        height <input value="<? echo($height); ?>" type="text" name="height" maxlength="10"> <br>
        width &nbsp;<input value="<? echo($width); ?>" type="text" name="width" maxlength="10"> <br>
        depth &nbsp;<input value="<? echo($depth); ?>" type="text" name="depth" maxlength="10"> <br><br>
        <input type="submit" value="Estimate cost">
    </form>
    <br><br>
    
    Your total estimated cost is: <? echo($total_aquarium_cost); ?>
    
</html>

