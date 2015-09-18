<?php //echo print_r($employees)
$th = array();
if (0 < count($employees['basic_info'])) { //get table labels and exclude emp_hidden
	unset($employees['basic_info'][0]['emp_hidden']);
	foreach ($employees['basic_info'][0] as $key => $value) {
		$th[] = $key;
	}
}

?>
<?php if ($employees['sql'] != ''): ?>
<div class="query">
	<div class="label">Query used: </div>
	<div class="sql"><?php echo $employees['sql']; ?></div>
</div>
<?php endif ?>
<?php if (0 < count($employees['basic_info'])): ?>

<div class="result">
	<table align="center">
		<tr>
			<?php foreach ($th as $t): ?>
			<th><?php echo $t ?></th>
			<?php endforeach ?>
		</tr>
	<?php foreach ($employees['basic_info'] as $emp): 
	unset($emp['emp_hidden']); ?>
	
		<tr>  
		<?php foreach ($emp as $key => $value): ?>		
			<td>  	
				<?php echo $value  ?> 
			</td>
		<?php endforeach ?>
		</tr>
	<?php endforeach ?>
	</table>
</div>

<?php endif ?>