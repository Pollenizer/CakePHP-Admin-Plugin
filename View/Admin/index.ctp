<ul class="nav nav-pills nav-stacked">
    <?php foreach ($navbar as $nav): ?>
        <li><?php echo $this->Html->link($nav['title'], $nav['url']); ?></li>
    <?php endforeach; ?>
</ul>
