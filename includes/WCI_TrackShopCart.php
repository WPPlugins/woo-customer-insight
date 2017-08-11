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

	$dt = new DateTime();
	$date = $dt->format('Y-m-d H:i:s');
	$date_without_time = date('Y-m-d');
	$count = sanitize_text_field( $_REQUEST['count'] );
	$btn_name = sanitize_text_field( $_REQUEST['btn_name'] );
	$wpuser_id = sanitize_text_field( $_REQUEST['user_id'] );
	$user_email = sanitize_text_field( $_REQUEST['user_email'] );
	$page_url = sanitize_text_field( $_REQUEST['page_url'] );
	$http_host = sanitize_text_field( $_REQUEST['http_host'] );
	$country = sanitize_text_field( $_REQUEST['country'] );
	$session_id = sanitize_text_field($_REQUEST['session_id']) ;
        $session_key = sanitize_text_field($_REQUEST['session_key']) ;
        $session_value = sanitize_text_field($_REQUEST['session_value']);
	$prodid = sanitize_text_field( $_REQUEST['prod_id'] );
	global $wpdb;
	$product = $wpdb->get_var($wpdb->prepare("select post_title from ".$wpdb->posts." where ID=%d" , $prodid ));
	
	//Check for user session or guest session
	if( !(strlen( $session_key) >30) ) {
	$wpdb->insert( 'wci_events' , array( 'session_id' => $session_id , 'session_key' => $session_key ,  'user_id' => $wpuser_id, 'user_email' => $user_email , 'user_ip' => $http_host , 'country'=> $country , 'prod_id' => $prodid , 'product' => $product , 'button_name' => $btn_name , 'page_url' => $page_url , 'date' => $date , 'count' => $count , 'date_without_time' => $date_without_time ) , '%s' );

	$wpdb->insert( 'wci_user_session' , array( 'session_id' => $session_id , 'user_id' => $session_key , 'user_name' =>"$wpuser_id" ,'country' => $country, 'is_cart' => '1' , 'product_key' => $prodid ,'product_data'=> $product , 'session_value' => "{$session_value}", 'date' => $date) , array( '%d' , '%s' , '%s' ,'%s', '%d','%d','%s', '%s','%s' ));

		if( $session_id == 0 || $session_id == "" )
                {
                        $id = 0;
                }
                else
                {
                        $id = 1;
                }
                $update_session['id'] = $id;
                $update_session['sess_key'] = $session_key;
                $update_session_array = json_encode( $update_session );
                print_r( $update_session_array );die;
		}
	//Guest session
		else
        	{
                $insert_session['id'] = 11 ; // set 11 for guest to get in js
                $insert_session['count'] = $count;
                $insert_session['btn_name'] = $btn_name;
                $insert_session['wpuser_id'] = $wpuser_id;
                $insert_session['user_email'] = $user_email;
                $insert_session['page_url'] = $page_url;
                $insert_session['http_host'] = $http_host;
                $insert_session['country'] = $country;
                $insert_session['prodid'] = $prodid;
                $insert_session['product'] = $product;
                $insert_session['date'] = $date;
                $insert_session['date_without_time'] = $date_without_time;
                $insert_session_array = json_encode(  $insert_session );
                print_r( $insert_session_array );die;   
        	}
	
