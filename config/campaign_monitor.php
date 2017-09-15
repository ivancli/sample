<?php
/**
 * Created by PhpStorm.
 * User: ivan.li
 * Date: 14/09/2017
 * Time: 1:58 PM
 */

define('CS_REST_CALL_TIMEOUT', 300);

return [
    "api_key" => env("CAMPAIGN_MONITOR_API_KEY"),
    "client_id" => env("CAMPAIGN_MONITOR_CLIENT_ID"),
    "list_id" => env("CAMPAIGN_MONITOR_LIST_ID"),
    "reset_password_email_id" => env("CAMPAIGN_MONITOR_RESET_PASSWORD_EMAIL_ID"),
];