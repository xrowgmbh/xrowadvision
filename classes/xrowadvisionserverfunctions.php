<?php

/*
 * Some xrowadvisionServerFunctions
 */

class xrowadvisionServerFunctions extends ezjscServerFunctions
{

    public static function javascript()
    {
        $tmp_access = eZSiteAccess::current();
        $CurrentSiteaccess = $tmp_access["name"];
        $DisabledSiteaccessList = eZINI::instance( "xrowadvision.ini" )->variable( 'AdserverSettings', 'DisabledSiteaccessList' );
        if ( ! in_array( $CurrentSiteaccess, $DisabledSiteaccessList ) )
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
        }
        else
        {
            $flContent = "";
            eZDebug::writeDebug( "Ads for siteaccess $CurrentSiteaccess disabled", "xrowadvision.ini" );
        }
        return $flContent;
    }
}