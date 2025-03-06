// Esperamos a que el DOM se haya cargado completamente antes de crear el gráfico
document.addEventListener('DOMContentLoaded', function() {
    // Obtener el contexto del canvas donde se dibujará la gráfica
    const ctx = document.getElementById('myChart').getContext('2d');
    
    // Crear la gráfica
    const myChart = new Chart(ctx, {
        type: 'polarArea', // Tipo de gráfica (puedes usar 'bar', 'line', etc.)
        data: {
            labels: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo'], // Etiquetas de los ejes X
            datasets: [{
                label: 'Temperatura',
                data: [22, 23, 19, 24, 28], // Datos para la gráfica
                borderColor: 'rgb(75, 192, 192)', // Color de la línea
                tension: 0.1
            }]
        },
        options: {
            responsive: true, // La gráfica se ajusta al tamaño del contenedor
            scales: {
                y: {
                    beginAtZero: true // Configuración del eje Y
                }
            }
        }
    });

});

document.addEventListener('DOMContentLoaded', function() {
    // Obtener el contexto del canvas donde se dibujará la gráfica
    const ctx = document.getElementById('myChart2').getContext('2d');
    
    // Crear la gráfica
    const myChart = new Chart(ctx, {
        type: 'bar', // Tipo de gráfica (puedes usar 'bar', 'line', etc.)
        data: {
            labels: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo'], // Etiquetas de los ejes X
            datasets: [{
                label: 'Temperatura',
                data: [22, 23, 19, 24, 28],
                backgroundColor: 'rgba(67, 203, 8)', // Datos para la gráfica
                borderColor: 'rgb(67, 203, 8)', // Color de la línea
                tension: 0.1
            }]
        },
        options: {
            responsive: true, // La gráfica se ajusta al tamaño del contenedor
            scales: {
                y: {
                    beginAtZero: true // Configuración del eje Y
                }
            }
        }
    });

});

document.addEventListener('DOMContentLoaded', function() {
    // Obtener el contexto del canvas donde se dibujará la gráfica
    const ctx = document.getElementById('myChart3').getContext('2d');

    let ph = 10
    
    // Crear la gráfica
    const myChart = new Chart(ctx, {
        type: 'bar', // Tipo de gráfica (puedes usar 'bar', 'line', etc.)
        data: {
            labels: ['8 AM', '12 PM', '4 PM', '8 PM'], // Etiquetas de los ejes X
            datasets: [{
                label: 'PH',
                data: [7, ph, 6.8, 7.2], // Datos para la gráfica
                backgroundColor: 'rgba(67, 203, 8)',
                borderColor: 'rgba(67, 203, 8', // Color de la línea
                tension: 0.1
            }]
        },
        options: {
            responsive: true, // La gráfica se ajusta al tamaño del contenedor
            scales: {
                y: {
                    beginAtZero: true // Configuración del eje Y
                }
            }
        }
    });

});

const inicio = () => {
    window.location = "pagina.html"
}


const configuracion = () => {
    window.location = "configuracion_sensores.html"
}
const reportes = () => {
    window.location = "reportes.html"
}
const crear_reporte = () => {
    window.location = "crear_reporte.html"
}
const detalle = () => {
    window.location = "detalles_graficas.html"
}



function toggleDropdown(button) {

    document.querySelectorAll('.dropdown-content').forEach(dropdown => {
        dropdown.classList.remove('show');
    });
    

    const dropdownContent = button.nextElementSibling;
    dropdownContent.classList.toggle('show');
    

    event.stopPropagation();
}

document.addEventListener('click', function(event) {
    if (!event.target.matches('.reports-actions-button')) {
        document.querySelectorAll('.dropdown-content').forEach(dropdown => {
            dropdown.classList.remove('show');
        });
    }
});


// Función simple para guardar reporte
function guardarReporte() {
    // Obtener valores del formulario
    const nombre = document.querySelector('input[placeholder="Nombre del reporte"]').value;
    const descripcion = document.querySelector('input[placeholder="Descripción"]').value;
    const fechaInicio = document.querySelector('input[type="date"]:nth-of-type(1)').value;
    const fechaFin = document.querySelector('input[type="date"]:nth-of-type(2)').value;

    // Crear objeto del reporte
    const reporte = {
        id: '#' + Math.floor(Math.random() * 1000),
        nombre: nombre,
        descripcion: descripcion,
        fechaInicio: fechaInicio,
        fechaFin: fechaFin
    };

    // Obtener reportes existentes o crear array vacío
    let reportes = [];
    if(localStorage.getItem('reportes')) {
        reportes = JSON.parse(localStorage.getItem('reportes'));
    }

    // Agregar nuevo reporte
    reportes.push(reporte);

    // Guardar en localStorage
    localStorage.setItem('reportes', JSON.stringify(reportes));

    // Redireccionar a página de reportes
    alert('Reporte guardado con éxito');
    window.location.href = 'reportes.html';
}

// Función para mostrar reportes
function mostrarReportes() {
    // Verificar si estamos en la página de reportes
    const tabla = document.querySelector('.reports-table tbody');
    if (!tabla) return;

    // Obtener reportes del localStorage
    let reportes = [];
    if(localStorage.getItem('reportes')) {
        reportes = JSON.parse(localStorage.getItem('reportes'));
    }

    // Limpiar tabla
    tabla.innerHTML = '';

    // Agregar cada reporte a la tabla
    reportes.forEach(reporte => {
        const fila = `
            <tr>
                <td>${reporte.id}</td>
                <td>${reporte.nombre}</td>
                <td>${reporte.fechaInicio}</td>
                <td>${reporte.fechaFin}</td>
                <td>${reporte.descripcion}</td>
                <td>
                    <div class="dropdown">
                        <button class="reports-actions-button">⋮</button>
                    </div>
                </td>
            </tr>
        `;
        tabla.innerHTML += fila;
    });
}

// Cargar reportes cuando se carga la página
document.addEventListener('DOMContentLoaded', mostrarReportes);
