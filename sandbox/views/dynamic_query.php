<?php //echo print_r($employees)
if ($employees['sql'] != ''): ?>
<div class="query">
	<div class="label">Query used: </div>
	<div class="sql"><?php echo $employees['sql']; ?></div>
</div>
<?php endif ?>
<div class="result">
<?php foreach ($employees['basic_info'] as $emp): ?>
	
		<div class="employee">  
		<?php foreach ($emp as $key => $value): ?>		
			<div class="info">  	
			<?php echo $key  ?>: <?php echo $value  ?> 
			</div>
		<?php endforeach ?>
		</div>
<?php endforeach ?>
</div>