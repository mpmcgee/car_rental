<?php
/**
 * Author: Matthew McGee
 * Date: 12/6/2020
 * File: booking_add.class.php
 *Description:
 */

class BookingAdd extends BookingIndexView {
//call the header method defined in the parent class to add the header

    public function display(){
        parent::displayHeader("Create Booking");
        ?>
        <!-- page specific content starts -->
        <!-- top row for the page header  -->
        <div class="top-row">CREATE A Booking</div>
        <div class="header">
            <h3>Please complete the entire form. All fields required.</h3>
        </div>
        <!-- middle row -->
        <div class="middle-row">
            <form method="POST" action="<?= BASE_URL ?>/booking/add">
                <p>
                    <input id="firstname" value="" name="name" type="text" required="required" placeholder="First name"/>
                    <br>
                </p>
                <p>
                    <input id="lastname" value="" name="lastname" type="text" required="required" placeholder="Last name"/>
                    <br>
                </p>

                </p>
                <p>

                    <input id="start-date" value="" name="firstname" type="date" required="required"/>
                    <br>
                </p>
                <p>
                    <input id="end-date" value="" name="lastname" type="date" required="required"/>
                    <br>
                </p>

                <p>
                    <label for="class">Vehicle Class:</label>
                    <Select id="class" value="" name="class" required="required" placeholder="Vehicle Id"/>
                    <optgroup label="Car">
                        <option value="compact">Compact</option>
                        <option value="midsize">Midsize</option>
                        <option value="fullsize">Full-size</option
                        <option value="luxury">Luxury</option>
                        <option value="sports">Sports</option>
                        <option value="exotic">Exotic</option>
                    </optgroup>

                    <optgroup label="SUV">
                        <option value="compact">Compact</option>
                        <option value="intermediate">Midsize</option>
                        <option value="fullsize">Full-Size</option
                    </optgroup>

                    <optgroup label="Van">
                    <option value="minivan">Minivan</option>
                    <option value="pasengervan">Passenger Van</option>
                    </optgroup>

                    <optgroup label="Truck">
                        <option value="smallpickup">Small Pickup</option>
                        <option value="fullpickup">Full-Size Pickup</option>
                    </optgroup>
                </select>
                </p>

                <div id="suggestionDiv"></div>
                    <br>
                    <br>
                    <button type="submit" style="width: 560px; background-color: #333333; height: 50px; color: white"><span>Create Booking</span></button>

            </form>
        </div>
        <hr>
        <?php
        //call the footer method defined in the parent class to add the footer
        parent::displayFooter();
    }
}
