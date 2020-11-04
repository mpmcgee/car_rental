<?php
/**
 * Author: Matthew McGee
 * Date: 11/1/2020
 * File: vehicle_view.class.php
 *Description:
 */


class VehicleView{
    public function display($vehicles){


        ?>

        <!DOCTYPE HTML">
<html>
    <head>
        <title>List All Vehicles</title>
        <link type="text/css" rel="stylesheet" href="includes/style.css" />
    </head>
    <body>
        <h2>Vehicles in our inventory</h2>
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
        </body>
        </html>

        <?php
    } // end of display method
    // VehicleView class
}