<?php
/**
 * Author: Danny Harris
 * Date: 11/10/20
 * File: booking_detail.class.php
 * Description:
 */

class BookingDetail extends BookingIndexView
{
    public function display($booking, $confirm = "") {
        //display page header
        parent::displayHeader("Booking Details");

        //retrieve booking details by calling get methods
        $id = $booking->getId();
        $customer_id = $booking->getCustomerId();
        $last_name = $booking->getLastName();
        $first_name = $booking->getFirstName();
        $vehicle_id = $booking->getVehicleId();
        $vehicle_year = $booking->getVehicleYear();
        $vehicle_make = $booking->getVehicleMake();
        $vehicle_model = $booking->getVehicleModel();
        $start_date = new \DateTime($booking->getStartDate());
        $end_date = new \DateTime($booking->getEndDate());
        $image = $booking->getImage();


        if (strpos($image, "http://") === false AND strpos($image, "https://") === false) {
            $image = BASE_URL . '/' . BOOKING_IMG . $image;
        }
        ?>

        <div id="main-header">Booking Details</div>
        <hr>
        <!-- display booking details in a table -->
        <table id="detail">
            <tr>
                <td style="width: 150px;">
                    <img src="<?= $image ?>" />
                </td>
                <td style="width: 130px;">
                    <p><strong>Customer ID:</strong></p>
                    <p><strong>Last Name:</strong></p>
                    <p><strong>First Name:</strong></p>
                    <p><strong>Vehicle Year:</strong></p>
                    <p><strong>Vehicle Make:</strong></p>
                    <p><strong>Vehicle Model:</strong></p>
                    <p><strong>Start Date:</strong></p>
                    <p><strong>End Date:</strong></p>
                    <div id="button-group">
                        <input type="button" id="edit-button" value="   Edit   "
                               onclick="window.location.href = '<?= BASE_URL ?>/booking/edit/<?= $id ?>'">&nbsp;
                    </div>
                </td>
                <td>
                    <p><?= $customer_id ?></p>
                    <p><?= $last_name ?></p>
                    <p><?= $first_name ?></p>
                    <p><?= $vehicle_year ?></p>
                    <p><?= $vehicle_make ?></p>
                    <p><?= $vehicle_model ?></p>
                    <p><?= $start_date->format('m-d-Y') ?></p>
                    <p><?= $end_date->format('m-d-y') ?></p>
                    <div id="confirm-message"><?= $confirm ?></div>
                </td>
            </tr>
        </table>
        <a href="<?= BASE_URL ?>/booking/index">Go to booking list</a>

        <?php
        //display page footer
        parent::displayFooter();
    }
}