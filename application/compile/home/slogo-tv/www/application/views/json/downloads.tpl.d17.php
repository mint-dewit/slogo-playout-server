<?php
/* template head */
/* end template head */ ob_start(); /* template body */ ?>[
<?php 
$_fh0_data = (isset($this->scope["videos"]) ? $this->scope["videos"] : null);
if ($this->isTraversable($_fh0_data) == true)
{
	foreach ($_fh0_data as $this->scope['i']=>$this->scope['video'])
	{
/* -- foreach start output */
?>
"<?php echo $this->scope["video"]["source"];?>"<?php if ((isset($this->scope["i"]) ? $this->scope["i"] : null) != count((isset($this->scope["videos"]) ? $this->scope["videos"] : null)) - 1) {
?>,<?php 
}?>

<?php 
/* -- foreach end output */
	}
}?>

]<?php  /* end template body */
return $this->buffer . ob_get_clean();
?>