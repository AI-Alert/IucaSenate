<div class="popup" id="callback">		

    <button class="popup__close"><img src="<?= _assets(); ?>/img/close.svg" alt="Закрыть" class="svg"></button>	

    <div class="popup__title">Оставьте заявку</div>			
    <div class="popup__subtitle">и в ближайшее время с Вами свяжется наш специалист</div>			

    <?= do_shortcode('[contact-form-7 id="241" title="Всплывающая ФОС" html_class="form"]'); ?>

</div>

<script>                            
    document.querySelector('#callback  .check-wrapper .wpcf7-list-item > label').classList.add('custom-checkbox');
    document.querySelector('#callback  .check-wrapper .custom-checkbox').insertBefore(document.createElement('span'), document.querySelector('#callback .check-wrapper .wpcf7-list-item .custom-checkbox .wpcf7-list-item-label'));
    document.querySelector('#callback  .check-wrapper .wpcf7-list-item > label > input').classList.add('input-check');

    document.querySelector(".wpcf7-form-control-wrap.file-251").classList.add('file-upload');
    //document.querySelector('.wpcf7-form-control-wrap.file-251').appendChild(document.querySelector(".wpcf7-form-control-wrap.file-251"));

    let label = document.createElement('label');
    label.setAttribute('for','file'); 
    label.classList.add('btn');
    label.classList.add('btn--bdr');
    label.classList.add('file-upload__btn');
    label.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" class="svg replaced-svg" viewBox="0 0 24 24"><path d="M16.5 6v11.5c0 2.21-1.79 4-4 4s-4-1.79-4-4V5a2.5 2.5 0 015 0v10.5c0 .55-.45 1-1 1s-1-.45-1-1V6H10v9.5a2.5 2.5 0 005 0V5c0-2.21-1.79-4-4-4S7 2.79 7 5v12.5c0 3.04 2.46 5.5 5.5 5.5s5.5-2.46 5.5-5.5V6h-1.5z" fill="#E9952F"></path></svg>План помещения`;
    document.querySelector(".wpcf7-form-control-wrap.file-251").appendChild(label);
</script>