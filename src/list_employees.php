<?php
require_once __DIR__ . '/Models/EmployeesModel.php';

$employeesModel = new EmployeesModel();
$employees = $employeesModel->getAllEmployees();

$message = '';

if (isset($_GET['status'])) {
  switch ($_GET['status']) {
    case 'created':
      $message = '<div class="alert alert-success">Empleado registrado exitosamente.</div>';
      break;
    case 'updated':
      $message = '<div class="alert alert-success">Empleado actualizado exitosamente.</div>';
      break;
    case 'deleted':
      $message = '<div class="alert alert-success">Empleado eliminado exitosamente.</div>';
      break;
    case 'error':
      $message = '<div class="alert alert-danger">Ocurrió un error al procesar la solicitud.</div>';
      break;
    default:
      $message = '';
      break;
  }
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List Employees</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
  </head>
  <body>
    <div class="container mt-5">
      <!-- Título centrado -->
      <h1 class="text-center mb-4">Lista de empleados</h1>
      <?php if ($message): ?>
        <?= $message ?>
      <?php endif; ?>

      <!-- Botón para ir al formulario de registro -->
      <div class="mb-3 text-start">
        <a href="register_employee.php" class="btn btn-success">Registrar empleado</a>
      </div>

        <!-- Tabla de empleados -->
      <table class="table table-striped">
        <thead>
          <tr>
            <th>Nombres</th>
            <th>Apellidos</th>
            <th>Tipo Documento</th>
            <th>Número Documento</th>
            <th>Cargo</th>
            <th>Tipo Contrato</th>
            <th>Fecha Ingreso</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
          <?php if (!empty($employees)) : ?>
            <?php foreach ($employees as $employee) : ?>
              <tr>
                <td><?= htmlspecialchars($employee['name']) ?></td>
                <td><?= htmlspecialchars($employee['last_name']) ?></td>
                <td><?= htmlspecialchars($employee['document_type_name']) ?></td>
                <td><?= htmlspecialchars($employee['document']) ?></td>
                <td><?= htmlspecialchars($employee['job_title_name']) ?></td>
                <td><?= htmlspecialchars($employee['contract_type_name']) ?></td>
                <td><?= htmlspecialchars($employee['hire_date']) ?></td>
                <td>
                  <a href="edit_employee.php?id=<?= htmlspecialchars($employee['id']) ?>" class="btn btn-sm btn-outline-primary">
                    <i class="bi bi-pencil-square"></i>
                  </a>
                  <button type="button" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteEmployeeModal"  data-employee-id="<?= htmlspecialchars($employee['id']) ?>">
                    <i class="bi bi-trash"></i>
                  </button>
                </td>
              </tr>
            <?php endforeach; ?>
          <?php else : ?>
            <tr>
              <td colspan="8" class="text-center">No hay empleados registrados.</td>
            </tr>
          <?php endif; ?>
        </tbody>
        </table>
    
      <!-- Modal de confirmación de eliminación -->
      <div class="modal fade" id="deleteEmployeeModal" tabindex="-1" aria-labelledby="deleteEmployeeModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <form action="/Controllers/RegisterEmployeeController.php" method="POST">
            <input type="hidden" name="_action" value="delete">
            <input type="hidden" name="employee_id" id="modal-employee-id">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Confirmar eliminación</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
              </div>
              <div class="modal-body">
                <span>¿Estás seguro de que deseas eliminar este empleado?</span>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-danger">Eliminar</button>
              </div>
            </div>
          </form>
        </div>
      </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
    <script src="js/confirm_deletion.js"></script>
  </body>
</thml>
