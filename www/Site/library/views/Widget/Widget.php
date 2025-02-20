<?php
/**
 * Виджет
 * Формирует результат работы спомощью шаблонизации. Шаблоном является значение виджета
 * @version 1.0
 */
namespace Site\library\views\Widget;

use Boolive\template\Template,
    Site\library\views\View\View,
    Boolive\values\Rule;

class Widget extends View
{

    /**
     * Инициализация Виджета
     */
    protected function init()
    {
//        if (!$this->isLink()){
//            $this->find(array('select'=>array('tree'), 'depth'=>array(1,'max'), 'return'=>false, 'comment' => 'read tree of widgets', 'order' => array('order', 'asc')), false);
//        }
    }

    /**
     * Инициализация входящих данных
     * Если нету своего объекта (модели), то берется объект из входящих данных
     * @param $input
     * @return mixed|void
     */
    function startInit($input)
    {
        if ($this->object->isExist() && !$this->object->isDraft(null, false)){
            $input['REQUEST']['object'] = $this->object;
        }
        parent::startInit($input);
    }

    /**
     * Правило на входящие данные - условие работы виджета
     * @return null|\Boolive\values\Rule
     */
    function startRule()
    {
        return Rule::arrays(array(
            'REQUEST' => Rule::arrays(array(
                'object' => Rule::entity($this->object_rule->value())->required(),
                'path' => Rule::regexp($this->path_rule->value())->required(),
            ))
        ));
    }

    function work()
    {
        return $this->show(array(), $this->_commands, $this->_input);
    }

    /**
     * Формирование отображения с помощью шаблонизации
     * @param array $v
     * @param $commands
     * @param $input
     * @return string
     */
    function show($v = array(), $commands, $input)
    {
        $this->startChild('res');
        $v['view_id'] = $this->key();
        $v['view_uri'] = $this->uri();
        return Template::render($this, $v);
    }

    function classTemplate($methods = array(), $use = array())
    {
//        $use[] = 'Boolive\values\Rule';
//        $methods['startRule'] =
//<<<code
//    /**
//     * Правило на входящие данные - условие работы виджета
//     * @return null|\Boolive\values\Rule
//     */
//    function startRule()
//    {
//        return Rule::arrays(array(
//            'REQUEST' => Rule::arrays(array(
//                'object' => Rule::entity(\$this->object_rule->value())->required(),
//                'path' => Rule::regexp(\$this->path_rule->value())->required(),
//            ))
//        ));
//    }';
//code;
        if (!isset($methods['show'])){
            $methods['show'] =
<<<code
    function show(\$v = array(), \$commands, \$input)
    {
        return parent::show(\$v,\$commands, \$input);
    }
code;
        }
        return parent::classTemplate($methods, $use);
    }
}