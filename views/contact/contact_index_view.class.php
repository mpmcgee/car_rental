<?php
/**
 * Author: Danny Harris
 * Date: 12/8/20
 * File: contact_index_view.class.php
 * Description:
 */

class ContactIndexView extends IndexView
{
    public static function displayHeader($title) {
        parent::displayHeader($title)
        ?>

        <?php
    }

    public static function displayFooter() {
        parent::displayFooter();
    }
}