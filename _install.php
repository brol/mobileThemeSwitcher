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
 
# On lit la version du plugin
$m_version = $core->plugins->moduleInfo('mobileThemeSwitcher','version');
 
# On lit la version du plugin dans la table des versions
$i_version = $core->getVersion('mobileThemeSwitcher');
 
# La version dans la table est supérieure ou égale à
# celle du module, on ne fait rien puisque celui-ci
# est installé
if (version_compare($i_version,$m_version,'>=')) {
  return;
}

# Création du setting (s'il existe, il ne sera pas écrasé)
$settings = new dcSettings($core,null);
$settings->addNamespace('mobileThemeSwitcher');
$settings->mobileThemeSwitcher->put('mobileThemeSwitcher_theme', null, 'string', 'mobileThemeSwitcher theme', false, true);

 
# La procédure d'installation commence vraiment là
$core->setVersion('mobileThemeSwitcher',$m_version);
