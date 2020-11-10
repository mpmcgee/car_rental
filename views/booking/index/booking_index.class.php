<?php
/**
 * Author: Matthew McGee
 * Date: 11/9/2020
 * File: booking_index.class.php
 *Description:
 */

class BookingIndex extends BookingIndexView {
    public function display($bookings){
            Parent::displayHeader("List all Bookings");

        ?>
        <div id="main-header"> Bookings</div>
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

    <?php
    Parent::displayFooter();


    }

}