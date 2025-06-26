document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('form');

    form.addEventListener('submit', function(event) {
        let valid = true;

        // Limpia errores anteriores
        form.querySelectorAll('.form-control, .form-select').forEach(function(input) {
            input.classList.remove('is-invalid');
        });
        form.querySelectorAll('.invalid-feedback').forEach(function(div) {
            div.textContent = '';
        });

        // Validación Nombres
        const name = document.getElementById('employee_name');
        if (!/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/.test(name.value.trim())) {
            valid = false;
            name.classList.add('is-invalid');
            name.nextElementSibling.textContent = 'Ingrese solo letras y espacios.';
        }

        // Validación Apellidos
        const lastname = document.getElementById('employee_lastname');
        if (!/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/.test(lastname.value.trim())) {
            valid = false;
            lastname.classList.add('is-invalid');
            lastname.nextElementSibling.textContent = 'Ingrese solo letras y espacios.';
        }

        // Tipo de Documento
        const documentType = document.getElementById('employee_document_type');
        if (documentType.value === '') {
            valid = false;
            documentType.classList.add('is-invalid');
            documentType.nextElementSibling.textContent = 'Seleccione un tipo de documento.';
        }

        // Número de Documento
        const documentNumber = document.getElementById('employee_document');
        if (!/^\d+$/.test(documentNumber.value.trim())) {
            valid = false;
            documentNumber.classList.add('is-invalid');
            documentNumber.nextElementSibling.textContent = 'Solo números, sin letras, puntos ni caracteres especiales.';
        }

        // Cargo
        const jobTitle = document.getElementById('employee_job_title');
        if (jobTitle.value === '') {
            valid = false;
            jobTitle.classList.add('is-invalid');
            jobTitle.nextElementSibling.textContent = 'Seleccione un cargo.';
        }

        // Tipo de Contrato
        const contractType = document.getElementById('employee_contract_type');
        if (contractType.value === '') {
            valid = false;
            contractType.classList.add('is-invalid');
            contractType.nextElementSibling.textContent = 'Seleccione un tipo de contrato.';
        }

        // Fecha de Ingreso
        const hireDate = document.getElementById('employee_hire_date');
        if (hireDate.value === '') {
            valid = false;
            hireDate.classList.add('is-invalid');
            hireDate.nextElementSibling.textContent = 'Seleccione una fecha de ingreso.';
        }

        // Si hay errores, cancela el envío
        if (!valid) {
            event.preventDefault();
        }
    });
});
