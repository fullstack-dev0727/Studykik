<?php
/*
Plugin Name: custom-invoice
Plugin URI: http://studykik.com
Description: edit shopping cart
Version: 1.0
Author: Dmitry
Author URI: http://studykik.com
License: GPL2
*/

/*
Copyright YEAR  PLUGIN_AUTHOR_NAME  (email : test@mail.com)

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License, version 2, as
published by the Free Software Foundation.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

// Exit if accessed directly
if (!defined('ABSPATH')) exit;

if (!class_exists('customInvoice')) {

    class customInvoice
    {

        /**
         * @var customInvoice $instance The one true customInvoice
         */
        private static $instance;

        /**
         * Get active instance
         *
         * @access public
         * @return object self::$instance The one true customInvoice
         */
        public static function instance()
        {
            if (!self::$instance) {
                self::$instance = new customInvoice();
                self::$instance->hooks();
            }

            return self::$instance;
        }


        /**
         * Run action and filter hooks
         *
         * @access public
         * @return void
         */
        public function hooks()
        {
            // Add menu item
            add_action('admin_menu', array(&$this, 'add_custom_invoice_menu'));
        }

        /**
         * Add menu item for custom-invoice
         *
         * @access public
         * @return void
         */
        public function add_custom_invoice_menu()
        {
            if (function_exists('add_options_page')) {
                add_submenu_page(
                    'users.php',
                    __('Backend Checkout', 'custom-invoice'),
                    __('Backend Checkout', 'custom-invoice'),
                    'edit_users',
                    'custom-invoice',
                    array(&$this, 'addCustomInvoice')
                );
            }
        }

        /**
         *
         * @access public
         * @return bool
         */
        public function customInvoicePageOptions()
        {
            return false;
        }

        /**
         * Add custom invoice page
         *
         * @access public
         * @return void
         */
        public function addCustomInvoice()
        {
            get_template_part('custom-invoice');
        }

        /**
         *
         * @access public
         * @param $data
         * @return mixed
         */
        public function saveDraft($data)
        {
            $date = date('Y-m-d H:i:s');
            mysql_query(
                "INSERT INTO `0gf1ba_custom_invoice`
                (
                    `user_id`,
                    `data`,
                    `is_paid`,
                    `total`,
                    `last_modify`,
                    `paid`
                )
                VALUES
                (
                    '".mysql_real_escape_string($data['user_id'])."',
                    '".$data['data']."',
                    0,
                    '".mysql_real_escape_string($data['total'])."',
                    '".mysql_real_escape_string($date)."',
                    ''
                )"
            );

            $query = mysql_query("SELECT * FROM `0gf1ba_custom_invoice` WHERE `user_id` = '".mysql_real_escape_string($data['user_id'])."' AND `total` = '".mysql_real_escape_string($data['total'])."' AND `last_modify` = '".mysql_real_escape_string($date)."' LIMIT 1;");
            $result = mysql_fetch_array($query);

            echo(json_encode($result));
        }

        /**
         *
         * @access public
         * @param $data
         * @return resource
         */
        public function updateDraft($data)
        {
            $date = date('Y-m-d H:i:s');
            mysql_query("UPDATE `0gf1ba_custom_invoice` SET `data`= '".$data['data']."', `is_paid`= 0, `total`='".mysql_real_escape_string($data['total'])."', `last_modify`='".mysql_real_escape_string($date)."', `paid`='' WHERE `id` = '".mysql_real_escape_string($data['draft_id'])."';");

            $query = mysql_query("SELECT * FROM `0gf1ba_custom_invoice` WHERE `id` = '".mysql_real_escape_string($data['draft_id'])."' AND `total` = '".mysql_real_escape_string($data['total'])."' AND `last_modify` = '".mysql_real_escape_string($date)."' LIMIT 1;");
            $result = mysql_fetch_array($query);

            echo(json_encode($result));
        }

        /**
         * @access public
         * @param $data
         */
        public function emulateRefund($data)
        {
            $date = date('Y-m-d H:i:s');
            mysql_query("UPDATE `0gf1ba_custom_invoice` SET `refund`= '".mysql_real_escape_string($date)."' WHERE `id` = '".mysql_real_escape_string($data['draft_id'])."';");
        }

        /**
         *
         * @access public
         * @param $id
         * @return resource
         */
        public function getDraft($id)
        {
            $query = mysql_query( "SELECT * FROM `0gf1ba_custom_invoice` WHERE `user_id` = ".mysql_real_escape_string($id).";" );
            return $query;
        }

        /**
         *
         * @access public
         * @param $id
         * @return resource
         */
        public function getCurDraft($id)
        {
            $query = mysql_query( "SELECT * FROM `0gf1ba_custom_invoice` WHERE `id` = ".mysql_real_escape_string($id).";" );
            return $query;
        }

        /**
         *
         * @access public
         * @param $data
         * @return resource
         */
        public function emulatePaymentSubmit($data)
        {
            $date = date('Y-m-d H:i:s');
            mysql_query("UPDATE `0gf1ba_custom_invoice` SET `is_paid`= 1, `last_modify`='".mysql_real_escape_string($date)."', `paid`= '".mysql_real_escape_string($date)."' WHERE `id` = '".mysql_real_escape_string($data['draft_id'])."';");
            $query = mysql_query("SELECT * FROM `0gf1ba_custom_invoice` WHERE `id` = '".mysql_real_escape_string($data['draft_id'])."' AND `paid` = '".mysql_real_escape_string($date)."' AND `last_modify` = '".mysql_real_escape_string($date)."' LIMIT 1;");
            $result = mysql_fetch_array($query);

            echo(json_encode($result));
        }
    }
}

/**
 * The main function responsible for returning the one true customInvoice
 * instance to functions everywhere
 *
 * @return customInvoice The one true customInvoice
 */
function customInvoice_load()
{
    return customInvoice::instance();
}

add_action('plugins_loaded', 'customInvoice_load');