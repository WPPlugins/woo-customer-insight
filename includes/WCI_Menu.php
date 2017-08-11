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
<nav class='navbar navbar-default' style='background-color:#F1F1F1;width:100%;' role='navigation'>
   <div>
<?php
	global $wpdb;	
        $admin_url = 'admin.php';
	$latest_customer = $wpdb->get_results( "select session_key from wci_activity where length(session_key)<10 order by id desc limit 1" );

	if( !empty( $latest_customer ))
	{	
		$wci_cust = $latest_customer[0]->session_key;
		$customer_stats = add_query_arg( array( 'page' => 'customer_logs' , 'user_id' => $wci_cust ) , $admin_url );
	}
	else
	{
		$customer_stats = add_query_arg( array( 'page' => 'customer_logs') , $admin_url );
	}
        $dashboard = add_query_arg( array( 'page' => 'dashboard' ) , $admin_url );
        $user_payments = add_query_arg( array( 'page' => 'user_payments' ) , $admin_url );
        $reports = add_query_arg( array( 'page' => 'reports') , $admin_url );
?>
      <ul class='nav navbar-nav main_menu' style='width:99%;height:30px;'>

        <li class="<?php if( (sanitize_text_field($_REQUEST['page'])=='dashboard' ) ){ echo 'wci_activate'; }else{ echo 'wci_deactivate'; }?>">

        <a href='<?php echo esc_url( $dashboard ); ?>'><span id='settingstab'> <i style='padding-right:3px;' class="fa fa-tachometer fa-lg " aria-hidden="true"></i>
<?php echo esc_html__("Dashboard" , "woo-customer-insight" ); ?> </span></a>
        </li>
<!-- for third party plugin settings -->
        <li class="<?php if( sanitize_text_field($_REQUEST['page']) =='user_payments' ){ echo 'wci_activate'; }else { echo 'wci_deactivate'; }?>" >
                <a href='<?php echo esc_url( $user_payments ); ?>'><span id='shortcodetab'><i style='padding-right:3px;' class="fa fa-filter fa-lg" aria-hidden="true"></i>
 <?php echo esc_html__("Opportunities" , "woo-customer-insight" ) ; ?></span></a>
        </li>

         <li class="<?php if( (sanitize_text_field($_REQUEST['page'])=='customer_logs' ) ) { echo 'wci_activate'; }else{ echo 'wci_deactivate'; }?>">
                <a href='<?php echo esc_url( $customer_stats ) ?>'><span id='settingstab'> <i style='padding-right:3px;' class="fa fa-bar-chart fa-lg " aria-hidden="true"></i><?php echo esc_html__("Customer Stats" , "woo-customer-insight" ); ?> </span></a>
        </li>

        <li class="<?php if( sanitize_text_field($_REQUEST['page']) =='reports' ) { echo 'wci_activate'; }else{ echo 'wci_deactivate'; }?>">
                <a href='<?php echo esc_url( $reports ) ?>'><span id='settingstab'><i style='padding-right:3px;' class="fa fa-clipboard fa-lg " aria-hidden="true"></i><?php echo esc_html__('Reports' , "woo-customer-insight" ); ?> </span></a>
        </li>

      </ul>
   </div>
</nav>

