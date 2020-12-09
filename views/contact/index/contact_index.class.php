<?php
/**
 * Author: Danny Harris
 * Date: 12/8/20
 * File: contact_index.class.php
 * Description:
 */

class ContactIndex extends ContactIndexView
{
    public function display() {
        parent::displayHeader('Contacts')
        ?>

        <h2>X Car Rental Contacts</h2>

        <table>
            <tr>
                <th>School</th>
                <th>Name</th>
                <th>Email</th>
            </tr>
            <tr>
                <td>IUPUI</td>
                <td>Danny Harris</td>
                <td>dannharr@iu.edu</td>
            </tr>
            <tr>
                <td>IUPUI</td>
                <td>Matthew McGee</td>
                <td>mpmcgee@iu.edu</td>
            </tr>
            <tr>
                <td>IUPUI</td>
                <td>Coltin Epsich</td>
                <td>cespich@iu.edu</td>
            </tr>
        </table>
        <?php



        parent::displayFooter();

    }

}