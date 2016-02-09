{
	"forceupdate": "{$music.forceupdate}",
	"muziek": [
		{foreach $music.items i item}
		{
			"source": "{$item.source}"
		}{if $i < count($music.items)-1},{/if}
		{/foreach}
	]
}