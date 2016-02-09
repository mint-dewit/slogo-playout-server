<?php
/* template head */
/* end template head */ ob_start(); /* template body */ ?>{	
	"forced": "false",
	"streams": [
		<?php 
$_fh0_data = (isset($this->scope["streams"]) ? $this->scope["streams"] : null);
if ($this->isTraversable($_fh0_data) == true)
{
	foreach ($_fh0_data as $this->scope['i']=>$this->scope['item'])
	{
/* -- foreach start output */
?>
		{
			"source": "<?php echo $this->scope["item"]["source"];?>",
			"start": "<?php echo $this->scope["item"]["start"];?>",
			"end": "<?php echo $this->scope["item"]["end"];?>"
		}<?php if ((isset($this->scope["i"]) ? $this->scope["i"] : null) < count((isset($this->scope["streams"]) ? $this->scope["streams"] : null)) - 1) {
?>,<?php 
}?>

		<?php 
/* -- foreach end output */
	}
}?>

	]
}<?php  /* end template body */
return $this->buffer . ob_get_clean();
?>