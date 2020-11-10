<?php
/**
 * Author: Matthew McGee
 * Date: 11/10/2020
 * File: booking_search.class.php
 *Description:
 */

class BookingSearch extends BookingIndexView {
    //display page header

    public function display($terms, $bookings){
        parent::displayHeader("Search Results");
        ?>
            <div id="main-header"> Search Results for <i><?= $terms ?></i></div>
            <span class="rcd-numbers">
            <?php
                    echo ((!is_array($bookings)) ? "( 0 - 0 )" : "( 1 - " . count($bookings) . " )");
                    ?>
            </span>
            <hr>

        <?php
        if ($bookings === 0) {
        echo "No booking was found.<br><br><br><br><br>";
        } else {
            // display bookings in a table
        ?>
        <table border="0">
            <tr>
                <th>Booking ID</th>
                <th>Customer ID</th>
                <th>Last</th>
                <th>First</th>
                <th>Vehicle ID</th>
                <th>Year</th>
                <th>Make</th>
                <th>Model</th>
                <th>Start Date</th>
                <th>End Date</th>
            </tr>
            <?php
            foreach ($bookings as $booking) {
                echo "<tr>";
                echo "<td>" . $booking->getId() . "</td>";
                echo "<td>" . $booking->getCustomerId() . "</td>";
                echo "<td>" . $booking->getFirstName() . "</td>";
                echo "<td>" . $booking->getLastName() . "</td>";
                echo "<td>" . $booking->getVehicleId() . "</td>";
                echo "<td>" . $booking->getVehicleYear() . "</td>";
                echo "<td>" . $booking->getVehicleMake() . "</td>";
                echo "<td>" . $booking->getVehicleModel() . "</td>";
                echo "<td>" . $booking->getStartDate() . "</td>";
                echo "<td>" . $booking->getEndDate() . "</td>";
                echo "</tr>";
            }
        ?>
            </table>
            <a href="<?= BASE_URL ?>/booking/index">Go to bookings list</a>
        <?php
        //display page footer
        parent::displayFooter();
        }

    //end of display method


    }
}