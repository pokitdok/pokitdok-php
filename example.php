<?php
/**
 * Copyright (c) 2014 PokitDok Inc. See LICENSE.txt for details.
 *
 * Author: timdunlevy
 * Date: 4/24/14
 * Time: 9:55 PM
 */

require_once 'vendor/autoload.php';
// If not using composer remove previous line and uncomment following two lines
//require_once 'src/PokitDok/Common/Oauth2ApplicationClient.php';
//require_once 'src/PokitDok/Platform/PlatformClient.php';

use PokitDok\Platform\PlatformClient;

// Change to your PokitDok Platform API Client ID and Secret:
//      Go to https://platform.pokitdok.com to get your API key
define("POKITDOK_PLATFORM_API_CLIENT_ID", 'your client id');
define("POKITDOK_PLATFORM_API_CLIENT_SECRET", 'your client secret');



try {

    $client = new PlatformClient(POKITDOK_PLATFORM_API_CLIENT_ID, POKITDOK_PLATFORM_API_CLIENT_SECRET);

// For internal testing only
//    define("POKITDOK_PLATFORM_API_CLIENT_ID", 'x');
//    define("POKITDOK_PLATFORM_API_CLIENT_SECRET", 'y');
//    define("POKITDOK_PLATFORM_API_SITE", 'http://me.pokitdok.com:5002');
//    $client->setApiBaseUrl(
//        POKITDOK_PLATFORM_API_SITE .
//        PlatformClient::POKITDOK_PLATFORM_API_VERSION_PATH);
//    $client->setApiTokenUrl(
//        POKITDOK_PLATFORM_API_SITE .
//        PlatformClient::POKITDOK_PLATFORM_API_TOKEN_URL
//    );
// end internal testing only

    echo "Usage: ". print_r($client->usage(), true) . PHP_EOL;

    $providers_response = $client->providers(array('state' => 'CA'));
    echo "Providers Response Headers: ".
        print_r($providers_response->header(), true) .
        PHP_EOL;
    echo "Providers Response Body: ".
        print_r($providers_response->body(), true) .
        PHP_EOL;

    echo "Eligibility Response: ".
        print_r(
            $client->eligibility(
                array(
                    'payer_id' => "MOCKPAYER",
                    'member_id' => "W34237875729",
                    'provider_id' => "1467560003",
                    'provider_name' => "AYA-AY",
                    'provider_first_name' => "JEROME",
                    'provider_type' => "Person",
                    'member_name' => "JOHN DOE",
                    'member_birth_date' => "05/21/1975",
                    'service_types' => array("Health Benefit Plan Coverage")
                )
            )->body(),
            true
        ) .
        PHP_EOL;

} catch (\Exception $e) {
    echo "Exception (". $e->getCode() ."): ". $e->getMessage();
}
