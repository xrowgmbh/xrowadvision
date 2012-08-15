<div class="advisionad banner {$banner}">
{def $BannerZones = ezini('AdserverSettings', 'BannerZones', 'xrowadvision.ini')}
{if $heading}
<div class="heading">{$heading|wash}</div>
{/if}
<script type='text/javascript' src="{ezini('AdserverSettings', 'AdserverURL', 'xrowadvision.ini')}/js?wp_id={if $zone_override}{$zone_override}{else}{$BannerZones[$banner]}{/if}" ></script>
</div>