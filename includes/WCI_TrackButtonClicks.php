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


	$count = intval( $_REQUEST['count'] );
	$btn_name = sanitize_text_field( $_REQUEST['btn_name'] );
	$wpuser_id = sanitize_text_field( $_REQUEST['user_id'] );
	$user_email = sanitize_text_field( $_REQUEST['user_email'] );
	$page_url = sanitize_text_field( $_REQUEST['page_url'] );
	$http_host = sanitize_text_field( $_REQUEST['http_host'] );
	$country = sanitize_text_field( $_REQUEST['country'] );
	$prodid = intval( $_REQUEST['prod_id'] ) ;
	$session_id = sanitize_text_field( $_REQUEST['session_id'] );
	$session_key = sanitize_text_field( $_REQUEST['session_key'] ) ;
	$session_value = sanitize_text_field( $_REQUEST['session_value'] );
	$prod = sanitize_text_field( $_REQUEST['product'] );

	switch( $btn_name )
	{
		case 'Checkout':
		$Checkout = "1" ;
		break;		

		case 'CashOnDelivery':
		$Payment = "1";
		break;

		case 'ProceedToPaypal':
		$Payment = "1";
		break;

		case 'DirectBankTransfer':
		$Payment = "1";
		break;

		case 'ChequePayment':
		$Payment = "1";
		break;

	}
	$prod = str_replace('\\','',$prod);
	$pro = json_decode($prod);
	$dt = new DateTime();
	$date = $dt->format('Y-m-d H:i:s' );
	$date_without_time = date('Y-m-d');
	global $wpdb;
	foreach($pro as $key=>$product)
	{
		$products .= $product.',';
	}
		$product_list = rtrim( $products , "," );
		$wpdb->insert( 'wci_events' , array( 'session_id' => $session_id , 'session_key' => $session_key , 'user_id'=> $wpuser_id , 'user_email' => $user_email , 'user_ip' => $http_host, 'country' => $country, 'prod_id' => $prodid, 'product' => $product_list, 'button_name' => $btn_name, 'page_url' => $page_url, 'date' => $date, 'count' => $count, 'date_without_time' => $date_without_time ), '%s' );	

		if( !empty( $Checkout ) ) 
		{
			$wpdb->insert( 'wci_user_session' , array( 'session_id' => $session_id , 'user_id' => $session_key , 'user_name' =>$wpuser_id , 'country' => $country , 'product_data' => $product_list , 'is_checkout' => $Checkout , 'session_value' => "{$session_value}" , 'date' => $date), array( '%d' , '%s' , '%s' ,'%s', '%s', '%d' , '%s','%s' ) );
		}
	
		if( !empty( $Payment ) )	
		{
			$wpdb->insert( 'wci_user_session' , array( 'session_id' => $session_id , 'user_id' => $session_key , 'user_name' =>$wpuser_id , 'country' => $country , 'product_data' => $product_list ,'is_payment' => $Payment , 'session_value' => "{$session_value}", 'date' => $date) , array( '%d' , '%s' , '%s' ,'%s', '%s', '%d' , '%s','%s' ) );
		}
		
