<div class="ui center aligned container">
    <div class="ui pagination menu">
        <?php
        /**
         * @var array $pagination
         * @var string $uri
         */
        foreach ((array) $pagination as $page => $cell) {
            if ($cell == 'current') {
                printf('<a class="active item">%d</a>', $page);
            } elseif ($cell == 'less' || $cell == 'more') {
                echo '<a class="disabled item">...</a>';
            } else {
                $query['page'] = $page;
                printf('<a class="item" href="%s">%d</a>', $uri . http_build_query($query), $page);
            }
        }
        ?>
    </div>
</div>