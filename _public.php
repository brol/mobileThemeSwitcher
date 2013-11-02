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

$core->addBehavior('publicPrepend',array('mobileThemeSwitcherBehaviors','changeTheme'));
$core->tpl->addValue('FullVersion', array('tplMobileThemeSwitcher', 'linkToFullVersion'));
$core->tpl->addValue('MobileVersion', array('tplMobileThemeSwitcher', 'linkToMobileVersion'));

class mobileThemeSwitcherBehaviors
{
  public static function changeTheme ($core)
  {
    global $__theme;
    $theme = null;
    $cookieName = 'dc_standard_theme_'.$core->blog->id;

    if (isset($_COOKIE[$cookieName]))
    {
      $theme = $_COOKIE[$cookieName];
    }

    if (isset($_GET['dc_standard_theme']))
    {
      $theme = $core->blog->settings->system->theme;
    }
    elseif (self::isMobileDevice() || isset($_GET['dc_mobile_theme']))
    {
      $theme = $core->blog->settings->mobileThemeSwitcher->mobileThemeSwitcher_theme;
    }

    if ($theme && $core->themes->moduleExists($theme))
    {
      setcookie($cookieName, $theme, strtotime('+3 month'), '/', '');
      $__theme = $theme;
      $core->blog->settings->system->theme = $__theme;
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
