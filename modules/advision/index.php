<?php
$Module = $Params['Module'];
$xrowAdVisionINI = eZINI::instance( 'xrowadvision.ini' );
if ( ! isset( $_GET['keyword'] ) )
{
    $nodeString = "";
}
else
{
    $nodeString = "&amp;keyword=" . (int) $_GET['keyword'];
}
if ( eZSys::isSSLNow() )
{
    $PROTO = "https";
}
else
{
    $PROTO = "http";
}
$content = '<!DOCTYPE html><html><head>';
$content .= "<script type=\"text/javascript\" src=\"" . '//imagesrv.adition.com/js/adition.js' . "\" ></script>";
$content .= "</head><body>";
$content .= "<script type='text/javascript' src='" . $xrowAdVisionINI->variable( 'AdserverSettings', 'AdserverURL' ) . "/js?wp_id=" . (int) $_GET['id'] . $nodeString . "' ></script>";
$content .= '</body></html>';
// Set header settings
header( 'Content-Type: text/html; charset=UTF-8' );
header( 'Content-Length: ' . strlen( $content ) );
header( 'Last-Modified: ' . gmdate( 'D, d M Y H:i:s' ) . ' GMT' );
header( 'Cache-Control: cache, public' );
header( 'Pragma: ' );

while ( @ob_end_clean() );

echo $content;

eZExecution::cleanExit();