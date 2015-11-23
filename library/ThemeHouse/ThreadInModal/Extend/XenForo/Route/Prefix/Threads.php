<?php

/**
 *
 * @see XenForo_Route_Prefix_Threads
 */
class ThemeHouse_ThreadInModal_Extend_XenForo_Route_Prefix_Threads extends XFCP_ThemeHouse_ThreadInModal_Extend_XenForo_Route_Prefix_Threads
{

    public function buildLink($originalPrefix, $outputPrefix, $action, $extension, $data, array &$extraParams)
    {
        $link = parent::buildLink($originalPrefix, $outputPrefix, $action, $extension, $data, $extraParams);
        
        if (is_array($data) and !empty($data['thread_id'])) {
            $tmpAction = trim(strtolower($action));
            if ($tmpAction == 'index')
                $tmpAction = '';
            
            if (empty($tmpAction)) {
                $threadIds = ThemeHouse_ThreadInModal_Option::get('threadIds');
                
                if (isset($threadIds[$data['thread_id']])) {
                    $GLOBALS['ThreadInOverlay_overlayLinks'][$link] = $action;
                }
            }
        }
        
        return $link;
    } /* END buildLink */
}