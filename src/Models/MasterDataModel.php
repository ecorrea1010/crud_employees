<?php

require_once __DIR__ . '/../db.php';

class MasterDataModel
{
  private $db;

  public function __construct()
  {
    $this->db = DB::getInstance();
  }

  public function getDocumentTypes()
  {
    $query = "SELECT * FROM document_types";
    return $this->db->query($query)->fetchAll(PDO::FETCH_ASSOC);
  }

  public function getJobTitles()
  {
    $query = "SELECT * FROM job_titles";
    return $this->db->query($query)->fetchAll(PDO::FETCH_ASSOC);
  }

  public function getContractTypes()
  {
    $query = "SELECT * FROM contract_types";
    return $this->db->query($query)->fetchAll(PDO::FETCH_ASSOC);
  }
}
