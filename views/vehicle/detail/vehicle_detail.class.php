<?php
/**
 * Author: Danny Harris
 * Date: 12/10/20
 * File: vehicle_detail.class.php
 * Description:
 */

class VehicleDetail extends VehicleIndexView
{
public function display($vehicle, $confirm = "") {
//display page header
parent::displayHeader('Display Vehicle Details');

//retrieve movie details by calling get methods
$id = $vehicle->getId();
$make = $vehicle->getmake();
$model = $vehicle->getModel();
$year = new DateTime($vehicle->getYear());
$engine_type = $vehicle->getEngineType();
$image = $vehicle->getImage();
$price = $vehicle->getPrice();


//if (strpos($image, "http://") === false AND strpos($image, "https://") === false) {
//    $image = BASE_URL . '/' . VEHICLE_IMG . $image;
//}
?>

    <div id="main-header">Vehicle Details</div>
    <hr>
    <!-- display vehicle details in a table -->
    <table id="detail">
        <tr>
            <td style="width: 150px;">
                <img src="<?= $image ?>" alt="<?= $make ?>" />
            </td>
            <td style="width: 130px;">
                <p><strong>Make:</strong></p>
                <p><strong>Model:</strong></p>
                <p><strong>Year:</strong></p>
                <p><strong>Engine Type:</strong></p>
                <p><strong>Price:</strong></p>
                <div id="button-group">
                    <input type="button" id="edit-button" value="   Edit   "
                           onclick="window.location.href = '<?= BASE_URL ?>/vehicle/edit/<?= $id ?>'">&nbsp;
                </div>
            </td>
            <td>
                <p><?= $make ?></p>
                <p><?= $model ?></p>
                <p><?= $year->format('m-d-Y') ?></p>
                <p><?= $engine_type ?></p>
                <p class="media-description"><?= $price ?></p>
                <div id="confirm-message"><?= $confirm ?></div>
            </td>
        </tr>
    </table>
    <a href="<?= BASE_URL ?>/vehicle/index">Go to vehicle list</a>

    <?php
    //display page footer
    parent::displayFooter();
}
}