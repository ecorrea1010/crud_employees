<?php

require_once __DIR__ . '/../Models/EmployeesModel.php';
require_once __DIR__ . '/../Classes/EmployeeValidator.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $action = $_POST['_action'] ?? 'POST';
  $employee = new EmployeesModel();
  $validator = new EmployeeValidator();

  if ($action === 'create') {
    // Create a new employee
    $isValid = $validator->validate($_POST);
    if (!$isValid) {
      header('Location: /../register_employee.php?status=error_validation');
      exit;
    }

    $registered = $employee->registerEmployee($_POST);
    if ($registered) {
      header('Location: /../list_employees.php?status=created');
    } else {
      header('Location: /../register_employee.php?status=error');
    }
    exit;
  } else if ($action === 'update') {
    // Update an existing employee
    $employeeId = $_POST['employee_id'] ?? 0;
    $isValid = $validator->validate($_POST);

    if (!$isValid) {
      header('Location: /../edit_employee.php?employee_id=' . $employeeId . '&status=error_validation');
      exit;
    }

    $updated = $employee->updateEmployee($employeeId, $_POST);
    if ($updated) {
      header('Location: /../list_employees.php?status=updated');
    } else {
      header('Location: /../list_employees.php?status=error');
    }
    exit;
  } else if ($action === 'delete') {
    // Delete an employee
    $employeeId = $_POST['employee_id'] ?? 0;
    $deleted = $employee->deleteEmployee($employeeId);
    if ($deleted) {
      header('Location: /../list_employees.php?status=deleted');
    } else {
      header('Location: /../list_employees.php?status=error');
    }
    exit;
  }
}
