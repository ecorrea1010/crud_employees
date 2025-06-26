<?php

require_once __DIR__ . '/../db.php';

class EmployeeValidator {
  
  public function validate($data) {

    $valid = true;

    if (empty($data['employee_name']) || !preg_match('/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/', $data['employee_name'])) {
      $valid = false;
    }

    if (empty($data['employee_lastname']) || !preg_match('/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/', $data['employee_lastname'])) {
      $valid = false;
    }

    if (empty($data['employee_document_type'])) {
      $valid = false;
    }

    if (empty($data['employee_document']) || !preg_match('/^\d+$/', $data['employee_document'])) {
      $valid = false;
    }

    if (empty($data['employee_job_title'])) {
      $valid = false;
    }

    if (empty($data['employee_contract_type'])) {
      $valid = false;
    }

    if (empty($data['employee_hire_date'])) {
      $valid = false;
    }

    return $valid;
  }
}
