<?php
/* template head */
/* end template head */ ob_start(); /* template body */ ?>{
	"forceupdate": "<?php echo $this->scope["music"]["forceupdate"];?>",
	"muziek": [
		<?php 
$_fh0_data = (isset($this->scope["music"]["items"]) ? $this->scope["music"]["items"]:null);
if ($this->isTraversable($_fh0_data) == true)
{
	foreach ($_fh0_data as $this->scope['i']=>$this->scope['item'])
	{
/* -- foreach start output */
?>
		{
			"source": "<?php echo $this->scope["item"]["source"];?>"
		}<?php if ((isset($this->scope["i"]) ? $this->scope["i"] : null) < count((isset($this->scope["music"]["items"]) ? $this->scope["music"]["items"]:null)) - 1) {
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