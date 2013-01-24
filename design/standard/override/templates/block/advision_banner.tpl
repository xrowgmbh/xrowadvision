<div class="advisionad banner {$block.view}">
{def $BannerZones = ezini('AdserverSettings', 'BannerZones', 'xrowadvision.ini')}
{if $block.name}
<div class="heading">{$block.name|wash}</div>
{/if}
<script type='text/javascript' src="{ezini('AdserverSettings', 'AdserverURL', 'xrowadvision.ini')}/js?wp_id={if and(is_set($block.custom_attributes.zone_override), $block.custom_attributes.zone_override|ne(''))}{$block.custom_attributes.zone_override}{else}{$BannerZones[$block.view]}{/if}"></script>
</div>
{*def $BannerZones = ezini('AdserverSettings', 'BannerZones', 'xrowadvision.ini')}
    <div class="advisionad banner {$block.view}">
        {advision_show($block.view, '', $block.name|wash, $#node.node_id, cond(is_set($block.custom_attributes.zone_override), $block.custom_attributes.zone_override, ''))}
    </div>
{undef $BannerZones*}