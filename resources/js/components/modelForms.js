// resources/js/components/modalForms.js

document.getElementById('add-activity').addEventListener('click', function(e) {
    e.preventDefault();
    Swal.fire({
        title: 'Agregar Actividad',
        html: `
            <input type="text" id="activity-input" placeholder="Escribe la actividad" class="swal2-input" required>
        `,
        focusConfirm: false,
        preConfirm: () => {
            const activity = Swal.getInput().value;
            if (!activity) {
                Swal.showValidationMessage('Por favor, ingresa una actividad.');
            }
            return { activity: activity };
        }
    }).then((result) => {
        if (result.isConfirmed) {
            const activityInput = result.value.activity;
            console.log('Actividad agregada:', activityInput); // Aquí puedes manejar la actividad
        }
    });
});

document.getElementById('add-criteria').addEventListener('click', function(e) {
    e.preventDefault();
    Swal.fire({
        title: 'Agregar Criterios de Aceptación',
        html: `
            <input type="text" id="criteria-input" placeholder="Escribe el criterio" class="swal2-input" required>
        `,
        focusConfirm: false,
        preConfirm: () => {
            const criteria = Swal.getInput().value;
            if (!criteria) {
                Swal.showValidationMessage('Por favor, ingresa un criterio.');
            }
            return { criteria: criteria };
        }
    }).then((result) => {
        if (result.isConfirmed) {
            const criteriaInput = result.value.criteria;
            console.log('Criterio agregado:', criteriaInput); // Aquí puedes manejar el criterio
        }
    });
});
