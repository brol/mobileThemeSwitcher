<?php
/* -- BEGIN LICENSE BLOCK ----------------------------------
#
# This file is part of Mobile Theme Switcher, a plugin for Dotclear 2.
#
# Copyright (c) 2013 Noel Guilbert, Pierre Van Glabeke, Bernard Le Roux
# Licensed under the GPL version 2.0 license.
# See LICENSE file or
# http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
#
# -- END LICENSE BLOCK ------------------------------------*/
if (!defined('DC_RC_PATH')) { return; }
require_once 'ConstMTS.php';
$this->registerModule(
	/* Name */			  'Mobile Theme Switcher',
	/* Description*/	'Mobile Theme Switcher',
	/* Author */		  'Noel Guilbert, Pierre Van Glabeke, Bernard Le Roux',
	/* Version */		  ConstMTS::VERSION,
	/* Properties */
	array(
		'permissions' => 'usage,contentadmin',
		'type' => 'plugin',
		'dc_min' => '2.6',
		'support' => 'http://forum.dotclear.org/viewtopic.php?id=37738',
		'details' => 'http://plugins.dotaddict.org/dc2/details/mobileThemeSwitcher'
	)
);
