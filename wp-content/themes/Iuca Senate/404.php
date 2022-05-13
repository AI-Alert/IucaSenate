<?php

get_header();

?>


<main class="main">				

    <div class="not-found" style="background-image: url('<?= _assets(); ?>/img/404.jpg');">

        <div class="container">	
            <div class="not-found-block">														
                <div class="not-found__title">Страница <br>не найдена</div>
                <div class="not-found__back">Вернуться на <a href="/">главную страницу</a></div>
            </div>								
        </div>
    </div>

</main>


<?php

get_footer();

?>