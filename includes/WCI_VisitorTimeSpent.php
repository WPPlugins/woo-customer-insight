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

	$button_name = sanitize_text_field( $_POST['button_name'] );
	$wpuser_id = sanitize_text_field( $_REQUEST['user_id'] );
	$user_email = sanitize_text_field( $_REQUEST['user_email'] );
	$page_url = sanitize_text_field( $_REQUEST['page_url'] );
	$timespent = sanitize_text_field( $_REQUEST['postdata'] );
	$http_host = sanitize_text_field( $_REQUEST['http_host'] );
	$country = sanitize_text_field( $_REQUEST['country'] );
	$page_id = sanitize_text_field( $_REQUEST['page_id'] );
	$page_title = sanitize_text_field( $_REQUEST['page_title'] );
	$is_user = sanitize_text_field( $_REQUEST['is_user'] );
	$dt = new DateTime();
	$date = $dt->format('Y-m-d');
	$date_and_time = $dt->format('Y-m-d h:i:s A');

	$session_id = sanitize_text_field( $_REQUEST['session_id'] );
	$session_key = sanitize_text_field( $_REQUEST['session_key'] );
	$user_arr = array("session_id" => $session_id, "session_key" => $session_key, "prodid" => $page_id ,"page" => $page_url , "page_title" => $page_title , "userip" => $http_host , "country" => $country, "timespent" => $timespent, "date_time" => $date_and_time );
	$info = serialize($user_arr);
	global $wpdb;
	
	if( isset( $is_user) )
	{
		$check_sess_id = $wpdb->get_results( $wpdb->prepare( "select session_id from {$wpdb->prefix}woocommerce_sessions where session_key=%s" , $session_key ) );
		if( !empty( $check_sess_id ))
		{
			$session_id = $check_sess_id[0]->session_id;
			$wpdb->update( 'wci_activity' , 
				array( 'session_id' => $session_id ), 
				array( 'session_key' => $session_key ,
				       'session_id' => '0'	
				     )
				);
		}
	}

		$wpdb->insert( 'wci_activity' , 																array( 'session_id' => $session_id , 
				'session_key' => $session_key , 
				'user_id' => $wpuser_id , 
				'user_email' => $user_email , 
				'is_user' => $is_user , 
				'user_ip' => $http_host , 
				'country' => $country , 
				'date' => $date , 
				'information' => $info , 
				'visited_url' => $page_url , 
				'page_title' => $page_title  , 
				'page_id' => $page_id ,
				'spent_time' => $timespent , 
				'clicked_button' => $button_name , 
				'date_time' => $date_and_time) ,
			array( '%d' , '%s' , '%s' , '%s' , '%d' , '%s' , '%s' , '%s' , '%s' , '%s' , '%s' , '%d' ,'%d' , '%s' , '%s' )
		);

