<?php
/**
 * Scaffold View
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
            <li><?php echo $this->Html->link(__d('cake', 'Edit %s', $singularHumanName),   array('plugin' => 'admin', 'action' => 'edit', ${$singularVar}[$modelClass][$primaryKey])); ?></li>
            <li><?php echo $this->Html->link(__d('cake', 'Delete %s', $singularHumanName), array('plugin' => 'admin', 'action' => 'delete', ${$singularVar}[$modelClass][$primaryKey]), null, __d('cake', 'Are you sure you want to delete #%s?', ${$singularVar}[$modelClass][$primaryKey])); ?></li>
            <li><?php echo $this->Html->link(__d('cake', 'List %s', str_replace('Admin ', '', $pluralHumanName)), array('plugin' => 'admin', 'action' => 'index')); ?></li>
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
        <h1><?php echo __d('cake', 'View %s', $singularHumanName); ?></h1>
    </div>
    <dl>
        <?php foreach ($scaffoldFields as $_field): ?>
            <?php $isKey = false; ?>
            <?php if (!empty($associations['belongsTo'])): ?>
                <?php foreach ($associations['belongsTo'] as $_alias => $_details): ?>
                    <?php if ($_field === $_details['foreignKey']): ?>
                        <?php $isKey = true; ?>
                        <dt><?php echo Inflector::humanize($_alias); ?></dt>
                        <dd><?php echo $this->Html->link(${$singularVar}[$_alias][$_details['displayField']], array('plugin' => 'admin', 'controller' => $_details['controller'], 'action' => 'view', ${$singularVar}[$_alias][$_details['primaryKey']])); ?></dd>
                        <?php break; ?>
                    <?php endif; ?>
                <?php endforeach; ?>
            <?php endif; ?>
            <?php if ($isKey !== true): ?>
                <dt><?php echo Inflector::humanize($_field); ?></dt>
                <dd><?php echo h(${$singularVar}[$modelClass][$_field]); ?></dd>
            <?php endif; ?>
        <?php endforeach; ?>
    </dl>
    <?php if (!empty($associations['hasOne'])): ?>
        <?php foreach ($associations['hasOne'] as $_alias => $_details): ?>
            <div>
                <h2><?php echo __d('cake', "Related %s", Inflector::humanize($_details['controller'])); ?></h2>
                <?php if (!empty(${$singularVar}[$_alias])): ?>
                    <dl>
                        <?php $otherFields = array_keys(${$singularVar}[$_alias]); ?>
                        <?php foreach ($otherFields as $_field): ?>
                            <dt><?php echo Inflector::humanize($_field); ?></dt>
                            <dd><?php echo ${$singularVar}[$_alias][$_field]; ?></dd>
                        <?php endforeach; ?>
                    </dl>
                <?php endif; ?>
                <div class="actions well">
                    <?php echo $this->Html->link(__d('cake', 'Edit %s', Inflector::humanize(Inflector::underscore($_alias))), array('plugin' => 'admin', 'controller' => $_details['controller'], 'action' => 'edit', ${$singularVar}[$_alias][$_details['primaryKey']]), array('class' => 'btn primary')); ?>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
    <?php if (empty($associations['hasMany'])): ?>
        <?php $associations['hasMany'] = array(); ?>
    <?php endif; ?>
    <?php if (empty($associations['hasAndBelongsToMany'])): ?>
        <?php $associations['hasAndBelongsToMany'] = array(); ?>
    <?php endif; ?>
    <?php $relations = array_merge($associations['hasMany'], $associations['hasAndBelongsToMany']); ?>
    <?php foreach ($relations as $_alias => $_details): ?>
        <?php $otherSingularVar = Inflector::variable($_alias); ?>
        <div>
            <h2><?php echo __d('cake', "Related %s", Inflector::humanize($_details['controller'])); ?></h2>
            <?php if (!empty(${$singularVar}[$_alias])): ?>
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <?php $otherFields = array_keys(${$singularVar}[$_alias][0]); ?>
                            <?php if (isset($_details['with'])): ?>
                                <?php $index = array_search($_details['with'], $otherFields); ?>
                                <?php unset($otherFields[$index]); ?>
                            <?php endif; ?>
                            <?php foreach ($otherFields as $_field): ?>
                                <th><?php echo Inflector::humanize($_field); ?></th>
                            <?php endforeach; ?>
                            <th colspan="3"><?php echo __d('cake', 'Actions'); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach (${$singularVar}[$_alias] as ${$otherSingularVar}): ?>
                            <tr>
                                <?php foreach ($otherFields as $_field): ?>
                                    <td><?php echo ${$otherSingularVar}[$_field]; ?></td>
                                <?php endforeach; ?>
                                <td><?php echo $this->Html->link(__d('cake', 'View'), array('plugin' => 'admin', 'controller' => $_details['controller'], 'action' => 'view', ${$otherSingularVar}[$_details['primaryKey']]), array('class' => 'btn btn-info')); ?></td>
                                <td><?php echo $this->Html->link(__d('cake', 'Edit'), array('plugin' => 'admin', 'controller' => $_details['controller'], 'action' => 'edit', ${$otherSingularVar}[$_details['primaryKey']]), array('class' => 'btn btn-warning')); ?></td>
                                <td><?php echo $this->Html->link(__d('cake', 'Delete'), array('plugin' => 'admin', 'controller' => $_details['controller'], 'action' => 'delete', ${$otherSingularVar}[$_details['primaryKey']]), array('class' => 'btn btn-danger'), __d('cake', 'Are you sure you want to delete %s %s?', Inflector::humanize(Inflector::underscore($_alias)), ${$otherSingularVar}[$_details['primaryKey']])); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
            <div class="well">
                <?php echo $this->Html->link(__d('cake', "New %s", Inflector::humanize(Inflector::underscore($_alias))), array('plugin' => 'admin', 'controller' => $_details['controller'], 'action' => 'add'), array('class' => 'btn btn-primary')); ?>
            </div>
        </div>
    <?php endforeach;?>
</div>
