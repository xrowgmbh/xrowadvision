{def $BannerZones = ezini('AdserverSettings', 'BannerZones', 'xrowadvision.ini')}
    <div class="advisionad banner {$block.view}">
        {advision_show($block.view, '', $block.name|wash, $#node.node_id, cond(is_set($block.custom_attributes.zone_override), $block.custom_attributes.zone_override, ''))}
    </div>
{undef $BannerZones}