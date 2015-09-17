<?php
class Employees_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}

	public function get_employees($data)
	{
		$query_string = '';
		$query_select = "SELECT concat(employees.last_name, ', ', employees.first_name) as 'Name' ";
		$query_from = 'employees';
		$query_filter = '';
		$salary_query = "SELECT * FROM (select emp_no as emp_hidden FROM salaries where to_date='9999-01-01' ";
		$salary_filter = '';
		$result = array();

		foreach ($data as $display => $value) {
			switch ($display) {
				case 'emp_no':
					$query_select .= ", employees.emp_no ";
					break;
				case 'birth_date':
					$query_select .= ", employees.birth_date as 'birthday' ";
					break;
				case 'gender':
					$query_select .= ", gender";
					break;
				case 'hire_date':
					$query_select .= ", hire_date as 'date hired'";
					break;
				case 'current_title':
					$query_select .= ", titles.title as 'current title'";
					$query_from .= ", titles";
					$query_filter .= " and employees.emp_no = titles.emp_no and titles.to_date ='9999-01-01' ";
					break;
				case 'current_salary':
					$query_select .= ", salaries.salary as 'current salary'";
					if (strpos($query_from, 'salaries') === false) {
						$query_from .= ", salaries";
					}
					$query_filter .= " and employees.emp_no = salaries.emp_no and salaries.to_date ='9999-01-01' ";
					break;
				case 'department':
					$query_select .= ", departments.dept_name as 'department'";
					if ($data['filter_departments'] == ''){						
						if (strpos($query_from, 'dept_emp') === false) {
							$query_from .= ", dept_emp";
						}
						if (strpos($query_from, 'departments') === false) {
							$query_from .= ", departments";
						}
						$query_filter .= " and (dept_emp.emp_no = employees.emp_no and dept_emp.dept_no=departments.dept_no and dept_emp.to_date='9999-01-01')";
					}
					break;
				case 'department_manager':
					$query_select .= ", dept_head.department_head AS  'department manager'";
					if (strpos($query_from, 'departments') === false) {
						$query_from .= ", departments";
					}
					$query_from .= ", (SELECT CONCAT( employees.last_name,  ', ', employees.first_name ) AS  'department_head', departments.dept_name
						FROM employees
						JOIN dept_manager ON employees.emp_no = dept_manager.emp_no
						JOIN departments ON departments.dept_no = dept_manager.dept_no
						WHERE dept_manager.to_date =  '9999-01-01') AS dept_head";
					$query_filter .= ' and departments.dept_name = dept_head.dept_name';
					break;
				case 'filter_emp_no':
					if ($value == '') break;
					$query_filter .= " and employees.emp_no = '$value'";
					break;
				case 'filter_emp_name':
					if ($value == '') break;
					$name = explode(' ', $value);
					foreach ($name as $n) {
						$query_filter .= " and (employees.last_name like '%$n%' or employees.first_name like '%$n%')";
					}
					break;
				case 'filter_departments':
					if ($value == '') break;
					if (strpos($query_from, 'dept_emp') === false) {
						$query_from .= ", dept_emp";
					}
					if (strpos($query_from, 'departments') === false) {
						$query_from .= ", departments";
					}
					$query_filter .= " and (dept_emp.dept_no = '$value' and dept_emp.to_date='9999-01-01' and dept_emp.emp_no=employees.emp_no and dept_emp.dept_no=departments.dept_no)";
					break;
				case 'filter_gender':
					if ($value == '' or $value == 'both') break;
					$query_filter .= " and employees.gender='$value'";
					break;
				case 'filter_salary_start':
					if ($value == '0' or $value == '') break;
					if (FALSE == array_key_exists('emp_no',$data)) {
						$query_select .= ", employees.emp_no ";
					}
					$salary_filter .= " and salary >= '$value'";
					break;
				case 'filter_salary_end':
					if ($value == '0' or $value == '') break;
					if (FALSE == array_key_exists('emp_no',$data)) {
						$query_select .= ", employees.emp_no ";
					}
					$salary_filter .= " and salary <= '$value'";
					break;
				case '':
					$query_select .= "";
					break;
			}
		}

		$query_string = $query_select . ' FROM ' . $query_from . ' WHERE 1 ' . $query_filter;

		if ($salary_filter !== '') { //join 2 queries
			$salary_query .= $salary_filter . ") AS sueldo INNER JOIN ($query_string) AS employ ON employ.emp_no=sueldo.emp_hidden";
			$query_string = $salary_query;
		}

		$query_string .= ' LIMIT 15';

		$query = $this->db->query($query_string);
		$result['sql'] = $query_string;
		$result['basic_info'] = $query->result_array();

		return $result;
	}

	public function get_departments()
	{
		$query = $this->db->get('departments');
		return $query->result_array();

	}
}