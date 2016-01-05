<div class="employees view">
<h2><?php echo __('Employee'); ?></h2>
	<dl>
		<dt><?php echo __('Employee No'); ?></dt>
		<dd>
			<?php echo h($employee['Employee']['employee_no']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Employyee Name'); ?></dt>
		<dd>
			<?php echo h($employee['Employee']['employyee_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Job'); ?></dt>
		<dd>
			<?php echo h($employee['Employee']['job']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Manager'); ?></dt>
		<dd>
			<?php echo h($employee['Employee']['manager']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Hiring Date'); ?></dt>
		<dd>
			<?php echo h($employee['Employee']['hiring_date']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Salary'); ?></dt>
		<dd>
			<?php echo h($employee['Employee']['salary']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Commission'); ?></dt>
		<dd>
			<?php echo h($employee['Employee']['commission']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Department No'); ?></dt>
		<dd>
			<?php echo h($employee['Employee']['department_no']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($employee['Employee']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Creator'); ?></dt>
		<dd>
			<?php echo h($employee['Employee']['creator']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Updated'); ?></dt>
		<dd>
			<?php echo h($employee['Employee']['updated']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Updater'); ?></dt>
		<dd>
			<?php echo h($employee['Employee']['updater']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Employee'), array('action' => 'edit', $employee['Employee']['employee_no'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Employee'), array('action' => 'delete', $employee['Employee']['employee_no']), array('confirm' => __('Are you sure you want to delete # %s?', $employee['Employee']['employee_no']))); ?> </li>
		<li><?php echo $this->Html->link(__('List Employees'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Employee'), array('action' => 'add')); ?> </li>
	</ul>
</div>
