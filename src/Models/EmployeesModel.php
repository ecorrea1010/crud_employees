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
}