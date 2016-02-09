[
{foreach $videos i video}
"{$video.source}"{if $i != count($videos)-1 },{/if}
{/foreach}
]