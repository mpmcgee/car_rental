<?php
/**
 * Author: Matthew McGee
 * Date: 11/9/2020
 * File: booking_index_view.class.php
 *Description:
 */

class BookingIndexView extends IndexView{

    public static function displayHeader($title) {
        parent::displayHeader($title)
        ?>
        <script>
            //the media type
            var media = "booking";
        </script>
        <!--create the search bar -->
        <div id="searchbar">
            <form method="get" action="<?= BASE_URL ?>/book/search">
                <input type="text" name="query-terms" id="searchtextbox" placeholder="Search books by title" autocomplete="off">
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