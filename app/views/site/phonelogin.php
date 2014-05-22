<div class="b-wrapper ">
<div class="b-header">
        <div class="b-header__contenter">
            <div class="b-header__logo">

            </div>
            <div class="b-header__auth">

            </div>
        </div>
</div>
<div class="b-contener">       
    <div class="b-main-loginform">
        <h2>Вход</h2>
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
            <?=Yii::app()->user->getFlash('error')?>
        <?php endif; ?>


        <div class="row">
            <?php echo $form->labelEx($model, 'username', ['class' => 'b-loginform__label']); ?>
            <?php echo $form->textField($model, 'username',['class'=>'b-loginform__input']); ?>
            <?php echo $form->error($model, 'username', ['class' => 'b-loginform__errormessage b-loginform__errormessage_red']); ?>
        </div>

        <div class="row b-loginform__buttons">
            <?php echo CHtml::submitButton('Вход', ['class' => 'b-butons b-butons__green b-butons__title']); ?>
        </div>

        <?php $this->endWidget(); ?>
    </div><!-- form -->
</div>
