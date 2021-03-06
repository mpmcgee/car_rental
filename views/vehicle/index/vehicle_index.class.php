<?php
/**
 * Author: Matthew McGee
 * Date: 11/11/2020
 * File: vehicle_index.class.php
 *Description:
 */

class VehicleIndex extends VehicleIndexView {
    public function display($vehicles){
        Parent::displayHeader("List all vehicle");


        if ($vehicles === 0) {
        echo "No vehicle were found.<br><br><br><br><br>";
        } else {
        //display bookings in table
        ?>

            <div class="middle-row">
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
            $id = $vehicle->getId();
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

            echo "<td><a href='" , BASE_URL, "/vehicle/detail/$id'></td>";
            echo "</tr>";
        }

        ?>
        </table>
            </div>
        </body>
        </html>

        <?php
            Parent::displayFooter();
    }
    } // end of display method

}// VehicleView class