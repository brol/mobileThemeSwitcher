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
if (!defined('DC_RC_PATH')) { return; }

dcCore::app()->addBehavior('publicPrependV2',array('mobileThemeSwitcherBehaviors','changeTheme'));
dcCore::app()->tpl->addValue('FullVersion', array('tplMobileThemeSwitcher', 'linkToFullVersion'));
dcCore::app()->tpl->addValue('MobileVersion', array('tplMobileThemeSwitcher', 'linkToMobileVersion'));

class mobileThemeSwitcherBehaviors
{
  public static function changeTheme ()
  {
    $theme = null;
    $cookieName = 'dc_standard_theme_'.dcCore::app()->blog->id;

    if (isset($_COOKIE[$cookieName]))
    {
      $theme = $_COOKIE[$cookieName];
    }

    if (isset($_GET['dc_standard_theme']))
    {
      $theme = dcCore::app()->blog->settings->system->theme;
    }
    elseif (self::isMobileDevice() || isset($_GET['dc_mobile_theme']))
    {
      $theme = dcCore::app()->blog->settings->mobileThemeSwitcher->mobileThemeSwitcher_theme;
    }

    if ($theme && dcCore::app()->themes->moduleExists($theme))
    {
      setcookie($cookieName, $theme, strtotime('+3 month'), '/', '');
      dcCore::app()->public->theme = $theme;
      dcCore::app()->blog->settings->system->theme = dcCore::app()->public->theme;
    }
  }

  protected static function isMobileDevice()
  {
    $patterns = array(
      '#iPhone#i', // iPhone UA
      '#Opera Mobi#i', // AT&T phone
      '#BlackBerry#i', // Blackberry
      '#Windows CE#i', // Windows CE phone: HP iPAQ, HTC, Palm
      '#Profile/MIDP-2.0#i', // Motorola
      '#Opera mini#i', // Opera mini browser
      '#Symbian#i', // Symbian OS
      '#Android 1#i', // Android version 1
      '#Android 2#i', // Android version 2
      '#Mobile#i', // Everything else
    );

    foreach ($patterns as $pattern)
    {
      if (preg_match($pattern, $_SERVER['HTTP_USER_AGENT']))
      {
        return true;
      }
    }

    return false;
  }
}

class tplMobileThemeSwitcher
{
  public static function linkToFullVersion($attr)
  {
    return '<a href="?dc_standard_theme=1">'.__('Full Version').'</a>';
  }

  public static function linkToMobileVersion($attr)
  {
    return '<a href="?dc_mobile_theme=1">'.__('Mobile Version').'</a>';
  }
}
