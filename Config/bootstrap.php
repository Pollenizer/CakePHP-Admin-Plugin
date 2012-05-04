<?php
/**
 * Bootstrap
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

App::uses('CakeRequest', 'Network');

$adminIsAuthorized = (function_exists('adminIsAuthorized')) ? adminIsAuthorized() : true;
if ($adminIsAuthorized === false) {
    throw new MethodNotAllowedException();
}

$Request = new CakeRequest();
if (isset($Request->url)) {
    $parts = explode('/', $Request->url);
    if ((isset($parts[0])) && ($parts[0] == 'admin')) {
        if (isset($parts[1])) {
            $modelClassName = Inflector::camelize(Inflector::singularize($parts[1]));
            $controllerClassName = Inflector::camelize($parts[1]) . 'Controller';
            $controllerClass = 'App::uses(\'AdminAppController\',\'Admin.Controller\');class ' . $controllerClassName . ' extends AdminAppController{public $uses = \'' . $modelClassName . '\';}';
            eval($controllerClass);
        }
    }
}
