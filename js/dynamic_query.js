$(document).ready(function(){
	$("#filter_salary_start").change(function(){
		if ($('#filter_salary_start').prop('value') != '0') {
			$('#emp_no').prop('checked', true);
		}
	});
	$("#filter_salary_end").change(function(){
		if ($('#filter_salary_end').prop('value') != '0') {
			$('#emp_no').prop('checked', true);
		}
	});
});