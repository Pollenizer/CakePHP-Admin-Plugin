<?php
/**
 * Admin App Controller
 *
 * PHP 5
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the below copyright notice.
 *
 * @author     Robert Love <robert@pollenizer.com>
 * @copyright  Copyright 2012, Pollenizer Pty. Ltd. (http://pollenizer.com)
 * @license    MIT License (http://www.opensource.org/licenses/mit-license.php)
 * @since      CakePHP(tm) v 2.0.4
 */

App::uses('AppController', 'Controller');
App::uses('Folder', 'Utility');

class AdminAppController extends AppController
{
    /**
     * Scaffold
     *
     * @var string
     */
    public $scaffold;

    /**
     * Before Filter
     *
     * @return void
     */
    public function beforeFilter()
    {
        $Folder = new Folder(APP . 'Plugin' . DS . 'Admin' . DS . 'Controller');
        $files = $Folder->find('.*\Controller.php', true);
        $navbar = array();
        foreach ($files as $file) {
            if (($file !== 'AdminAppController.php') && ($file !== 'AdminController.php')) {
                $controller = Inflector::tableize(str_replace('Controller.php', '', $file));
                $title = Inflector::humanize(str_replace('admin_', '', $controller));
                $navbar[] = array(
                    'title' => $title,
                    'url' => array(
                        'plugin' => 'admin',
                        'controller' => $controller,
                        'action' => 'index'
                    )
                );
            }
        }
        $this->set(compact('navbar'));
    }
}
