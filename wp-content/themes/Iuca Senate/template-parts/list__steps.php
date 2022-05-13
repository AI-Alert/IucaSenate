<?php
$arResult = [
	'title' => [
		'state' => $args['title_state'],
		'text' => $args['title'],
	],
	'content' => apply_filters('the_content', $args['content']),
	'steps' => $args['steps'],
];

?>

<div class="section section--dark steps" style="background-image: url('<?= _assets(); ?>/img/steps-bg.png');">
	<div class="container">
		<?php if($arResult['title']['text']): ?>
			<<?= $arResult['title']['state']; ?> class="section-title">
				<?= $arResult['title']['text']; ?>
			</<?= $arResult['title']['state']; ?>>
		<?php endif; ?>
		<?php if($arResult['content']): ?>
		<div class="section-info format-text">
			<?= $arResult['content'] ?>		
		</div>
		<?php endif; ?>
		<?php if($arResult['steps']): ?>
		<div class="steps-block">
			<?php $n = 1; foreach ($arResult['steps'] as $item): ?>
			<div class="step">							
				<div class="step__info">
					<div class="step__title"><?= $item['title']; ?></div>
					<div class="step__text format-text">
						<p><?= $item['text']; ?></p>
					</div>	
					<?php if($n == 1): ?>
					<button data-href="#callback" class="btn btn--bdr">Оставить заявку</button>		
					<?php endif; ?>					
				</div>							
			</div>

			<?php $n++; endforeach; ?>
		</div>
		<?php endif; ?>
	</div>
</div>	




					

			















