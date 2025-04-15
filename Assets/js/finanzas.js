$(document).ready(function() {
    $('#finanzasForm').on('submit', function(e) {
        e.preventDefault();

        const tipo = $('#tipo').val();
        const fecha = $('#fecha').val();
        const monto = $('#monto').val();
        const descripcion = $('#descripcion').val();
        const id_insumo = $('#id_insumo').val();

        const url = tipo === 'ingreso' ? 'http://localhost/championFramework/ingreso/createIngreso' : 'http://localhost/championFramework/egreso/createEgreso';

        $.ajax({
            url: url,
            method: 'POST',
            contentType: 'application/json',
            data: JSON.stringify({ fecha: fecha, monto: monto, descripcion: descripcion, id_insumo: id_insumo }),
            success: function(response) {
                if (response.status) {
                    alert(tipo.charAt(0).toUpperCase() + tipo.slice(1) + ' registrado exitosamente');
                    // Clear the form or perform other actions
                } else {
                    alert('Error al registrar el ' + tipo + ': ' + response.msg);
                }
            },
            error: function() {
                alert('Se ha producido un error. Inténtalo de nuevo.');
            }
        });
    });

    // Cargar datos y generar gráficos
    function loadFinancialData() {
        $.ajax({
            url: 'http://localhost/championFramework/finanzas/getData',
            method: 'GET',
            success: function(response) {
                if (response.status) {
                    generateChart(response.data);
                } else {
                    alert('Error al cargar los datos financieros: ' + response.msg);
                }
            },
            error: function() {
                alert('Se ha producido un error al cargar los datos financieros.');
            }
        });
    }

    function generateChart(data) {
        const ctx = document.getElementById('finanzasChart').getContext('2d');
        const chart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: data.labels,
                datasets: [{
                    label: 'Ingresos',
                    data: data.ingresos,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }, {
                    label: 'Egresos',
                    data: data.egresos,
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    }

    loadFinancialData();
});