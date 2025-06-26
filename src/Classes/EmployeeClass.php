<?php

require_once __DIR__ . '/../db.php';

class EmployeeClass {
  private $db;

  public function __construct() {
    $this->db = DB::getInstance();
  }

  public function registerEmployee($data) {

    try {
      $stmt = $this->db->prepare("
      INSERT INTO employees (name, last_name, document_type_id, document, job_title_id, contract_type_id, hire_date)
      VALUES (:name, :last_name, :document_type_id, :document, :job_title_id, :contract_type_id, :hire_date)
      ");

      return $stmt->execute([
        ':name' => $data['employee_name'],
        ':last_name' => $data['employee_lastname'],
        ':document_type_id' => $data['employee_document_type'],
        ':document' => $data['employee_document'],
        ':job_title_id' => $data['employee_job_title'],
        ':contract_type_id' => $data['employee_contract_type'],
        ':hire_date' => $data['employee_hire_date'],
      ]);

    } catch (PDOException $e) {
      error_log("Error registering employee: " . $e->getMessage());
      return false;
    }
  }

  public function updateEmployee($id, $data) {
    try {
      $stmt = $this->db->prepare("
      UPDATE employees
      SET name = :name,
          last_name = :last_name,
          document_type_id = :document_type_id,
          document = :document,
          job_title_id = :job_title_id,
          contract_type_id = :contract_type_id,
          hire_date = :hire_date
      WHERE id = :id
      ");

      return $stmt->execute([
        ':id' => $id,
        ':name' => $data['employee_name'],
        ':last_name' => $data['employee_lastname'],
        ':document_type_id' => $data['employee_document_type'],
        ':document' => $data['employee_document'],
        ':job_title_id' => $data['employee_job_title'],
        ':contract_type_id' => $data['employee_contract_type'],
        ':hire_date' => $data['employee_hire_date'],
      ]);

    } catch (PDOException $e) {
      error_log("Error updating employee: " . $e->getMessage());
      return false;
    }
  }
}
