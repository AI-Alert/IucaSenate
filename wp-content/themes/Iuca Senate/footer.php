    <?php

        get_template_part('template-parts/footer/template');

    ?>


    <?php

        wp_footer();

    ?>

<!-- .wrap end -->
</div>

<?= carbon_get_theme_option( 'addones' ); ?>


<?php get_template_part('template-parts/up-button/template'); ?>


<div class="hidden">

    <?php

    get_template_part('template-parts/popup/callback');
    get_template_part('template-parts/popup/thanks');

    ?>

</div>



</body>
</html>