<?php

class ThemeHouse_ThreadInModal_Listener_LoadClass extends ThemeHouse_Listener_LoadClass
{

    protected function _getExtendedClasses()
    {
        return array(
            'ThemeHouse_ThreadInModal' => array(
                'controller' => array(
                    'XenForo_ControllerPublic_Thread'
                ), /* END 'controller' */
                'route_prefix' => array(
                    'XenForo_Route_Prefix_Threads'
                ), /* END 'route_prefix' */
            ), /* END 'ThemeHouse_ThreadInModal' */
        );
    } /* END _getExtendedClasses */

    public static function loadClassController($class, array &$extend)
    {
        $loadClassController = new ThemeHouse_ThreadInModal_Listener_LoadClass($class, $extend, 'controller');
        $extend = $loadClassController->run();
    } /* END loadClassController */

    public static function loadClassRoutePrefix($class, array &$extend)
    {
        $loadClassRoutePrefix = new ThemeHouse_ThreadInModal_Listener_LoadClass($class, $extend, 'route_prefix');
        $extend = $loadClassRoutePrefix->run();
    } /* END loadClassRoutePrefix */
}