<?php
/**
 * Bootstrap Form Helper
 *
 * PHP 5
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the below copyright notice.
 *
 * @author     Robert Love <robert@pollenizer.com>
 * @copyright  Copyright 2012, Pollenizer Pty. Ltd. (http://pollenizer.com)
 * @license    MIT License (http://www.opensource.org/licenses/mit-license.php)
 * @since      CakePHP(tm) v 2.1.1
 */

App::uses('FormHelper', 'View/Helper');

class BootstrapFormHelper extends FormHelper
{
    /**
     * Create
     *
     * @param $model string
     * @param $options array
     * @return string
     */
    public function create($model = null, $options = array())
    {
        if (empty($options['class'])) {
            $options['class'] = 'well';
        }
        return parent::create($model, $options);
    }

    /**
     * Input
     *
     * @param $fieldName string
     * @param $options array
     * @return string
     */
    public function input($fieldName, $options = array())
    {
        $this->setEntity($fieldName);
        $defaults = array(
            'format' => array(
                'before',
                'label',
                'between',
                'input',
                'error',
                'after'
            ),
            'div' => array(
                'class' => 'control-group'
            ),
            'error' => array(
                'attributes' => array(
                    'class' =>'help-inline',
                    'wrap' => 'span'
                )
            ),
            'help' => '',
        );
        $options = array_merge($defaults, $options);
        if (!empty($options['help'])) {
            $options['after'] = '<span class="help-block">' . $options['help'] . '</span>' . $options['after'];
        }
        return parent::input($fieldName, $options);
    }

    /**
     * Submit
     *
     * @param $label string
     * @return string
     */
    public function submit($label = null)
    {
        $options = array(
            'class' => 'btn btn-primary'
        );
        return parent::submit($label, $options);
    }
}
