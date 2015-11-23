<?php

class ThemeHouse_ThreadInModal_Listener_TemplatePostRender extends ThemeHouse_Listener_TemplatePostRender
{

    protected function _getTemplates()
    {
        return array(
            'PAGE_CONTAINER'
        );
    } /* END _getTemplates */

    public static function templatePostRender($templateName, &$content, array &$containerData, 
        XenForo_Template_Abstract $template)
    {
        $templatePostRender = new ThemeHouse_ThreadInModal_Listener_TemplatePostRender($templateName, $content, $containerData,
            $template);
        list ($content, $containerData) = $templatePostRender->run();
    } /* END templatePostRender */

    protected function _pageContainer()
    {
        $threadLinkString = 'threadLinkString';
        $threadLink = XenForo_Link::buildPublicLink($threadLinkString);
        $prefix = rtrim(str_replace($threadLinkString, '', $threadLink), '/');
        //TODO Global Variable
        if (!isset($GLOBALS['ThreadInOverlay_overlayLinks'])) {
            return;
        }
        foreach ($GLOBALS['ThreadInOverlay_overlayLinks'] as $link => $action) {
            $linkPrefixed = $prefix . $link;
            $regEx = '/<a href="' . preg_quote($linkPrefixed, '/') . '"[^>]*>/i';
            $offset = 0;
            $matches = array();
            do {
                $matched = preg_match($regEx, $this->_contents, $matches, PREG_OFFSET_CAPTURE, $offset + 1);
                if ($matched) {
                    $offset = $matches[0][1];
                    $found = $matches[0][0];
                    if (strpos($found, 'class="') !== false) {
                        // there is a class attribute already
                        if (strpos($found, 'OverlayTrigger') === false) {
                            $replacement = str_replace('class="', 'class="OverlayTrigger ', $found);
                        }
                    } else {
                        // no class yet
                        $replacement = str_replace('<a', '<a class="OverlayTrigger"', $found);
                    }
                    
                    // all seems find, update content now
                    $this->_contents = substr_replace($this->_contents, $replacement, $offset, strlen($found));
                }
            } while ($matched);
        }
    } /* END _pageContainer */
}