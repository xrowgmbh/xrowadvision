{def $BannerZones = ezini('AdserverSettings', 'BannerZones', 'xrowadvision.ini')}
    <div class="advisionad banner {$block.view}">
        {advision_show($block.view, '', $heading|wash, $#node.node_id, cond(is_set($zone_override), $zone_override, ''))}
    </div>
{undef $BannerZones}