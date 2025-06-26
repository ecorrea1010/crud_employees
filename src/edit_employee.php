<?php
require 'db.php';
require_once __DIR__ . '/Models/MasterDataModel.php';
require_once __DIR__ . '/Models/EmployeesModel.php';

$masterDataModel = new MasterDataModel();
$documentTypes = $masterDataModel->getDocumentTypes();
$jobTitles = $masterDataModel->getJobTitles();
$contractTypes = $masterDataModel->getContractTypes();

$employeId = isset($_GET['id']) ? intval($_GET['id']) : 0;
$employeesModel = new EmployeesModel();
$employeeData = $employeId ? $employeesModel->getEmployeeById($employeId) : null;
$message = '';

if (isset($_GET['status'])) {
    if ($_GET['status'] === 'error') {
        $message = '<div class="alert alert-danger">Error al registrar empleado.</div>';
    } elseif ($_GET['status'] === 'error_validation') {
        $message = '<div class="alert alert-warning">Error de validación. Por favor, complete todos los campos correctamente.</div>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Employee</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Editar empleado</h1>
        <?php if ($message): ?>
            <?= $message ?>
        <?php endif; ?>
        <form action="/Controllers/RegisterEmployeeController.php" method="POST">
            <input type="hidden" name="employee_id" value="<?= htmlspecialchars($employeeData['id'] ?? '') ?>">
            <input type="hidden" name="_action" value="update">
            <!-- Fila 1: Nombres y Apellidos -->
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="employee_name" class="form-label">Nombres: <span class="text-danger">*</span></label>
                    <input type="text" id="employee_name" name="employee_name" class="form-control" required 
                        value="<?= htmlspecialchars($employeeData['name'] ?? '') ?>">
                    <div class="invalid-feedback"></div>
                </div>
                <div class="col-md-6">
                    <label for="employee_lastname" class="form-label">Apellidos: <span class="text-danger">*</span></label>
                    <input type="text" id="employee_lastname" name="employee_lastname" class="form-control" required 
                        value="<?= htmlspecialchars($employeeData['last_name'] ?? '') ?>">
                    <div class="invalid-feedback"></div>
                </div>
            </div>

            <!-- Fila 2: Tipo de documento y Número de documento -->
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="employee_document_type" class="form-label">Tipo de Documento: <span class="text-danger">*</span></label>
                    <select id="employee_document_type" name="employee_document_type" class="form-select" required>
                        <option value="">Seleccione...</option>
                        <?php foreach ($documentTypes as $type) : ?>
                            <option value="<?= htmlspecialchars($type['id']) ?>"
                                <?= ($employeeData['document_type_id'] ?? '') == $type['id'] ? 'selected' : '' ?>>
                                <?= htmlspecialchars($type['name']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <div class="invalid-feedback"></div>
                </div>
                <div class="col-md-6">
                    <label for="employee_document" class="form-label">Número de Documento: <span class="text-danger">*</span></label>
                    <input type="text" id="employee_document" name="employee_document" class="form-control" required
                        value="<?= htmlspecialchars($employeeData['document'] ?? '') ?>">
                    <div class="invalid-feedback"></div>
                    <small class="form-text text-muted">Ingrese solo números, sin puntos ni caracteres especiales.</small>
                </div>
            </div>

            <!-- Fila 3: Cargo, Tipo de contrato, Fecha de ingreso -->
            <div class="row mb-3">
                <div class="col-md-4">
                    <label for="employee_job_title" class="form-label">Cargo: <span class="text-danger">*</span></label>
                    <select id="employee_job_title" name="employee_job_title" class="form-select" required>
                        <option value="">Seleccione...</option>
                        <?php foreach ($jobTitles as $title) : ?>
                            <option value="<?= htmlspecialchars($title['id']) ?>"
                                <?= ($employeeData['job_title_id'] ?? '') == $title['id'] ? 'selected' : '' ?>>
                                <?= htmlspecialchars($title['name']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <div class="invalid-feedback"></div>
                </div>
                <div class="col-md-4">
                    <label for="employee_contract_type" class="form-label">Tipo de Contrato: <span class="text-danger">*</span></label>
                    <select id="employee_contract_type" name="employee_contract_type" class="form-select" required>
                        <option value="">Seleccione...</option>
                        <?php foreach ($contractTypes as $contract) : ?>
                            <option value="<?= htmlspecialchars($contract['id']) ?>"
                                <?= ($employeeData['contract_type_id'] ?? '') == $contract['id'] ? 'selected' : '' ?>>
                                <?= htmlspecialchars($contract['name']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <div class="invalid-feedback"></div>
                </div>
                <div class="col-md-4">
                    <label for="employee_hire_date" class="form-label">Fecha de Ingreso: <span class="text-danger">*</span></label>
                    <input type="date" id="employee_hire_date" name="employee_hire_date" class="form-control" required 
                        value="<?= htmlspecialchars($employeeData['hire_date'] ?? '') ?>">
                    <div class="invalid-feedback"></div>
                </div>
            </div>
            
            <br>
            <p class="text-muted">Los campos marcados con <span class="text-danger">*</span> son obligatorios.</p>
            <!-- Botón centrado -->
            <div class="text-center">
                <button type="submit" class="btn btn-primary">Editar</button>
                <a href="/list_employees.php" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
    <script src="js/form_validation.js"></script>
</body>
</html>
