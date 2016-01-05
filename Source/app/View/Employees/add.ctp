<div class="employees form">
<?php echo $this->Form->create('Employee'); ?>
	<fieldset>
		<legend><?php echo __('Add Employee'); ?></legend>
	<?php
		echo $this->Form->input('employee_no');
		echo $this->Form->input('employyee_name');
		echo $this->Form->input('job');
		echo $this->Form->input('manager');
		echo $this->Form->input('hiring_date');
		echo $this->Form->input('salary');
		echo $this->Form->input('commission');
		echo $this->Form->input('department_no');
		echo $this->Form->input('creator');
		echo $this->Form->input('updater');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Employees'), array('action' => 'index')); ?></li>
	</ul>
</div>