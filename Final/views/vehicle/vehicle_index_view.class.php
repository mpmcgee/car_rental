<?php
/**
 * Author: Matthew McGee
 * Date: 11/11/2020
 * File: vehicle_index_view.class.php
 *Description:
 */

class VehicleIndexView extends IndexView{

    public static function displayHeader($title) {
        parent::displayHeader($title)
        ?>
        <script>
            //the media type
            var media = "vehicle";
        </script>
        <!--create the search bar -->
        <div id="searchbar">
            <form method="get" action="<?= BASE_URL ?>/vehicle/search">
                <input type="text" name="query_terms" id="searchtextbox" placeholder="Search Vehicles" autocomplete="off">
                <input type="submit" value="Go"/>
            </form>
            <div id="suggestionDiv"></div>
        </div>
        <?php
    }

    public static function displayFooter() {
        parent::displayFooter();
    }


}