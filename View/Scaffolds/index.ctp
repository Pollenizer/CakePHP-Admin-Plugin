<?php
/**
 * Scaffold Index
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
            <li><?php echo $this->Html->link(__d('cake', 'New %s', $singularHumanName), array('plugin' => 'admin', 'action' => 'add')); ?></li>
            <?php $done = array(); ?>
            <?php foreach ($associations as $_type => $_data): ?>
                <?php foreach ($_data as $_alias => $_details): ?>
                    <?php if ($_details['controller'] != $this->name && !in_array($_details['controller'], $done)): ?>
                        <li><?php echo $this->Html->link(__d('cake', 'List %s', Inflector::humanize($_details['controller'])), array('plugin' => 'admin', 'controller' => $_details['controller'], 'action' => 'index')); ?></li>
                        <li><?php echo $this->Html->link(__d('cake', 'New %s', Inflector::humanize(Inflector::underscore($_alias))), array('plugin' => 'admin', 'controller' => $_details['controller'], 'action' => 'add')); ?></li>
                        <?php $done[] = $_details['controller']; ?>
                    <?php endif; ?>
                <?php endforeach; ?>
            <?php endforeach; ?>
        </ul>
    </div>
</div>
<div class="span9">
    <?php echo $this->Session->flash(); ?>
    <div class="page-header">
        <h1><?php echo str_replace('Admin ', '', $pluralHumanName); ?></h1>
    </div>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <?php foreach ($scaffoldFields as $_field): ?>
                    <th><?php echo $this->Paginator->sort($_field); ?></th>
                <?php endforeach; ?>
                <th colspan="3"><?php echo __d('cake', 'Actions'); ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach (${$pluralVar} as ${$singularVar}): ?>
                <tr>
                    <?php foreach ($scaffoldFields as $_field): ?>
                        <?php $isKey = false; ?>
                        <?php if (!empty($associations['belongsTo'])): ?>
                            <?php foreach ($associations['belongsTo'] as $_alias => $_details): ?>
                                <?php if ($_field === $_details['foreignKey']): ?>
                                    <?php $isKey = true; ?>
                                    <td><?php echo $this->Html->link(${$singularVar}[$_alias][$_details['displayField']], array('plugin' => 'admin', 'controller' => $_details['controller'], 'action' => 'view', ${$singularVar}[$_alias][$_details['primaryKey']])); ?></td>
                                    <?php break; ?>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        <?php endif; ?>
                        <?php if ($isKey !== true): ?>
                            <td><?php echo h(${$singularVar}[$modelClass][$_field]); ?></td>
                        <?php endif; ?>
                    <?php endforeach; ?>
                    <td><?php echo $this->Html->link(__d('cake', 'View'), array('plugin' => 'admin', 'action' => 'view', ${$singularVar}[$modelClass][$primaryKey]), array('class' => 'btn btn-info')); ?></td>
                    <td><?php echo $this->Html->link(__d('cake', 'Edit'), array('plugin' => 'admin', 'action' => 'edit', ${$singularVar}[$modelClass][$primaryKey]), array('class' => 'btn btn-warning')); ?></td>
                    <td><?php echo $this->Form->postLink(__d('cake', 'Delete'), array('plugin' => 'admin', 'action' => 'delete', ${$singularVar}[$modelClass][$primaryKey]), array('class' => 'btn btn-danger'), __d('cake', 'Are you sure you want to delete %s %s?', $modelClass, ${$singularVar}[$modelClass][$primaryKey])); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="well">
        <?php echo $this->Paginator->counter(array('format' => __d('cake', 'Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}'))); ?>
    </div>
    <?php if ($this->Paginator->numbers()): ?>
        <div class="pagination">
            <ul>
                <?php echo $this->Paginator->first(); ?>
                <?php echo $this->Paginator->prev(); ?>
                <?php echo $this->Paginator->numbers(); ?>
                <?php echo $this->Paginator->next(); ?>
                <?php echo $this->Paginator->last(); ?>
            </ul>
        </div>
    <?php endif; ?>
</div>
