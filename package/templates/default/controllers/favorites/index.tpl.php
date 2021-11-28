<?php
    $this->setPageTitle(LANG_FAVORITES_CONTROLLER);
    $this->addBreadcrumb(LANG_FAVORITES_CONTROLLER);
?>

<h1><?php echo LANG_FAVORITES_CONTROLLER; ?></h1>

<div id="favorites_pills">
    <?php $this->menu('results_tabs', true, 'pills-menu favorites__pills'); ?>
</div>

<?php echo $html; ?>