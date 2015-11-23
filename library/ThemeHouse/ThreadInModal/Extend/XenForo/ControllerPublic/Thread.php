<?php

/**
 *
 * @see XenForo_ControllerPublic_Thread
 */
class ThemeHouse_ThreadInModal_Extend_XenForo_ControllerPublic_Thread extends XFCP_ThemeHouse_ThreadInModal_Extend_XenForo_ControllerPublic_Thread
{

    public function actionIndex()
    {
        $response = parent::actionIndex();
        
        if ($response instanceof XenForo_ControllerResponse_View) {
            $responseType = $this->getRouteMatch()->getResponseType();
            $isNoRedirect = $this->_noRedirect();
            
            if ($responseType == 'json' and $isNoRedirect) {
                $response->templateName = 'th_thread_view_threadinoverlay';
                
                // disable inline mod
                $response->params['inlineModOptions'] = array();
                foreach ($response->params['posts'] as &$post) {
                    $post['canInlineMod'] = false;
                }
            }
        }
        
        return $response;
    } /* END actionIndex */
}