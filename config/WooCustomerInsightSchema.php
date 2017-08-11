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


class WooCustomerInsightSchema {

	public function generate_tables() {
		global $wpdb;
		$woo_customer_insight_info =  "CREATE TABLE IF NOT EXISTS wci_activity (
			id int(20) NOT NULL AUTO_INCREMENT,
			session_id int(20) NOT NULL,
			session_key varchar(200) NOT NULL,
			user_id  varchar(200) DEFAULT NULL,
			user_email varchar(200) DEFAULT NULL,
			is_user int(10) DEFAULT NULL,
			user_ip varchar(30) DEFAULT NULL,
			country varchar(200) DEFAULT NULL,
			date date DEFAULT NULL,
			information LONGBLOB DEFAULT NULL,
			visited_url LONGBLOB DEFAULT NULL,
			page_id int(20) DEFAULT NULL,
			page_title varchar(200) DEFAULT NULL,
			spent_time int(20) DEFAULT NULL,
			clicked_button varchar(100) DEFAULT NULL,
			date_time datetime DEFAULT NULL,
			PRIMARY KEY (id)
			   ) ENGINE=InnoDB;";
		$wpdb->query($woo_customer_insight_info);

		$create_btn_click_table =  "CREATE TABLE IF NOT EXISTS wci_events (
			id int(20) NOT NULL AUTO_INCREMENT,
			session_id int(20) NOT NULL,
			session_key varchar(200) NOT NULL,
			user_id varchar(200) DEFAULT NULL,
			user_email varchar(200) DEFAULT NULL,
			user_ip varchar(40) DEFAULT NULL,
			country varchar(100) DEFAULT NULL,
			prod_id int(20) DEFAULT NULL,
			product LONGBLOB DEFAULT NULL,
			button_name varchar(100) DEFAULT NULL,
			page_url LONGBLOB DEFAULT NULL,
			date datetime DEFAULT '0000-00-00 00-00-00',
			count int(30) DEFAULT NULL,
			date_without_time date DEFAULT NULL,
			PRIMARY KEY (id)
			   ) ENGINE=InnoDB;";
		$wpdb->query($create_btn_click_table);

		$create_usr_profile =  "CREATE TABLE IF NOT EXISTS wci_history (
			id int(20) NOT NULL AUTO_INCREMENT,
			user_id int(30) DEFAULT NULL,
			user_name varchar(200) DEFAULT NULL,
			email varchar(200) DEFAULT NULL,
			date datetime DEFAULT '0000-00-00 00-00-00',
			role varchar(100) DEFAULT NULL,
			login_time datetime DEFAULT '0000-00-00 00-00-00',
			logout_time datetime DEFAULT '0000-00-00 00-00-00',
			status varchar(100) DEFAULT NULL,
			PRIMARY KEY (id)
			   ) ENGINE=InnoDB;";
		$wpdb->query($create_usr_profile);

		$wci_user_purchased_history =  "CREATE TABLE IF NOT EXISTS wci_user_purchased_history (
			id int(20) NOT NULL AUTO_INCREMENT,
			user_ip varchar(30) DEFAULT NULL,
			user_id varchar(20) DEFAULT NULL,
			user_email varchar(100) DEFAULT NULL,
			product_id int(50) DEFAULT NULL,
			product_name varchar(200) DEFAULT NULL,
			PRIMARY KEY (id)
			   ) ENGINE=InnoDB;";
		$wpdb->query($wci_user_purchased_history);

		$wci_create_usr_profile_updated =  "CREATE TABLE IF NOT EXISTS wci_user_profile_updated (
                        id int(20) NOT NULL AUTO_INCREMENT,
                           user_id int(20) UNIQUE NOT NULL,
                           user_name varchar(200) DEFAULT NULL,
                           email varchar(200) DEFAULT NULL,
                           date datetime DEFAULT '0000-00-00 00-00-00',
                           role varchar(30) DEFAULT NULL,
                           login_time datetime DEFAULT '0000-00-00 00-00-00',
                           logout_time datetime DEFAULT '0000-00-00 00-00-00',
                           PRIMARY KEY (id)
                                   ) ENGINE=InnoDB;";
                $wpdb->query( $wci_create_usr_profile_updated );


		$wci_abandon_cart =  "CREATE TABLE IF NOT EXISTS wci_abandon_cart (
			id int(20) NOT NULL AUTO_INCREMENT,
			user_email varchar(100) NOT NULL,
			order_id int(30) UNIQUE NOT NULL,
			date datetime DEFAULT NULL,
			time_difference int(30) DEFAULT NULL,
			PRIMARY KEY (id)
			   ) ENGINE=InnoDB;";
		$wpdb->query($wci_abandon_cart);

		$wci_successful_purchases =  "CREATE TABLE IF NOT EXISTS wci_successful_purchases (
			id int(20) NOT NULL AUTO_INCREMENT,
			user_name varchar(200) NOT NULL,
			user_email varchar(200) NOT NULL,
			order_id int(30) UNIQUE NOT NULL,
			order_status varchar(30) NOT NULL,
			date datetime DEFAULT NULL,
			products LONGBLOB DEFAULT NULL,
			coupon_code varchar(100) DEFAULT NULL,
			coupon_amount varchar(100) DEFAULT NULL,
			total_price int(30) DEFAULT NULL,
			discount_type varchar(100) DEFAULT NULL,
			PRIMARY KEY (id)
			   ) ENGINE=InnoDB;";
		$wpdb->query($wci_successful_purchases);
	
		$wci_user_session =  "CREATE TABLE IF NOT EXISTS wci_user_session (
                        id int(40) NOT NULL AUTO_INCREMENT,
                        session_id int(20) NOT NULL,
			user_id varchar(200) NOT NULL,
			user_name varchar(200) NOT NULL,
			country varchar(100) NOT NULL,
			is_cart int(10) NOT NULL,
                        product_key varchar(200) NOT NULL,
			product_data LONGBLOB DEFAULT NULL,
                        is_checkout int(10) NOT NULL,
                        is_payment int(10) NOT NULL,
			order_id int(30) NOT NULL,
                        payment_success int(20) NOT NULL,
                        payment_failure int(20) NOT NULL,
                        session_value LONGBLOB DEFAULT NULL,
			date datetime DEFAULT '0000-00-00 00-00-00',
                        PRIMARY KEY (id)
                           ) ENGINE=InnoDB;";
                $wpdb->query($wci_user_session);
			
	}

}
