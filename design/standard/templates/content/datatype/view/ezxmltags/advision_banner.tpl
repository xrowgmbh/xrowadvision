<div class="advisionad banner {$banner}">
    {def $BannerZones = ezini('AdserverSettings', 'BannerZones', 'xrowadvision.ini')}
    {if $heading}
        <div class="heading">{$heading|wash}</div>
    {/if}
    {if ezini('AdserverSettings', 'PostLoader', 'xrowadvision.ini') == 'true'}
        <div id="adition_tag_{if $zone_override}{$zone_override}{else}{$BannerZones[$banner]}{/if}" title=""></div>
    {else}
        <script type='text/javascript' src="{ezini('AdserverSettings', 'AdserverURL', 'xrowadvision.ini')}/js?wp_id={if $zone_override}{$zone_override}{else}{$BannerZones[$banner]}{/if}" ></script>
    {/if}
</div>