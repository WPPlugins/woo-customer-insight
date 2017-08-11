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

	$count = sanitize_text_field( $_REQUEST['count'] );
	$btn_name = sanitize_text_field( $_REQUEST['btn_name'] );
	$page_url = sanitize_text_field( $_REQUEST['page_url'] );
	$http_host = sanitize_text_field( $_REQUEST['http_host'] );
	$country = sanitize_text_field( $_REQUEST['country'] );
	$user_name = sanitize_text_field( $_REQUEST['user_id'] );
	$user_email = sanitize_text_field( $_REQUEST['user_email'] );
	$prodid = sanitize_text_field( $_REQUEST['prod_id'] );
	$product = sanitize_text_field( $_REQUEST['product'] );
	$date = sanitize_text_field( $_REQUEST['date'] );
	$date_without_time = sanitize_text_field( $_REQUEST['date_without_time'] );
	$WC_session_obj = new WC_Session_Handler();
	$get_cookie_details = $WC_session_obj->get_session_cookie();
                $session_key = $get_cookie_details[0];
	global $wpdb;
	$last_guest_id = $wpdb->get_results( $wpdb->prepare( "select * from {$wpdb->prefix}woocommerce_sessions where session_key=%s" , $session_key ) );
	$guest_session_key = $last_guest_id[0]->session_key;
	$guest_session_id = $last_guest_id[0]->session_id;
	$guest_session_value = $last_guest_id[0]->session_value;

	$wpdb->insert( 'wci_events' , array( 'session_id' => $guest_session_id , 'session_key' => $guest_session_key ,  'user_id' => $user_name, 'user_email' => $user_email , 'user_ip' => $http_host , 'country'=> $country , 'prod_id' => $prodid , 'product' => $product , 'button_name' => $btn_name , 'page_url' => $page_url , 'date' => $date , 'count' => $count , 'date_without_time' => $date_without_time ) , '%s' );

        $wpdb->insert( 'wci_user_session' , array( 'session_id' => $guest_session_id , 'user_id' => $guest_session_key , 'user_name' =>"$user_name" , 'country' => $country ,'is_cart' => '1' , 'product_key' => $prodid , 'product_data' => $product , 'session_value' => "{$guest_session_value}" , 'date' => $date) , array( '%d' , '%s' , '%s' , '%s' , '%d' , '%d' , '%s' , '%s' , '%s' ));

die;

?>
