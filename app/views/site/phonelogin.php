
<h1>Вход</h1>

<div class="form">
    <?php
    $form = $this->beginWidget('CActiveForm',
            array(
        'id' => 'phone-login-form',
        'enableClientValidation' => true,
        'clientOptions' => array(
            'validateOnSubmit' => true,
        ),
    ));
    ?>
    <?php if (Yii::app()->user->hasFlash('error')) : ?>

    <?php endif; ?>


    <div class="row">
        <?php echo $form->labelEx($model, 'username'); ?>
        <?php echo $form->textField($model, 'username'); ?>
        <?php echo $form->error($model, 'username'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton('Login'); ?>
    </div>

    <?php $this->endWidget(); ?>
</div><!-- form -->

