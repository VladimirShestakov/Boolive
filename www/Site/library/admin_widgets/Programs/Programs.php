<?php
/**
 * Класс
 *
 * @version 1.0
 */
namespace Site\library\admin_widgets\Programs;

use Boolive\data\Data;
use Boolive\data\Entity;
use Site\library\views\AutoWidget2\AutoWidget2,
    Boolive\values\Rule;

class Programs extends AutoWidget2
{
    function startRule()
    {
        return Rule::arrays(array(
            'REQUEST' => Rule::arrays(array(
                'object' => Rule::any(
                    Rule::arrays(Rule::entity()),
                    Rule::entity()
                )->required()
            ))
        ));
    }

    function show($v = array(), $commands, $input)
    {
        // Проверка обновлений для объекта
        if ($this->_input['REQUEST']['object'] instanceof Entity){
            /** @var Entity $obj */
            $obj = $this->_input['REQUEST']['object'];
           //if (($obj->_attribs['update_time']!=0 /*|| $obj->_attribs['diff'] == Entity::DIFF_ADD*/) /*&& (time()-$obj->_attribs['update_time']) > 60*/){
                //Data::findUpdates($obj, 50, 1, true);
            //}
        }
        return parent::show($v, $commands, $input);
    }
}