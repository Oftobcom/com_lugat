<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted Access');
?>
<?php foreach($this->items as $i => $item): ?>
	<tr class="row<?php echo $i % 2; ?>">
		<td>
			<?php echo $item->term; ?>
		</td>
		<td>
			<?php echo $item->_count; ?>
		</td>
	</tr>
<?php endforeach; ?>
