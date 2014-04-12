<?php
/**
 * The following variables are available in this template:
 * - $this: the CrudCode object
 */
?>
<?php echo "<?php\n"; ?>
/* @var $this <?php echo $this->getControllerClass(); ?> */
/* @var $model <?php echo $this->getModelClass(); ?> */
/* @var $form CActiveForm */
?>



<?php echo "<?php \$form=\$this->beginWidget('CActiveForm', array(
	'id'=>'".$this->class2id($this->modelClass)."-form',
	'enableAjaxValidation'=>false,
        'htmlOptions'=>array('class'=>'form-horizontal')
)); ?>\n"; ?>

<?='<?if(\$model->hasErrors()):?>'?>
<div class="alert alert-error">

	<?php echo "<?php echo \$form->errorSummary(\$model); ?>\n"; ?>
</div>
<?='<? endif;?>'?>

<?php
foreach($this->tableSchema->columns as $column)
{
	if($column->autoIncrement)
		continue;
?>
 <div class="control-group">
		<?php echo "<?php echo \$form->labelEx(\$model,'{$column->name}',array('class'=>'control-label')); ?>\n"; ?>
     <div class="controls">
		<?php echo "<?php echo ".$this->generateActiveField($this->modelClass,$column)."; ?>\n"; ?>
		<?php echo "<?php echo \$form->error(\$model,'{$column->name}'); ?>\n"; ?>
     </div>
</div>
<?php
}
?>
 <div class="control-group">
	<div class="controls">
		<?php echo "<?php echo CHtml::submitButton(\$model->isNewRecord ? 'Создать' : 'Сохранить',array('class'=>'btn')); ?>\n"; ?>
	</div>
</div>
<?php echo "<?php \$this->endWidget(); ?>\n"; ?>

