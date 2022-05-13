(function() {
    tinymce.PluginManager.add('popupbtn_mce_button', function( editor, url ) { // popupbtn_mce_button - ID кнопки
        editor.addButton('popupbtn_mce_button', {  // popupbtn_mce_button - ID кнопки, везде должен быть одинаковым
            text: 'Вставить кнопку вызова ФОС', // текст кнопки, если вы хотите, чтобы ваша кнопка содержала только иконку, удалите эту строку
            title: 'Вставить шорткод', // всплывающая подсказка
            icon: false, // тут можно указать любую из существующих векторных иконок в TinyMCE либо собственный CSS-класс
            onclick: function() {
                editor.insertContent(`<a aria-label="Оставить заявку" href="#callback" class="btn content__btn">Оставить заявку</a>`); 
            }
        });
    });
})();