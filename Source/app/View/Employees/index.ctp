<div class="employees index">
	<h2><?php echo __('Employees'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('employee_no'); ?></th>
			<th><?php echo $this->Paginator->sort('employyee_name'); ?></th>
			<th><?php echo $this->Paginator->sort('job'); ?></th>
			<th><?php echo $this->Paginator->sort('manager'); ?></th>
			<th><?php echo $this->Paginator->sort('hiring_date'); ?></th>
			<th><?php echo $this->Paginator->sort('salary'); ?></th>
			<th><?php echo $this->Paginator->sort('commission'); ?></th>
			<th><?php echo $this->Paginator->sort('department_no'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('creator'); ?></th>
			<th><?php echo $this->Paginator->sort('updated'); ?></th>
			<th><?php echo $this->Paginator->sort('updater'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($employees as $employee): ?>
	<tr>
		<td><?php echo h($employee['Employee']['employee_no']); ?>&nbsp;</td>
		<td><?php echo h($employee['Employee']['employyee_name']); ?>&nbsp;</td>
		<td><?php echo h($employee['Employee']['job']); ?>&nbsp;</td>
		<td><?php echo h($employee['Manager']['employyee_name']); ?>&nbsp;</td>
		<td><?php echo h($employee['Employee']['hiring_date']); ?>&nbsp;</td>
		<td><?php echo h($employee['Employee']['salary']); ?>&nbsp;</td>
		<td><?php echo h($employee['Employee']['commission']); ?>&nbsp;</td>
		<td><?php echo h($employee['Department']['department_name']); ?>&nbsp;</td>
		<td><?php echo h($employee['Employee']['created']); ?>&nbsp;</td>
		<td><?php echo h($employee['Employee']['creator']); ?>&nbsp;</td>
		<td><?php echo h($employee['Employee']['updated']); ?>&nbsp;</td>
		<td><?php echo h($employee['Employee']['updater']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $employee['Employee']['employee_no'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $employee['Employee']['employee_no'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $employee['Employee']['employee_no']), array('confirm' => __('Are you sure you want to delete # %s?', $employee['Employee']['employee_no']))); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</tbody>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
		'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Employee'), array('action' => 'add')); ?></li>
	</ul>
</div>
