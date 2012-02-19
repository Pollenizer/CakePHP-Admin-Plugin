<?php

App::uses('AppController', 'Controller');
App::uses('Folder', 'Utility');

class AdminAppController extends AppController
{
    public $scaffold;

    public function beforeFilter()
    {
        // Build navbar links from controllers
        $Folder = new Folder(APP . 'Plugin' . DS . 'Admin' . DS . 'Controller');
        $files = $Folder->find('.*\Controller.php');
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
