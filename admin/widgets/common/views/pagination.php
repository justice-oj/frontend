<nav>
    <ul class="pagination justify-content-center">
        <?php
        /**
         * @var array $pagination
         * @var string $uri
         * @var array $query
         */
        foreach ((array)$pagination as $page => $cell) {
            if ($cell == 'current') {
                printf('<li class="page-item disabled"><a class="page-link" href="#" tabindex="-1">%d</a></li>', $page);
            } elseif ($cell == 'less' || $cell == 'more') {
                echo '<li class="page-item disabled"><span><a class="page-link" href="#" tabindex="-1">...</a></span></li>';
            } else {
                $query['page'] = $page;
                printf('<li class="page-item"><a class="page-link" href="%s">%d</a></li>', $uri . http_build_query($query), $page);
            }
        }
        ?>
    </ul>
</nav>