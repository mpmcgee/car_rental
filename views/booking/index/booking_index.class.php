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
            <th>Vehicle ID</th>
            <th>Start Date</th>
            <th>End Date</th>
        </tr>
        <?php
        foreach ($bookings as $booking) {
            echo "<tr>";
            echo "<td>" . $booking->getId() . "</td>";
            echo "<td>" . $booking->getCustomerId() . "</td>";
            echo "<td>" . $booking->getVehicleId() . "</td>";
            echo "<td>" . $booking->getStartDate() . "</td>";
            echo "<td>" . $booking->getEndDate() . "</td>";
            echo "</tr>";
        }
//        $this->customer_id = $customer_id;
        //        $this->customer_name = $customer_name;
        //        $this->vehicle_id = $vehicle_id;
        //        $this->vehicle_year = $vehicle_year;
        //        $this->vehicle_make = $vehicle_make;
        //        $this->vehicle_model = $vehicle_model;
        //        $this->start_date = $start_date;
        //        $this->end_date = $end_date;
        ?>
    </table>

    <?php
    Parent::displayFooter();


    }

}