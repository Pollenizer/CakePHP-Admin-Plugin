<?php
/**
 * Scaffold Form
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
<div class="span3">
    <div class="well sidebar-nav">
        <ul class="nav nav-list">
            <li class="nav-header"><?php echo __d('cake', 'Actions'); ?></li>
            <?php if ($this->request->action != 'add'): ?>
                <li><?php echo $this->Form->postLink(__d('cake', 'Delete'), array('action' => 'delete', $this->Form->value($modelClass . '.' . $primaryKey)), null, __d('cake', 'Are you sure you want to delete #%s?', $this->Form->value($modelClass . '.' . $primaryKey))); ?></li>
            <?php endif;?>
            <li><?php echo $this->Html->link(__d('cake', 'List') . ' ' . str_replace('Admin ', '', $pluralHumanName), array('plugin' => 'admin', 'action' => 'index')); ?></li>
            <?php $done = array(); ?>
            <?php foreach ($associations as $_type => $_data): ?>
                <?php foreach ($_data as $_alias => $_details): ?>
                    <?php if ($_details['controller'] != $this->name && !in_array($_details['controller'], $done)): ?>
                        <li><?php echo $this->Html->link(__d('cake', 'List %s', Inflector::humanize($_details['controller'])), array('plugin' => 'admin', 'controller' => $_details['controller'], 'action' =>'index')); ?></li>
                        <li><?php echo $this->Html->link(__d('cake', 'New %s', Inflector::humanize(Inflector::underscore($_alias))), array('plugin' => 'admin', 'controller' => $_details['controller'], 'action' =>'add')); ?></li>
                        <?php $done[] = $_details['controller']; ?>
                    <?php endif; ?>
                <?php endforeach; ?>
            <?php endforeach; ?>
        </ul>
    </div>
</div>
<div class="span9">
    <?php echo $this->Session->flash(); ?>
    <?php echo $this->Form->create(); ?>
    <?php echo $this->Form->inputs($scaffoldFields, array('created', 'modified', 'updated')); ?>
    <?php echo $this->Form->end(__d('cake', 'Save')); ?>
</div>
