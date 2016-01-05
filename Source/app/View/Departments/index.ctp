<div class="departments index">
	<h2><?php echo __('Departments'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('department_no'); ?></th>
			<th><?php echo $this->Paginator->sort('department_name'); ?></th>
			<th><?php echo $this->Paginator->sort('location'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('creator'); ?></th>
			<th><?php echo $this->Paginator->sort('updated'); ?></th>
			<th><?php echo $this->Paginator->sort('updater'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($departments as $department): ?>
	<tr>
		<td><?php echo h($department['Department']['department_no']); ?>&nbsp;</td>
		<td><?php echo h($department['Department']['department_name']); ?>&nbsp;</td>
		<td><?php echo h($department['Department']['location']); ?>&nbsp;</td>
		<td><?php echo h($department['Department']['created']); ?>&nbsp;</td>
		<td><?php echo h($department['Department']['creator']); ?>&nbsp;</td>
		<td><?php echo h($department['Department']['updated']); ?>&nbsp;</td>
		<td><?php echo h($department['Department']['updater']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $department['Department']['department_no'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $department['Department']['department_no'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $department['Department']['department_no']), array('confirm' => __('Are you sure you want to delete # %s?', $department['Department']['department_no']))); ?>
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
		<li><?php echo $this->Html->link(__('New Department'), array('action' => 'add')); ?></li>
	</ul>
</div>
