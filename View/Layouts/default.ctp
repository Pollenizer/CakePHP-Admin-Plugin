<?php
// If navbar is not set, we are not going through AdminAppController::beforeFilter.
// Get out of here!
if (!isset($navbar)) {
    header('Location: ' . $this->Html->url('/'));
    exit;
}
?>
<?php echo $this->Html->doctype('html5'); ?>
<html>
    <head>
        <?php echo $this->Html->charset(); ?>
        <title><?php echo isset($pluralHumanName) ? str_replace('Admin ', '', $pluralHumanName) . ' - ' : '' ?><?php echo __('Admin'); ?></title>
        <!--[if lt IE 9]>
            <?php echo $this->Html->script('http://html5shim.googlecode.com/svn/trunk/html5.js'); ?>
        <![endif]-->
        <?php echo $this->Html->css(array('/admin/css/bootstrap.min', '/admin/css/bootstrap-responsive.min', '/admin/css/screen')); ?>
        <?php echo $this->Html->meta('icon'); ?>
        <?php echo $scripts_for_layout; ?>
    </head>
    <body>
        <div class="navbar navbar-fixed-top">
            <div class="navbar-inner">
                <div class="container-fluid">
                    <?php echo $this->Html->link(__('Admin'), array('plugin' => 'admin', 'controller' => 'admin', 'action' => 'index'), array('class' => 'brand')); ?>
                    <div class="nav-collapse">
                        <ul class="nav">
                            <?php foreach ($navbar as $nav): ?>
                                <li<?php echo $nav['url']['controller'] == $this->request['controller'] ? ' class="active"' : ''; ?>><?php echo $this->Html->link($nav['title'], $nav['url']); ?></li>
                            <?php endforeach; ?>
                        </ul>
                        <ul class="nav pull-right">
                            <li><?php echo $this->Html->link(__('View Site'), '/'); ?></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row-fluid">
                <?php echo $this->Session->flash(); ?>
                <?php echo $content_for_layout; ?>
                <?php echo $this->element('sql_dump'); ?>
            </div>
            <hr>
            <footer>
                <p><?php echo $this->Html->image('/admin/img/cake.power.gif', array('url' => 'http://cakephp.org/')); ?></p>
            </footer>
        </div>
        <?php echo $this->Html->script(array('/admin/js/bootstrap.min')); ?>
    </body>
</html>
