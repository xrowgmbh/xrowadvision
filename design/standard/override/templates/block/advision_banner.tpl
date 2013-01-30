<div class="advisionad banner {$block.view}">
    {def $BannerZones = ezini('AdserverSettings', 'BannerZones', 'xrowadvision.ini')}
    {if $block.name}
    <div class="heading">{$block.name|wash}</div>
    {/if}
    {if ezini('AdserverSettings', 'PostLoader', 'xrowadvision.ini')|eq('true')}
        <div id="adition_tag_{if and(is_set($block.custom_attributes.zone_override), $block.custom_attributes.zone_override|ne(''))}{$block.custom_attributes.zone_override}{else}{$BannerZones[$block.view]}{/if}" title=""></div>
    {else}
        <script type='text/javascript' src="{ezini('AdserverSettings', 'AdserverURL', 'xrowadvision.ini')}/js?wp_id={if and(is_set($block.custom_attributes.zone_override), $block.custom_attributes.zone_override|ne(''))}{$block.custom_attributes.zone_override}{else}{$BannerZones[$block.view]}{/if}"></script>
    {/if}

</div>