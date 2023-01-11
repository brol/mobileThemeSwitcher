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

dcCore::app()->addBehavior('adminBlogPreferencesFormV2',array('mobileThemeSwitcherAdminBehaviours','adminBlogPreferencesForm'));
dcCore::app()->addBehavior('adminBeforeBlogSettingsUpdate',array('mobileThemeSwitcherAdminBehaviours','adminBeforeBlogSettingsUpdate'));

class mobileThemeSwitcherAdminBehaviours
{
  public static function adminBlogPreferencesForm($settings)
  {
    $themes = array('' => '');
    foreach (new DirectoryIterator(path::fullFromRoot(dcCore::app()->blog->settings->system->themes_path,DC_ROOT)) as $dir)
    {
      if ($dir->isDir() && ! $dir->isDot())
      {
        $themes[$dir->getFilename()] = $dir->getFilename();
      }
    }
    echo '<div class="fieldset"><h4 id="mobileThemeSwitcher_params">'.__('Mobile Theme Switcher').'</h4>'.
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
