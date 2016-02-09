{
	"forced": "false",
	"programmering": [
		{foreach $videos i video}
		{if $video.host != 'template'}
			{	
				"host": "{$video.host}",
				"source": "{$video.source}",
				"audio": "{if $video.audio == 1}true{else}false{/if}",
				"type": "video/MP4",
				"start": "{$video.start}",
				"end": "{$video.end}"
			}
		{else}
			{	
				"host": "{$video.host}",
				"source": "{$video.source}",
				"audio": "{if $video.audio == 1}true{else}false{/if}",
				"type": "template/html",
				"start": "{$video.start}",
				"end": "{$video.end}",
				"keys": { 
{$count = 1}{foreach $video.keys key value}
					"{$key}" : "{$value}"{if $count != Count($video.keys)},{/if}{$count += 1}
{/foreach}				}
			}
		{/if}
		{if $i != count($videos)-1},{/if}
		{/foreach}
	]
}