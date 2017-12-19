<?php

use www\widgets\common\GoogleAdSenseWidget;
use www\widgets\common\PaginationWidget;

?>

<div class="ui basic segment">
    <?= /** @noinspection PhpUnhandledExceptionInspection */ GoogleAdSenseWidget::widget() ?>
</div>
<h2 class="ui header">Notifications</h2>
<div class="ui very relaxed list">
    <?php
    /** @var array $notices */
    foreach ($notices as $notice) {
        echo <<< NOTICE
        {$notice}
NOTICE;
    }
    ?>
</div>
<?= /** @noinspection PhpUnhandledExceptionInspection */
/** @var array $pagination */
PaginationWidget::widget(['pagination' => $pagination]) ?>
<div class="ui basic segment">
    <?= /** @noinspection PhpUnhandledExceptionInspection */ GoogleAdSenseWidget::widget() ?>
</div>