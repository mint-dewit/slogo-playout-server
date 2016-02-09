<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

// The name of the directory where templates are located.
$config['template_dir'] = dirname(FCPATH) . '/www/application/views/';

// The directory where compiled templates are located
$config['compileDir']   = dirname(FCPATH) . '/www/application/compile/';

//This tells Dwoo whether or not to cache the output of the templates to the $cache_dir.
$config['caching']      = 0;
$config['cacheDir']     = dirname(FCPATH) . '/www/application/cache/';
$config['cacheTime']    = 0;
