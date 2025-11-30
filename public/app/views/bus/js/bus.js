
document.addEventListener('DOMContentLoaded', function() {
    cargarBuses();
    cargarEstadisticas();
});


function abrirModal(id = null) {
    document.getElementById('modalBus').classList.remove('hidden');
    document.getElementById('formBus').reset();
    
    if (id) {
        document.getElementById('tituloModal').textContent = 'Editar Bus';
        cargarDatosBus(id);
    } else {
        document.getElementById('tituloModal').textContent = 'Registrar Nuevo Bus';
        document.getElementById('busId').value = '';
    }
}


function cerrarModal() {
    document.getElementById('modalBus').classList.add('hidden');
    document.getElementById('formBus').reset();
}


document.getElementById('formBus').addEventListener('submit', async function(e) {
    e.preventDefault();
    
    const formData = new FormData(this);
    const id = document.getElementById('busId').value;
    
    formData.append('accion', id ? 'actualizar' : 'guardar');
    
    try {
        const response = await fetch('../../../controllers/bus/bus_controller.php', {
            method: 'POST',
            body: formData
        });
        
        const data = await response.json();
        
        if (data.success) {
            mostrarNotificacion('Bus guardado exitosamente', 'success');
            cerrarModal();
            cargarBuses();
            cargarEstadisticas();
        } else {
            mostrarNotificacion(data.message || 'Error al guardar el bus', 'error');
        }
    } catch (error) {
        console.error('Error:', error);
        mostrarNotificacion('Error de conexión', 'error');
    }
});


async function cargarBuses() {
    try {
        const response = await fetch('../../../controllers/bus/bus_controller.php?accion=listar');
        const data = await response.json();
        
        if (data.success) {
            mostrarBuses(data.buses);
        }
    } catch (error) {
        console.error('Error al cargar buses:', error);
    }
}


function mostrarBuses(buses) {
    const tbody = document.getElementById('tablaBuses');
    
    if (buses.length === 0) {
        tbody.innerHTML = `
            <tr>
                <td colspan="7" class="px-6 py-4 text-center text-gray-500">
                    <i class="fas fa-inbox text-4xl mb-2"></i>
                    <p>No hay buses registrados</p>
                </td>
            </tr>
        `;
        return;
    }
    
    tbody.innerHTML = buses.map(bus => `
        <tr class="hover:bg-gray-50">
            <td class="px-6 py-4 whitespace-nowrap">
                <span class="font-semibold">${bus.placa}</span>
            </td>
            <td class="px-6 py-4 whitespace-nowrap">${bus.modelo}</td>
            <td class="px-6 py-4 whitespace-nowrap">${bus.marca}</td>
            <td class="px-6 py-4 whitespace-nowrap">
                <span class="inline-flex items-center">
                    <i class="fas fa-user mr-1"></i>
                    ${bus.capacidad} pasajeros
                </span>
            </td>
            <td class="px-6 py-4 whitespace-nowrap">${bus.anio}</td>
            <td class="px-6 py-4 whitespace-nowrap">
                ${obtenerBadgeEstado(bus.estado)}
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm">
                <button onclick="verDetalle(${bus.id})" class="text-blue-600 hover:text-blue-900 mr-3" title="Ver detalle">
                    <i class="fas fa-eye"></i>
                </button>
                <button onclick="abrirModal(${bus.id})" class="text-green-600 hover:text-green-900 mr-3" title="Editar">
                    <i class="fas fa-edit"></i>
                </button>
                <button onclick="eliminarBus(${bus.id}, '${bus.placa}')" class="text-red-600 hover:text-red-900" title="Eliminar">
                    <i class="fas fa-trash"></i>
                </button>
            </td>
        </tr>
    `).join('');
}

function obtenerBadgeEstado(estado) {
    const estados = {
        'Disponible': 'bg-green-100 text-green-800',
        'En Servicio': 'bg-blue-100 text-blue-800',
        'Mantenimiento': 'bg-yellow-100 text-yellow-800'
    };
    
    const clase = estados[estado] || 'bg-gray-100 text-gray-800';
    
    return `<span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full ${clase}">
                ${estado}
            </span>`;
}

async function cargarEstadisticas() {
    try {
        const response = await fetch('../../../controllers/bus/bus_controller.php?accion=estadisticas');
        const data = await response.json();
        
        if (data.success) {
            document.getElementById('totalBuses').textContent = data.total || 0;
            document.getElementById('busesDisponibles').textContent = data.disponibles || 0;
            document.getElementById('busesMantenimiento').textContent = data.mantenimiento || 0;
            document.getElementById('busesEnServicio').textContent = data.enServicio || 0;
        }
    } catch (error) {
        console.error('Error al cargar estadísticas:', error);
    }
}


async function cargarDatosBus(id) {
    try {
        const response = await fetch(`../../../controllers/bus/bus_controller.php?accion=obtener&id=${id}`);
        const data = await response.json();
        
        if (data.success) {
            const bus = data.bus;
            document.getElementById('busId').value = bus.id;
            document.getElementById('placa').value = bus.placa;
            document.getElementById('marca').value = bus.marca;
            document.getElementById('modelo').value = bus.modelo;
            document.getElementById('anio').value = bus.anio;
            document.getElementById('capacidad').value = bus.capacidad;
            document.getElementById('color').value = bus.color || '';
            document.getElementById('estado').value = bus.estado;
            document.getElementById('tipo').value = bus.tipo || 'Turístico';
            document.getElementById('observaciones').value = bus.observaciones || '';
            
            
            if (bus.caracteristicas) {
                const caracteristicas = bus.caracteristicas.split(',');
                document.querySelectorAll('input[name="caracteristicas[]"]').forEach(checkbox => {
                    checkbox.checked = caracteristicas.includes(checkbox.value);
                });
            }
        }
    } catch (error) {
        console.error('Error al cargar datos del bus:', error);
    }
}


async function eliminarBus(id, placa) {
    if (!confirm(`¿Está seguro de eliminar el bus con placa ${placa}?`)) {
        return;
    }
    
    try {
        const response = await fetch('../../../controllers/bus/bus_controller.php?accion=eliminar', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ id: id })
        });
        
        const data = await response.json();
        
        if (data.success) {
            mostrarNotificacion('Bus eliminado exitosamente', 'success');
            cargarBuses();
            cargarEstadisticas();
        } else {
            mostrarNotificacion(data.message || 'Error al eliminar el bus', 'error');
        }
    } catch (error) {
        console.error('Error:', error);
        mostrarNotificacion('Error de conexión', 'error');
    }
}


function verDetalle(id) {
   
    window.location.href = `detalle.php?id=${id}`;
}


async function buscarBuses() {
    const busqueda = document.getElementById('buscarBus').value;
    const estado = document.getElementById('filtroEstado').value;
    
    try {
        const response = await fetch(`../../../controllers/bus/bus_controller.php?accion=listar&busqueda=${busqueda}&estado=${estado}`);
        const data = await response.json();
        
        if (data.success) {
            mostrarBuses(data.buses);
        }
    } catch (error) {
        console.error('Error en búsqueda:', error);
    }
}


document.getElementById('buscarBus').addEventListener('keyup', buscarBuses);
document.getElementById('filtroEstado').addEventListener('change', buscarBuses);


function mostrarNotificacion(mensaje, tipo = 'success') {
    const colores = {
        success: 'bg-green-500',
        error: 'bg-red-500',
        warning: 'bg-yellow-500',
        info: 'bg-blue-500'
    };
    
    const notificacion = document.createElement('div');
    notificacion.className = `fixed top-20 right-4 ${colores[tipo]} text-white px-6 py-3 rounded-lg shadow-lg z-50 transform transition-transform duration-300`;
    notificacion.innerHTML = `
        <div class="flex items-center">
            <i class="fas fa-${tipo === 'success' ? 'check-circle' : 'exclamation-circle'} mr-2"></i>
            <span>${mensaje}</span>
        </div>
    `;
    
    document.body.appendChild(notificacion);
    
    setTimeout(() => {
        notificacion.style.transform = 'translateX(400px)';
        setTimeout(() => notificacion.remove(), 300);
    }, 3000);
}


window.onclick = function(event) {
    const modal = document.getElementById('modalBus');
    if (event.target === modal) {
        cerrarModal();
    }
}