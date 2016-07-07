<?php
use common\models\Banners;

/** @var Banners $leftBanner */
$leftBanner;
/** @var Banners $rightBanner */
$rightBanner;
?>

<aside class="sidebar-left sidebar">
    <?php foreach ($leftBanners as $leftBanner): ?>
        <a href="<?= $leftBanner->link; ?>" class="sidebar-banner">
            <img src="<?= $leftBanner->getImg(); ?>" onerror="src=&quot;/images/banner.png&quot;">
        </a>
    <?php endforeach; ?>
</aside>
<aside class="sidebar-right sidebar">
    <?php foreach ($rightBanners as $rightBanner): ?>
        <a href="<?= $rightBanner->link; ?>" class="sidebar-banner">
            <img src="<?= $rightBanner->getImg(); ?>" onerror="src=&quot;/images/banner.png&quot;">
        </a>
    <?php endforeach; ?>
</aside>