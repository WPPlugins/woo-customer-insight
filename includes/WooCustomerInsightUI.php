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

class WooCustomerInsightUI {

	public static function wci_dashboard_widget() {
		wp_add_dashboard_widget(
				'wootracking_info',
				'Woo Tracking Report',
				array('WooCustomerInsightUI', 'my_dashboard_widget_display')
		);
	}

	public static function my_dashboard_widget_display() {
		$widget = "<label for='to_date'>Pick Date</label>&nbsp;&nbsp;<input type='text' id='dashboard_date' class='datepicker' value=".date('Y-m-d')."  placeholder='enter the to date' />
<input type='button' class=\"btn btn-primary\" id='dashbord_date_submit' value='Go' onClick=\"window.location.reload()\" />
<div id='d3-dashboard-chart'>
<div id='wootracking_dashboard_chart' style='width:450px;height:300px;padding:10px; auto;'></div></div>
";
		echo $widget;
	}

	public function WCI_init() {
                require_once( 'WCI_HomePage.php' );
        }
	
	public function WCI_ClickInfo() {
		require_once( 'WCI_ClickInfo.php' );
	}

	public function WCI_CustomerLogs() {
		require_once( 'WCI_CustomerLogs.php' );
	}

	public function WCI_StageUsers() {
		require_once( 'WCI_StageUsers.php' );
	}

}

add_action('wp_dashboard_setup', array('WooCustomerInsightUI', 'wci_dashboard_widget'));
