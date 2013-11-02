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

$core->addBehavior('adminBlogPreferencesForm',array('mobileThemeSwitcherAdminBehaviours','adminBlogPreferencesForm'));
$core->addBehavior('adminBeforeBlogSettingsUpdate',array('mobileThemeSwitcherAdminBehaviours','adminBeforeBlogSettingsUpdate'));

class mobileThemeSwitcherAdminBehaviours
{
  public static function adminBlogPreferencesForm($core, $settings)
  {
    $themes = array('' => '');
    foreach (new DirectoryIterator(path::fullFromRoot($core->blog->settings->system->themes_path,DC_ROOT)) as $dir)
    {
      if ($dir->isDir() && ! $dir->isDot())
      {
        $themes[$dir->getFilename()] = $dir->getFilename();
      }
    }
    echo '<div class="fieldset"><h4>'.__('Mobile Theme Switcher').'</h4>'.
    '<p><label class="classic">'.__('Mobile theme: ').'</label>'.
    form::combo('mobileThemeSwitcher_theme', $themes, $settings->mobileThemeSwitcher->mobileThemeSwitcher_theme).
    '</p></div>';
  }

  public static function adminBeforeBlogSettingsUpdate($settings)
  {
    $settings->addNameSpace('mobileThemeSwitcher');
    $settings->mobileThemeSwitcher->put('mobileThemeSwitcher_theme', empty($_POST['mobileThemeSwitcher_theme'])?"":$_POST['mobileThemeSwitcher_theme'], 'string');
  }
}
