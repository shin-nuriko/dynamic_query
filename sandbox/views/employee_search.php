<?php
$limits = array(
	'15' => '15',
	'30' => '30',
	'60' => '60',
	'100' => '100'
	);
?>
	<div class='query_show'>
	<div class='label'>Show</div>
	<div class='choices'>
		<div class='item'>
			<input type="checkbox" name="emp_no" id="emp_no" value="1" <?php echo set_checkbox('emp_no', '1'); ?> />
			employee no.
		</div>
		<div class='item'>
			<input type="checkbox" name="birth_date" value="1" <?php echo set_checkbox('birth_date', '1'); ?> />
			birthday
		</div>
		<div class='item'>
			<input type="checkbox" name="gender" value="1" <?php echo set_checkbox('gender', '1'); ?> />
			gender
		</div>
		<div class='item'>
			<input type="checkbox" name="hire_date" value="1" <?php echo set_checkbox('hire_date', '1'); ?> />
			date hired
		</div>
		<div class='item'>
			<input type="checkbox" name="current_title" value="1"  <?php echo set_checkbox('current_title', '1'); ?>/>
			current title
		</div>
		<div class='item'>
			<input type="checkbox" name="current_salary" value="1"  <?php echo set_checkbox('current_salary', '1'); ?>/>
			current salary
		</div>
		<div class='item'>
			<input type="checkbox" name="department" value="1"  <?php echo set_checkbox('department', '1'); ?> />
			department
		</div>
		<div class='item'>
			<input type="checkbox" name="department_manager" value="1" <?php echo set_checkbox('department_manager', '1'); ?> />
			department manager
		</div>
		<div class='item'>
			display results <?php echo form_dropdown('limits', $limits); ?>
		</div>
		<div class='item'>
			<input type="checkbox" name="sort_name" value="1" <?php echo set_checkbox('sort_name', '1', TRUE); ?> />
			sort by employee name
		</div>
	</div>
	<div class="buttons">
		<input type="submit" name="submit_query" value="Go Search!" class="submit" />
	</div>
</div>
</form>