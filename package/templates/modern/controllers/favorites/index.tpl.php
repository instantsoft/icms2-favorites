<?php

    $this->setPageTitle(LANG_FAVORITES_CONTROLLER);

    $this->addBreadcrumb(LANG_FAVORITES_CONTROLLER);

    $this->addTplJSNameFromContext('vendors/slick/slick.min');
    $this->addTplCSSNameFromContext('slick');
?>

<h1><?php echo LANG_FAVORITES_CONTROLLER; ?></h1>

<div id="favorites_pills">
    <?php $this->menu('results_tabs', true, 'nav nav-pills favorites__pills mb-3 mb-md-4'); ?>
</div>

<?php echo $html; ?>
<?php ob_start(); ?>
<script>
    icms.menu.initSwipe('.favorites__pills', {initialSlide: $('.favorites__pills > li.is-active').index()});
</script>
<?php $this->addBottom(ob_get_clean()); ?>