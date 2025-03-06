// Datos de ejemplo para las diferentes zonas
const zonesData = [
    {
        id: 1,
        name: "Zona 1",
        charts: {
            ph: {
                data: [6.5, 6.8, 7.0, 6.9, 7.1],
                labels: ['Ene', 'Feb', 'Mar', 'Abr', 'May']
            },
            temperature: {
                data: [22, 24, 23, 25, 24],
                labels: ['Ene', 'Feb', 'Mar', 'Abr', 'May']
            },
            humidity: {
                data: [65, 68, 70, 67, 69],
                labels: ['Ene', 'Feb', 'Mar', 'Abr', 'May']
            }
        }
    },
    // Agregar datos similares para Zona 2 y 3
];

let currentZone = 0;
let autoPlayInterval;

// Función para inicializar el carrusel
function initZoneCarousel() {
    updateZoneDisplay();
    startAutoPlay();
    setupDotListeners();
}

// Función para actualizar la visualización de la zona
function updateZoneDisplay() {
    const zoneData = zonesData[currentZone];
    
    // Actualizar título
    document.querySelector('.zone-title').textContent = zoneData.name;
    
    // Actualizar gráficos
    updateCharts(zoneData.charts);
    
    // Actualizar dots
    updateDots();
}

// Función para actualizar los gráficos
function updateCharts(chartData) {
    // Actualizar gráfico de pH
    if (window.phChart) {
        phChart.data.datasets[0].data = chartData.ph.data;
        phChart.data.labels = chartData.ph.labels;
        phChart.update();
    }
    
    // Actualizar gráfico de temperatura
    if (window.tempChart) {
        tempChart.data.datasets[0].data = chartData.temperature.data;
        tempChart.data.labels = chartData.temperature.labels;
        tempChart.update();
    }
    
    // Actualizar gráfico de humedad
    if (window.humidityChart) {
        humidityChart.data.datasets[0].data = chartData.humidity.data;
        humidityChart.data.labels = chartData.humidity.labels;
        humidityChart.update();
    }
}

// Función para actualizar los dots de navegación
function updateDots() {
    const dots = document.querySelectorAll('.dot');
    dots.forEach((dot, index) => {
        dot.classList.toggle('active', index === currentZone);
    });
}

// Función para cambiar de zona
function changeZone(index) {
    currentZone = index;
    updateZoneDisplay();
}

// Función para iniciar la reproducción automática
function startAutoPlay() {
    autoPlayInterval = setInterval(() => {
        currentZone = (currentZone + 1) % zonesData.length;
        updateZoneDisplay();
    }, 5000); // Cambiar cada 5 segundos
}

// Función para detener la reproducción automática
function stopAutoPlay() {
    clearInterval(autoPlayInterval);
}

// Configurar listeners para los dots
function setupDotListeners() {
    const dots = document.querySelectorAll('.dot');
    dots.forEach((dot, index) => {
        dot.addEventListener('click', () => {
            stopAutoPlay();
            changeZone(index);
            startAutoPlay();
        });
    });
}

// Inicializar cuando el documento esté listo
document.addEventListener('DOMContentLoaded', initZoneCarousel);