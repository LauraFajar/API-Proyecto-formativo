// Función para registrar una nueva EPA con validaciones
async function registrarEPA(nombre, descripcion, cultivosSusceptibles, imagen) {
  // Validaciones de entrada
  if (!nombre || typeof nombre !== 'string' || nombre.trim() === '') {
      console.error('El nombre es obligatorio y debe ser una cadena no vacía.');
      return;
  }
  if (!descripcion || typeof descripcion !== 'string' || descripcion.trim() === '') {
      console.error('La descripción es obligatoria y debe ser una cadena no vacía.');
      return;
  }
  if (!cultivosSusceptibles || typeof cultivosSusceptibles !== 'string' || cultivosSusceptibles.trim() === '') {
      console.error('Los cultivos susceptibles son obligatorios y deben ser una cadena no vacía.');
      return;
  }
  if (!imagen || !(imagen instanceof File)) {
      console.error('La imagen es obligatoria y debe ser un archivo válido.');
      return;
  }

  const formData = new FormData();
  formData.append('nombre', nombre);
  formData.append('descripcion', descripcion);
  formData.append('cultivos_susceptibles', cultivosSusceptibles);
  formData.append('imagen', imagen);

  try {
      const response = await fetch('/registrar-epa', {
          method: 'POST',
          body: formData,
      });
      const data = await response.json();
      console.log(data);
  } catch (error) {
      console.error('Error al registrar la EPA:', error);
  }
}

// Función para buscar EPA con validaciones
async function buscarEPA(nombre) {
  // Validaciones de entrada
  if (!nombre || typeof nombre !== 'string' || nombre.trim() === '') {
      console.error('El nombre es obligatorio y debe ser una cadena no vacía.');
      return;
  }

  try {
      const response = await fetch(`/buscar-epa?nombre=${encodeURIComponent(nombre)}`);
      const data = await response.json();
      console.log(data);
  } catch (error) {
      console.error('Error al buscar la EPA:', error);
  }
}