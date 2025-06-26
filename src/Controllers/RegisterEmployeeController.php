<?php

require_once __DIR__ . '/../Classes/EmployeeClass.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $action = $_POST['_action'] ?? 'POST';
  $employee = new EmployeeClass();

  if ($action === 'create') {
    // Create a new employee
    $registered = $employee->registerEmployee($_POST);
    if ($registered) {
      header('Location: /../register_employee.php?status=success');
    } else {
      header('Location: /../register_employee.php?status=error');
    }
    exit;
  } else if ($action === 'update') {
    // Update an existing employee
    $employeeId = $_POST['employee_id'] ?? 0;
    $updated = $employee->updateEmployee($employeeId, $_POST);
    if ($updated) {
      header('Location: /../list_employees.php?status=success');
    } else {
      header('Location: /../list_employees.php?status=error');
    }
    exit;
  }
}
