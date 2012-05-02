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
 * @since      CakePHP(tm) v 2.1.1
 */

App::uses('AppController', 'Controller');
App::uses('Folder', 'Utility');

class AdminAppController extends AppController
{
    /**
     * Helpers
     *
     * @var array
     */
    public $helpers = array(
        'Form' => array(
            'className' => 'Admin.BootstrapForm'
        ),
        'Html',
        'Session' => array(
            'className' => 'Admin.BootstrapSession'
        ),
        'Paginator' => array(
            'className' => 'Admin.BootstrapPaginator'
        )
    );

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
        parent::beforeFilter();
        $Folder = new Folder(APP . 'Model');
        $files = $Folder->find('.*', true);
        $navbar = array();
        foreach ($files as $file) {
            if ($file !== 'AppModel.php') {
                $model = str_replace('.php', '', $file);
                $controller = Inflector::tableize($model);
                $title = Inflector::pluralize($model);
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
