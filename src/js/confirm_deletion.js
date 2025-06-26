document.addEventListener('DOMContentLoaded', function () {
  var deleteModal = document.getElementById('deleteEmployeeModal');
  deleteModal.addEventListener('show.bs.modal', function (event) {
    var button = event.relatedTarget;
    var employeeId = button.getAttribute('data-employee-id');
    var inputId = deleteModal.querySelector('#modal-employee-id');
    inputId.value = employeeId;
  });
});
