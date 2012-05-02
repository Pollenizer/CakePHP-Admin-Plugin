<?php
/**
 * Admin Index
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
<ul class="nav nav-pills nav-stacked">
    <?php foreach ($navbar as $nav): ?>
        <li><?php echo $this->Html->link($nav['title'], $nav['url']); ?></li>
    <?php endforeach; ?>
</ul>
