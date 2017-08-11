<nav>
    <ul class="pagination">
        <?php
        foreach ((array) $pagination as $page => $cell) {
            if ($cell == 'current') {
                printf('<li class="active"><span>%d</span></li>', $page);
            } elseif ($cell == 'less' || $cell == 'more') {
                echo '<li class="disabled"><span>...</span></li>';
            } else {
                $query['page'] = $page;
                printf('<li><a href="%s">%d</a></li>', $uri . http_build_query($query), $page);
            }
        }
        ?>
    </ul>
</nav>