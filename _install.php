<?php
/**
 * @brief Mobile Theme Switcher, a plugin for Dotclear 2
 *
 * @package Dotclear
 * @subpackage Plugin
 *
 * @author Noel Guilbert, Pierre Van Glabeke, Bernard Le Roux and contributors
 *
 * @copyright GPL-2.0 https://www.gnu.org/licenses/gpl-2.0.html
 */

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
