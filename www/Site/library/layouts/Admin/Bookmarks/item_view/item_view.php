<?php
/**
 * Виджет пунктов меню
 * Для отображения свойств объекта соответствующими виджетом из списка
 * @version 1.0
 */
namespace Site\library\layouts\Admin\Bookmarks\item_view;

use Site\library\menus\Menu\item_view\item_view as item_view_1;

class item_view extends item_view_1
{
    protected $_cut_contents_url = false;

    function show($v = array(), $commands, $input)
    {
        if ($this->_input['REQUEST']['show']){
            $v['item_key'] = $this->_input['REQUEST']['object']->key();
        }
        return parent::show($v, $commands, $input);
    }
}