<?php
/* template head */
/* end template head */ ob_start(); /* template body */ ?>{
	"forced": "false",
	"programmering": [
		<?php 
$_fh1_data = (isset($this->scope["videos"]) ? $this->scope["videos"] : null);
if ($this->isTraversable($_fh1_data) == true)
{
	foreach ($_fh1_data as $this->scope['i']=>$this->scope['video'])
	{
/* -- foreach start output */
?>
		<?php if ((isset($this->scope["video"]["host"]) ? $this->scope["video"]["host"]:null) != 'template') {
?>
			{	
				"host": "<?php echo $this->scope["video"]["host"];?>",
				"source": "<?php echo $this->scope["video"]["source"];?>",
				"audio": "<?php if ((isset($this->scope["video"]["audio"]) ? $this->scope["video"]["audio"]:null) == 1) {
?>true<?php 
}
else {
?>false<?php 
}?>",
				"type": "video/MP4",
				"start": "<?php echo $this->scope["video"]["start"];?>",
				"end": "<?php echo $this->scope["video"]["end"];?>"
			}
		<?php 
}
else {
?>
			{	
				"host": "<?php echo $this->scope["video"]["host"];?>",
				"source": "<?php echo $this->scope["video"]["source"];?>",
				"audio": "<?php if ((isset($this->scope["video"]["audio"]) ? $this->scope["video"]["audio"]:null) == 1) {
?>true<?php 
}
else {
?>false<?php 
}?>",
				"type": "template/html",
				"start": "<?php echo $this->scope["video"]["start"];?>",
				"end": "<?php echo $this->scope["video"]["end"];?>",
				"keys": { 
<?php $this->scope["count"]=1;

$_fh0_data = (isset($this->scope["video"]["keys"]) ? $this->scope["video"]["keys"]:null);
if ($this->isTraversable($_fh0_data) == true)
{
	foreach ($_fh0_data as $this->scope['key']=>$this->scope['value'])
	{
/* -- foreach start output */
?>
					"<?php echo $this->scope["key"];?>" : "<?php echo $this->scope["value"];?>"<?php if ((isset($this->scope["count"]) ? $this->scope["count"] : null) != Count((isset($this->scope["video"]["keys"]) ? $this->scope["video"]["keys"]:null))) {
?>,<?php 
}
$this->scope["count"]+=1?>

<?php 
/* -- foreach end output */
	}
}?>				}
			}
		<?php 
}?>

		<?php if ((isset($this->scope["i"]) ? $this->scope["i"] : null) != count((isset($this->scope["videos"]) ? $this->scope["videos"] : null)) - 1) {
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