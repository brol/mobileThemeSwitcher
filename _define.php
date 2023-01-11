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

$this->registerModule(
    'mobileThemeSwitcher',
    'Mobile Theme Switcher',
    'Noel Guilbert, Pierre Van Glabeke, Bernard Le Roux and contributors',
    '0.4-dev',
    [
        'requires'    => [['core', '2.24']],
        'permissions' => dcCore::app()->auth->makePermissions([
            dcAuth::PERMISSION_USAGE,
            dcAuth::PERMISSION_CONTENT_ADMIN,
        ]),
        'type'       => 'plugin',
        'support'    => 'http://forum.dotclear.org/viewtopic.php?id=37738',
        'details'    => 'https://plugins.dotaddict.org/dc2/details/' . basename(__DIR__),
    ]
);
