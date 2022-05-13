<?php
//Template Name: Главная страница
get_header();

$arParams = carbon_get_the_post_meta( 'front_page' );
?>

<main class="main">

    
    <?php
       foreach($arParams as $arItem):

           get_template_part('template-parts/'.$arItem['_type'], NULL, $arItem);

       endforeach;
    ?>


              

               

                
                


 

                            



			
<!-- 
				<div class="section seo">
					<div class="container">
						<div class="section-title">СЕО</div>
						<div class="seo__text format-text">
							<p>Как принято считать, стремящиеся вытеснить традиционное производство, нанотехнологии, инициированные исключительно синтетически, в равной степени предоставлены сами себе. Имеется спорная точка зрения, гласящая примерно следующее: многие известные личности и по сей день остаются уделом либералов, которые жаждут быть своевременно верифицированы. Идейные соображения высшего порядка, а также постоянный количественный рост и сфера нашей активности требует определения и уточнения новых предложений.</p>
						</div>
					</div>
				</div> -->



</main>

<!-- <main class="main">
<div class="not-found">
    <div class="container">	
        <div class="not-found-block">		
            <img src="<?= _assets(); ?>/img/404.png" alt="404">											
            <div class="not-found__title">Страница не найдена <br>или удалена</div>
            <a href="/" class="not-found__back">Вернуться на главную страницу</a>
        </div>								
    </div>
</div>

</main> -->



<?php

get_footer();

?>