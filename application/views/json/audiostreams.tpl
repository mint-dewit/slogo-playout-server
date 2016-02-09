{	
	"forced": "false",
	"streams": [
		{foreach $streams i item}
		{
			"source": "{$item.source}",
			"start": "{$item.start}",
			"end": "{$item.end}"
		}{if $i < count($streams)-1},{/if}
		{/foreach}
	]
}