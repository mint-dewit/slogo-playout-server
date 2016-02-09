{*
	"forceupdate": "false",
	"platen": [
		{
			"type":"main-tekst",
			"dur":"0",
			"sub-part":"false"
		}{if !empty($items)},{/if}
		{*{foreach $items i item}
		{
			{$count = 0}
			{foreach $item key value}
				{$count+=1}
				"{$key}":"{$value}"
				{if $count != Count($item)},{/if}
			{/foreach}
		}{if $i < count($items)-1},{/if}
		{/foreach}*}
		{function name=recursive}
		{literal}
		<?php
		function recursive($array, $level = 1){
		    foreach($array as $key => $value){
		        //If $value is an array.
		        if(is_array($value)){
		            //We need to loop through it.
		            recursive($value, $level + 1);
		        } else{
		            //It is not an array, so print it out.
		            echo $key . ": " . $value, '<br>';
		        }
		    }
		}
		recursive($items);
		?>
		{/literal}
	]
*}

{function menu data tick="-" indent=""}
  {foreach $data entry}
    {$indent}{$tick} {$entry.name}<br />

    {if $entry.children}
      {* recursive calls are allowed which makes subtemplates especially good to output trees *}
      {menu $entry.children $tick cat("&nbsp;&nbsp;", $indent)}
    {/if}
  {/foreach}
{/function}

{menu $menuTree ">"}