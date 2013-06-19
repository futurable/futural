<?php echo CHtml::form(); ?>
    <div id="langdrop">
        <?php echo CHtml::dropDownList('_lang', $currentLang, array(
            'en' => 'English', 'fi' => 'Finnish'), array('submit' => '')); ?>
    </div>
<?php echo CHtml::endForm(); ?>