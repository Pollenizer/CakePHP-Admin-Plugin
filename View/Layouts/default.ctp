<?php
/**
 * Default Layout
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
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title><?php echo isset($pluralHumanName) ? str_replace('Admin ', '', $pluralHumanName) . ' - ' : '' ?><?php echo __('Admin'); ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="http://twitter.github.com/bootstrap/assets/css/bootstrap.css" rel="stylesheet">
        <style type="text/css">
            body{padding-top:60px;padding-bottom:40px}
            .sidebar-nav{padding:9px 0}
        </style>
        <link href="http://twitter.github.com/bootstrap/assets/css/bootstrap-responsive.css" rel="stylesheet">
        <!--[if lt IE 9]>
            <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
        <?php echo $this->Html->meta('icon'); ?>
    </head>
    <body>
        <div class="navbar navbar-fixed-top">
            <div class="navbar-inner">
                <div class="container-fluid">
                    <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </a>
                    <?php echo $this->Html->link(__('Admin'), array('plugin' => 'admin', 'controller' => 'admin', 'action' => 'index'), array('class' => 'brand')); ?>
                    <div class="nav-collapse">
                        <?php if (isset($navbar)): ?>
                            <ul class="nav">
                                <?php foreach ($navbar as $nav): ?>
                                    <li<?php echo $nav['url']['controller'] == $this->request['controller'] ? ' class="active"' : ''; ?>><?php echo $this->Html->link($nav['title'], $nav['url']); ?></li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
                    </div>
                    <div class="nav-collapse pull-right">
                        <ul class="nav">
                            <li><?php echo $this->Html->link(__('Visit Site'), '/'); ?></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row-fluid">
                <?php echo $this->fetch('content'); ?>
            </div>
            <hr>
            <div class="row-fluid">
                <?php echo str_replace('class="cake-sql-log"', 'class="table table-bordered table-striped"', $this->element('sql_dump')); ?>
            </div>
        </div>
    </body>
</html>
