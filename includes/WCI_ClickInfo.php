<?php
/*********************************************************************************
 * Woo Customer Insight helps you to track customer events and journey in your site
 * plugin developed by Smackcoder. Copyright (C) 2016 Smackcoders.
 *
 * Woo Customer Insight is a free software; you can redistribute it and/or
 * modify it under the terms of the GNU Affero General Public License version 3
 * as published by the Free Software Foundation with the addition of the
 * following permission added to Section 15 as permitted in Section 7(a): FOR
 * ANY PART OF THE COVERED WORK IN WHICH THE COPYRIGHT IS OWNED BY Woo Customer 
   Insight, Woo Customer Insight DISCLAIMS THE WARRANTY OF NON
 * INFRINGEMENT OF THIRD PARTY RIGHTS.
 *
 * Woo Customer Insight is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY
 * or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU Affero General Public
 * License for more details.
 *
 * You should have received a copy of the GNU Affero General Public License
 * along with this program; if not, see http://www.gnu.org/licenses or write
 * to the Free Software Foundation, Inc., 51 Franklin Street, Fifth Floor,
 * Boston, MA 02110-1301 USA.
 *
 * You can contact Smackcoders at email address info@smackcoders.com.
 *
 * The interactive user interfaces in original and modified versions
 * of this program must display Appropriate Legal Notices, as required under
 * Section 5 of the GNU Affero General Public License version 3.
 *
 * In accordance with Section 7(b) of the GNU Affero General Public License
 * version 3, these Appropriate Legal Notices must retain the display of the
 * Woo Customer Insight copyright notice. If the display of the logo is
 * not reasonably feasible for technical reasons, the Appropriate Legal
 * Notices must display the words
 * "Copyright Smackcoders. 2016. All rights reserved".
 ********************************************************************************/

if ( ! defined( 'ABSPATH' ) ) {
        exit; // Exit if accessed directly
}

?>

<style>
html,body
{
background-color: #FFFFFF;
}

</style>
<?php

require_once('WCI_ClickClass.php');
echo "<br><br><div id='chart_title'>" .WCI_TITLE. " :: Reports </div>";

 // MENU BAR
        echo "<div class='wp-common-wciwrapper'>";
        $menu_obj = new SM_Woo_Customer_Insight();
        $menu_obj->wci_menubar();
        echo "</div>";

echo "<div class='header_title' style='margin-top:0px;'><h4> " . esc_html('Tracked Events :')." </h4></div>";
$list = new Customer_Button_click_Table();     
        $list->prepare_items();
        echo "<div style='margin-top:10px; width:98%;'>";
        $list->display();
        echo "</div>";
?>
