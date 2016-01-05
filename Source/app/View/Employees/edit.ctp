<div class="employees form">
<?php echo $this->Form->create('Employee'); ?>
	<fieldset>
		<legend><?php echo __('Edit Employee'); ?></legend>
	<?php
		echo $this->Form->input('employee_no');
		echo $this->Form->input('employyee_name');
		echo $this->Form->input('job');
		echo $this->Form->input('manager', array(
			'options' => $managers,
			'empty' => __('choose one'),
		));
		echo $this->Form->input('hiring_date');
		echo $this->Form->input('salary');
		echo $this->Form->input('commission');
		echo $this->Form->input('department_no',array(
			'options' => $departments,
			'empty' => __('choose one'),
		));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Employee.employee_no')), array('confirm' => __('Are you sure you want to delete # %s?', $this->Form->value('Employee.employee_no')))); ?></li>
		<li><?php echo $this->Html->link(__('List Employees'), array('action' => 'index')); ?></li>
	</ul>
</div>
