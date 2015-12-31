<?php
/**
 * @package    Alligo.PlgContentSocialsShareTracking
 * @author     Emerson Rocha Luiz <emerson@alligo.com.br>
 * @copyright  Copyright (C) 2015 Alligo Ltda. All rights reserved.
 * @license    GNU General Public License version 3. See license.txt
 */
defined('_JEXEC') or die;

/**
 * Content - Google Analytics Event Tracking from Alligo
 *
 * @package  Alligo.PlgContentSocialShareTracking
 * @since    3.4
 */
class PlgContentSocialShareTracking extends JPlugin
{

    protected $custom_class_facebook = '';
    protected $custom_class_gplus = '';
    protected $custom_class_twitter = '';
    protected $custom_class_whatsapp = '';
    protected $is_elabled_facebook = false;
    protected $is_elabled_gplus = false;
    protected $is_elabled_twitter = false;
    protected $is_elabled_whatsapp = false;
    protected $is_elabled_whatsapp_onlymobile = true;

    /**
     * 0: start of article
     * 1: end of article
     */
    protected $button_position = 0;

    /**
     * Before display content method
     *
     * Method is called by the view and the results are imploded and displayed in a placeholder
     *
     * @param	string		The context for the content passed to the plugin.
     * @param	object		The content object.  Note $article->text is also available
     * @param	object		The content params
     * @param	int		The 'page' number
     * @return	string
     * @since	1.6
     */
    public function onContentBeforeDisplay($context, &$article, &$params, $limitstart)
    {

        // Only for article view. Not home, featured, category, etc
        if ($context !== 'com_content.article') {
            return '';
        }

        return $this->addCode($article);
    }

    /**
     * Add the code
     *
     * @param	object		The content object.  Note $article->text is also available
     * @return	string
     */
    protected function addCode($article) {
        // Load jQuery from Joomla Framework
        JHtml::_('jquery.framework');

        // Protip: You can override this file, placing a copy on /templates/yourtemplate/js/alligo/gaet.min.js
        JHtml::script('alligo/gaet.min.js', false, true, false);

        $html = '<span data-ga-event="ready"';
        $html .= ' data-ga-category="' . $article->parent_route . '"';
        $html .= ' data-ga-action="ArticleView"';
        $html .= ' data-ga-label="' . (!empty($article->slug) ? $article->slug : ($article->id . ":Undefined")) . '"';
        $html .= '><!-- PlgContentSocialShareTracking --></span>';
        //return $html;

        return $this->addCodeDummy();
    }

    /**
     * Used only for initial testing
     *
     */
    protected function addCodeDummy() {
        return '<ul class="list-inline">
<li>
    <a href="whatsapp://send?text=I%27m+using+Google+Analytics+Event+Tracking+from+Alligo+https%3A%2F%2Fgithub.com%2Falligo%2Fgoogle-analytics-event-tracking"
        title="Share on WhatsApp" target="_blank"
        data-ga-event="click"
        data-ga-category="GAET/Click/Share"
        data-ga-action="SharedOn/WhatsApp"
        data-ga-label="GAETexample"
        >
        <i class="fa fa-whatsapp" aria-hidden="true"></i> Share on WhatsApp
    </a>
</li>
<li>
    <a href="https://www.facebook.com/sharer/sharer.php?p%5Burl%5D=https%3A%2F%2Fgithub.com%2Falligo%2Fgoogle-analytics-event-tracking"
    title="Share on Facebook" target="_blank"
    data-ga-event="click"
    data-ga-category="GAET/Click/Share"
    data-ga-action="SharedOn/Facebook"
    data-ga-label="GAETexample"
    >
    <i class="fa fa-facebook" aria-hidden="true"></i> Share on Facebook
    </a>
</li>
<li>
    <a href="https://twitter.com/home?status=I%27m+using+Google+Analytics+Event+Tracking+from+Alligo+https%3A%2F%2Fgithub.com%2Falligo%2Fgoogle-analytics-event-tracking"
    title="Share on Twitter" target="_blank"
    data-ga-event="click"
    data-ga-category="GAET/Click/Share"
    data-ga-action="SharedOn/Twitter"
    data-ga-label="GAETexample"
    >
    <i class="fa fa-twitter" aria-hidden="true"></i> Share on Twitter
    </a>
</li>
</ul>';
    }
}
