<?php 
$attributes = array('class' => 'search', 'id' => 'semployee');
echo form_open('',$attributes); //start form

$options = array('' => '-- select');
foreach ($departments as $dep) {
	$options[$dep['dept_no']] = $dep['dept_name'];

}
?>
<div class="criteria">
	<div class="label">Search Criteria</div>
	<div class='filter'>
		<div class='item'>
			<div class="label">employee id </div> 
			<div class="input">
				<input type="number" name="filter_emp_no" value="<?php echo set_value('filter_emp_no', ''); ?>">
			</div>
		</div>
		<div class='item'>
			<div class="label">employee name </div>
			<div class="input">
				<input type="text" name="filter_emp_name" value="<?php echo set_value('filter_emp_name', ''); ?>">
			</div>
		</div>
		<div class='item'>
			<div class="label">from department </div>
			<div class="input"><?php echo form_dropdown('filter_departments', $options); ?></div>
		</div>
		<div class='item'>
			<div class="label">gender </div>
			<div class="input">
				<input type="radio" name="filter_gender" value="M" <?php echo set_radio('filter_gender', 'M'); ?> /> male
				<input type="radio" name="filter_gender" value="F" <?php echo set_radio('filter_gender', 'F'); ?> /> female
				<input type="radio" name="filter_gender" value="both" <?php echo set_radio('filter_gender', 'both', TRUE); ?>/> both
			</div>
		</div>
		<div class='item'>
			<div class="label">with salary from </div>
			<div class="input">
				<input type="number" name="filter_salary_start" id="filter_salary_start" value="<?php echo set_value('filter_salary_start', '0'); ?>"> to 
				<input type="number" name="filter_salary_end" id="filter_salary_end" value="<?php echo set_value('filter_salary_end', ''); ?>">
			</div>
		</div>
	</div>
</div>