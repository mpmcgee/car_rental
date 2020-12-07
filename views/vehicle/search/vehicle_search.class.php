<?php
/**
 * Author: Matthew McGee
 * Date: 11/11/2020
 * File: vehicle_search.class.php
 *Description:
 */

class VehicleSearch extends VehicleIndexView {
    //display page header

    public function display($terms, $vehicles){
        parent::displayHeader("Search Results");
        ?>
        <div id="main-header"> Search Results for <i><?= $terms ?></i></div>
        <span class="rcd-numbers">
            <?php
            echo ((!is_array($vehicles)) ? "" :  count($vehicles) . " result(s)");
            ?>
            </span>
        <hr>

        <?php
        if ($vehicles === 0) {
            echo "No vehicle was found.<br><br><br><br><br>";
        } else {
            // display vehicle in a table
            ?>
            <div id="main-header"> Vehicles </div>
        <table border="0">
        <tr>
            <th>Year</th>
            <th>Make</th>
            <th>Model</th>
            <th>Engine Type</th>
            <th>Transmission</th>
            <th>Class</th>
            <th>Doors</th>
            <th>Line</th>
            <th>Passengers</th>
            <th>Suitcases</th>
            <th>Combined MPG</th>
            <th>Sirius Capability</th>
            <th>Price Per Day</th>
        </tr>
        <?php
        foreach ($vehicles as $vehicle) {
            echo "<tr>";
            echo "<td>" . $vehicle->getYear() . "</td>";
            echo "<td>" . $vehicle->getMake() . "</td>";
            echo "<td>" . $vehicle->getModel() . "</td>";
            echo "<td>" . $vehicle->getEngineType() . "</td>";
            echo "<td>" . $vehicle->getTransmission() . "</td>";
            echo "<td>" . $vehicle->getClass() . "</td>";
            echo "<td>" . $vehicle->getDoors() . "</td>";
            echo "<td>" . $vehicle->getLine() . "</td>";
            echo "<td>" . $vehicle->getPassengers() . "</td>";
            echo "<td>" . $vehicle->getSuitcases() . "</td>";
            echo "<td>" . $vehicle->getMPG() . "</td>";
            echo "<td>" . $vehicle->getSirius() . "</td>";
            echo "<td>" . $vehicle->getPrice() . "</td>";
            echo "</tr>";
            }
        ?>
            </table>
            <a href="<?= BASE_URL ?>/vehicle/index">Go to vehicles list</a>
            <?php
            //display page footer
            parent::displayFooter();
        }

        //end of display method


    }
}