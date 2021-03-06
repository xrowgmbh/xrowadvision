<?php

class xrowadvisionOperator
{

    function operatorList()
    {
        return array( 
            'advision_show' 
        );
    }

    function namedParameterPerOperator()
    {
        return true;
    }

    function namedParameterList()
    {
        return array( 
            'advision_show' => array( 
                'type' => array( 
                    'type' => 'string' , 
                    'required' => true , 
                    'default' => '' 
                ) , 
                'position' => array( 
                    'type' => 'integer' , 
                    'required' => false , 
                    'default' => 3 
                ) , 
                'heading' => array( 
                    'type' => 'string' , 
                    'required' => false , 
                    'default' => '' 
                ) , 
                'node_id' => array( 
                    'type' => 'integer' , 
                    'required' => false , 
                    'default' => 2 
                ) , 
                'zone_override_id' => array( 
                    'type' => 'integer' , 
                    'required' => false , 
                    'default' => 0 
                ) 
            ) 
        );
    }

    function modify( $tpl, $operatorName, $operatorParameters, &$rootNamespace, &$currentNamespace, &$operatorValue, &$namedParameters )
    {
        switch ( $operatorName )
        {
            case 'advision_show':
                {
                    $tmp_access = eZSiteAccess::current();
                    $CurrentSiteaccess = $tmp_access["name"];
                    $DisabledSiteaccessList = eZINI::instance( "xrowadvision.ini" )->variable( 'AdserverSettings', 'DisabledSiteaccessList' );
                    if ( ! in_array( $CurrentSiteaccess, $DisabledSiteaccessList ) )
                    {
                        if( $namedParameters['node_id'] instanceof eZContentObjectTreeNode )
                            $NodeID = (string)$namedParameters['node_id']->NodeID;
                        else
                            $NodeID = (string)$namedParameters['node_id'];
                        if ( trim( $NodeID ) == "" || ! isset( $namedParameters['node_id'] ) )
                        {
                            $nodeString = "";
                        }
                        else
                        {
                            $nodeString = "&amp;keyword=" . $NodeID;
                        }
                        if ( $namedParameters['zone_override_id'] > 0 )
                        {
                            $overrideID = $namedParameters['zone_override_id'];
                        }
                        $xrowAdVisionINI = eZINI::instance( 'xrowadvision.ini' );
                        $banner_type = $namedParameters['type'];
                        $bannerZones = $xrowAdVisionINI->variable( 'AdserverSettings', 'BannerZones' );
                        if ( ! isset( $bannerZones[$banner_type] ) )
                        {
                            eZDebug::writeError( 'Couldn`t load Banner Zone "' . $banner_type . '"', __METHOD__ );
                            return "";
                        }
                        
                        $adurl = $xrowAdVisionINI->variable( 'AdserverSettings', 'AdserverURL' ) . "/js?wp_id=" . $bannerZones[$banner_type] . $nodeString;
                        if ( ! $operatorValue )
                        {
                            if ( $xrowAdVisionINI->variable( 'AdserverSettings', 'PostLoader' ) == "true" )
                            {
                                $operatorValue = "<div id=\"adition_tag_". $bannerZones[$banner_type]."\" title=\"" . $nodeString . "\"></div>";
                            }
                            else
                            {
                                $operatorValue = "<script type='text/javascript' src='" . $xrowAdVisionINI->variable( 'AdserverSettings', 'AdserverURL' ) . "/js?wp_id=" . $bannerZones[$banner_type] . $nodeString . "' ></script>";
                            }
                            return $operatorValue;
                        }
                        
                        
                        $xml = '<?xml version="1.0" encoding="UTF-8"?><body>' . $operatorValue . '</body>';
                        
                        $banner_type = $namedParameters['type'];
                        $doc = new DOMDocument( '1.0', 'UTF-8' );
                        
                        if ( $doc->loadXML( $xml ) )
                        {
                            $div = $doc->createElement( 'div' );
                            $div->setAttribute( 'class', 'banner advisionad ' . $banner_type );
                            $js = $doc->createElement( 'script' );
                            $js->setAttribute( 'type', 'text/javascript' );
                            $js->setAttribute( 'src', $adurl );
                            $js->appendChild( $ad );
                            if ( $namedParameters['heading'] )
                            {
                                $h = $doc->createElement( 'div' );
                                $h->setAttribute( 'class', 'heading' );
                                $h_text = $doc->createTextNode( $namedParameters['heading'] );
                                $h->appendChild( $h_text );
                                $div->appendChild( $h );
                            }
                            $div->appendChild( $js );
                            
                            $findnode = $doc->getElementsByTagName( 'p' )->item( $namedParameters['position'] );
                            if ( $findnode )
                            {
                                $doc->documentElement->insertBefore( $div, $findnode );
                                $operatorValue = '';
                                foreach ( $doc->documentElement->childNodes as $node )
                                {
                                    $operatorValue .= $doc->saveXML( $node );
                                }
                            }
                        }
                        else
                        {
                            eZDebug::writeError( 'Couldn`t load XML injecting AD "' . $namedParameters['type'] . '"', __METHOD__ );
                        }
                    }
                    else
                    {
                        $operatorValue = "";
                        return $operatorValue;
                    }
                }
                break;
        }
    }
}

?>