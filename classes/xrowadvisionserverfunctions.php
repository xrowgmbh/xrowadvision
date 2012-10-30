<?php

/*
 * Some xrowadvisionServerFunctions
 */

class xrowadvisionServerFunctions extends ezjscServerFunctions
{
    public static function javascript()
    {
        // get the content of the js
        $url = "http://imagesrv.adition.com/js/adition.js";
        if ( function_exists( 'curl_init' ) )
        {
            $ch = curl_init();
            curl_setopt( $ch, CURLOPT_URL, $url );
            curl_setopt( $ch, CURLOPT_HEADER, 0 );
            curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );
            curl_setopt( $ch, CURLOPT_TIMEOUT, 10 );
            $flContent = curl_exec( $ch );
            $info = curl_getinfo( $ch );

            if ( $info['http_code'] != 200 )
            {
                $spcjsContent = false;
                eZDebug::writeError( "Adserver URL ($url) is not avialable ", __METHOD__ );
            }
            curl_close( $ch );
            eZDebug::writeDebug( "Adserver URL ($url) included", __METHOD__ );
        }
        else
        {
            $flContent = file_get_contents( $url );
            eZDebug::writeDebug( "Adserver URL ($url) included", __METHOD__ );
        }
        return $flContent;
    }
}