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

if (!defined('DC_CONTEXT_ADMIN')) { return; }
 
# La version dans la table est supérieure ou égale à
# celle du module, on ne fait rien puisque celui-ci
# est installé
if (!dcCore::app()->newVersion(basename(__DIR__), dcCore::app()->plugins->moduleInfo(basename(__DIR__), 'version'))) {
  return;
}

# Création du setting (s'il existe, il ne sera pas écrasé)
dcCore::app()->blog->settings->addNamespace('mobileThemeSwitcher');
dcCore::app()->blog->settings->mobileThemeSwitcher->put('mobileThemeSwitcher_theme', null, 'string', 'mobileThemeSwitcher theme', false, true);
