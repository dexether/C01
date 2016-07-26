<?php
defined('BASEPATH') or exit('No direct script access allowed');
$hook['post_controller_constructor'] = array(
    'class'    => '',
    'function' => 'load_config',
    'filename' => 'load_config.php',
    'filepath' => 'hooks'
);
/*
| -------------------------------------------------------------------------
| Hooks
| -------------------------------------------------------------------------
| This file lets you define "hooks" to extend CI without hacking the core
| files.  Please see the user guide for info:
|
|    http://codeigniter.com/user_guide/general/hooks.html
|
 */
