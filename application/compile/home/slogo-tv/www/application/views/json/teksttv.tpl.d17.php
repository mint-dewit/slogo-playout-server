<?php
/* template head */
/* end template head */ ob_start(); /* template body */ ?>{
	"forceupdate": "false",
	"platen": [
		{
			"type":"main-tekst",
			"dur":"0",
			"sub-part":"false"
		}<?php if (! empty($this->scope["items"])) {
?>,<?php 
}?>

		
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
		
	]
}<?php  /* end template body */
return $this->buffer . ob_get_clean();
?>