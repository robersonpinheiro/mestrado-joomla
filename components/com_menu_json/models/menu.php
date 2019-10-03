<?php
defined('_JEXEC') or die;

class MenuJsonModelMenu extends JModelLegacy
{
    public function getMenus()
    {
        return $this->getQuery();
    }

    protected function getQuery()
    {
        $db = $this->getDbo();
        $query = $db->getQuery(true);
        
        $user   = JFactory::getUser();
        $groups = implode(',', $user->getAuthorisedViewLevels());      

        $query->select('id, title, lft, rgt, parent_id, level, params, img, browserNav, link, type, language')
              ->from('#__menu')
              ->where('published = 1')
              ->where('menutype = "mainmenu"')
              ->where('access IN ('.$groups.') ') 
              ->order('lft');

        $db->setQuery((string)$query);

        return $this->getListMenu($db->loadObjectList());
    }
    
    public function getListMenu($menu)
    {
        $menus = array();

        foreach($menu as $item){
            $item->flink  = $item->link;
            $item->params  = json_decode($item->params);

            switch ($item->type)
            {
                case 'separator':
                    break;

                case 'heading':
                    // No further action needed.
                    break;

                case 'url':
                    if ((strpos($item->link, 'index.php?') === 0) && (strpos($item->link, 'Itemid=') === false))
                    {
                        // If this is an internal Joomla link, ensure the Itemid is set.
                        $item->flink = $item->link . '&Itemid=' . $item->id;
                    }
                    break;

                case 'alias':
                    $item->flink = 'index.php?Itemid=' . $item->params->aliasoptions;

                    // Get the language of the target menu item when site is multilingual
                    if (JLanguageMultilang::isEnabled())
                    {
                        $newItem = JFactory::getApplication()->getMenu()->getItem((int) $item->params->aliasoptions);

                        // Use language code if not set to ALL
                        if ($newItem != null && $newItem->language && $newItem->language !== '*')
                        {
                            $item->flink .= '&lang=' . $newItem->language;
                        }
                    }
                    break;

                default:
                    $item->flink = 'index.php?Itemid=' . $item->id;
                    break;
            }            

            if ((strpos($item->flink, 'index.php?') !== false) && strcasecmp(substr($item->flink, 0, 4), 'http'))
            {
                $item->flink = JRoute::_($item->flink, true, $item->params->secure);
            }
            else
            {
                $item->flink = JRoute::_($item->flink);
            }

            $menus[] = $item;
        }

        return $menus;
    }
}