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

	$session_key = sanitize_text_field( $_REQUEST['sess_key'] );
	global $wpdb;
	$get_session_id = $wpdb->get_results( $wpdb->prepare( "select session_id from {$wpdb->prefix}woocommerce_sessions where session_key=%s" , $session_key ) );
	$session_id = $get_session_id[0]->session_id;
	if( !empty( $session_id ))
	{
		$wpdb->update( 'wci_user_session' ,
				array( 'session_id' => $session_id ),
				array( 'user_id' => $session_key,
				       'session_id' => '0'	
			   	     )
				 );

		$wpdb->update( 'wci_events' ,
                                array( 'session_id' => $session_id ),
                                array( 'session_key' => $session_key,
                                       'session_id' => '0'
                                     )
                                 );
		$wpdb->update( 'wci_activity' ,
                                array( 'session_id' => $session_id ),
                                array( 'session_key' => $session_key,
                                       'session_id' => '0'
                                     )
                                 );


	}	
die;		
?>
