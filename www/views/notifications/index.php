<?php

use www\widgets\common\GoogleAdSenseWidget;
use www\widgets\common\PaginationWidget;

?>

<div class="ui basic segment">
    <?= GoogleAdSenseWidget::widget() ?>
</div>
<h2 class="ui header">Notifications</h2>
<div class="ui very relaxed list">
    <?php
    foreach ($notices as $notice) {
        echo <<< NOTICE
        {$notice}
NOTICE;
    }
    ?>
</div>
<?= PaginationWidget::widget(['pagination' => $pagination]) ?>
<div class="ui basic segment">
    <?= GoogleAdSenseWidget::widget() ?>
</div>