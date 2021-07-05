<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function calculate_signature($string, $private_key) {
        $hash = hash_hmac("sha1", $string, $private_key, true);
        $sig = rawurlencode(base64_encode($hash));
        return $sig;
    }

    public function functionName()
    {
        $api_key = "49a24cb3c6";
        $private_key = "f0d6b12de819c0f";
        $method  = "GET";
        $route    = "forms/1/entries";
        $expires = strtotime("+60 mins");
        $string_to_sign = sprintf("%s:%s:%s:%s", $api_key, $method, $route, $expires);
        $sig = $this->calculate_signature($string_to_sign, $private_key);
        // http://prado.test/gravityformsapi/forms/25?api_key=49a24cb3c6&signature=PueNOtbfUe%2BMfClAOi2lfq%2BHLyo%3D&expires=1369749344
        return($sig);
    }
    public function functionName2()
    {
        $api_key = "49a24cb3c6";
        $private_key = "f0d6b12de819c0f";
        
        //set route
        $route = 'forms';
        
        //creating request URL
        $expires = strtotime( '+60 mins' );
        $string_to_sign = sprintf( '%s:%s:%s:%s', $api_key, 'GET', $route, $expires );
        $sig = $this->calculate_signature( $string_to_sign, $private_key );
        $url = 'http://localhost/wp/gravityformsapi/' . $route . '?api_key=' . $api_key . '&signature=' . $sig . '&expires=' . $expires;
        return $url;
        
        //retrieve data
        // $response = wp_remote_request( urlencode( $url ), array( 'method' => 'GET' ) );
        // if ( wp_remote_retrieve_response_code( $response ) != 200 || ( empty( wp_remote_retrieve_body( $response ) ) ) ){
        //     //http request failed
        //     die( 'There was an error attempting to access the API.' );
        // }
        
        //result is in the response "body" and is json encoded.
        $body = json_decode( wp_remote_retrieve_body( $response ), true );
        
        if( $body['status'] > 202 ){
            die( "Could not retrieve forms." );
        }
        
        //forms retrieved successfully
        $forms = $body['response'];
        
        //To access each form, loop through the $forms array.
        foreach ( $forms as $form ){
            $form_id     = $form['id'];
            $form_title  = $form['title'];
            $entry_count = $form['entries'];
        }
    }
     
    
}
