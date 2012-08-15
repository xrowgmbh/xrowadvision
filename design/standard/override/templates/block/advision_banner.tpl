<div class="advisionad banner {$block.view}">
{def $BannerZones = ezini('AdserverSettings', 'BannerZones', 'xrowadvision.ini')}
{if $block.name}
<div class="heading">{$block.name|wash}</div>
{/if}
<script type='text/javascript' src="{ezini('AdserverSettings', 'AdserverURL', 'xrowadvision.ini')}/js?wp_id={if $block.custom_attributes.zone_override}{$block.custom_attributes.zone_override}{else}{$BannerZones[$block.view]}{/if}"></script>
</div>