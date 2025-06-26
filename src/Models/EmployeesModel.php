<?php

require_once __DIR__ . '/../db.php';

class EmployeesModel
{
  private $db;

  public function __construct()
  {
    $this->db = DB::getInstance();
  }

  public function getAllEmployees()
  {
    $query = "
    SELECT e.id, e.name, e.last_name, e.document, e.hire_date,
      dt.name document_type_name, jt.name job_title_name, ct.name contract_type_name
    FROM employees AS e
    JOIN document_types AS dt ON e.document_type_id = dt.id
    JOIN job_titles AS jt ON e.job_title_id = jt.id
    JOIN contract_types AS ct ON e.contract_type_id = ct.id
    WHERE e.status = 1";
    return $this->db->query($query)->fetchAll(PDO::FETCH_ASSOC);
  }

  public function getEmployeeById($id)
  {
    $query = "
    SELECT e.id, e.name, e.last_name, e.document, e.hire_date,
      dt.id AS document_type_id, dt.name AS document_type_name,
      jt.id AS job_title_id, jt.name AS job_title_name,
      ct.id AS contract_type_id, ct.name AS contract_type_name
    FROM employees AS e
    JOIN document_types AS dt ON e.document_type_id = dt.id
    JOIN job_titles AS jt ON e.job_title_id = jt.id
    JOIN contract_types AS ct ON e.contract_type_id = ct.id
    WHERE e.id = :id AND e.status = 1";
    
    $stmt = $this->db->prepare($query);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    
    return $stmt->fetch(PDO::FETCH_ASSOC);
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

  public function deleteEmployee($id) {
    try {
      $stmt = $this->db->prepare("DELETE FROM employees WHERE id = :id");
      return $stmt->execute([':id' => $id]);
    } catch (PDOException $e) {
      error_log("Error deleting employee: " . $e->getMessage());
      return false;
    }
  }
}
