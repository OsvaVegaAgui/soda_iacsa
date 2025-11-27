document.addEventListener('DOMContentLoaded', () => {

    const msg = document.getElementById('mensaje');
    const showMessage = (type='info', text='') => {
        if (!msg) return;
        msg.className = `alert alert-${type}`;
        msg.innerHTML = `<strong>${{success:'Éxito',danger:'Error',warning:'Atención',info:'Información'}[type]||'Info'}</strong> ${text}`;
        msg.style.display = '';
        setTimeout(()=> msg.style.display='none', 3500);
    };

    const form = document.querySelector("#formCrearProducto");

    if (form){ 

        form.addEventListener('submit', async (e) => {
            e.preventDefault();

            const fd = new FormData(form);

            try {
                const resp = await fetch(form.action, {
                    method: 'POST',
                    body: fd,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json'
                    },
                    credentials: 'same-origin'
                });

                if (resp.status === 422) {
                   
                    const data = await resp.json();
                    const firstError =
                        Object.values(data.errors || {})[0]?.[0] ||
                        'Revisa los campos del formulario.';

                    if (typeof showMessage === 'function') {
                        showMessage('danger', firstError);
                    } else {
                        alert(firstError);
                    }
                    return;
                }

                if (!resp.ok) {
                    if (typeof showMessage === 'function') {
                        showMessage('danger', 'Error al enviar el formulario.');
                    }return;
                }

                const data = await resp.json();

                if (data.ok || data.success) {
                    if (typeof showMessage === 'function') {
                        showMessage('success', data.message || 'Producto guardado correctamente.');
                    } 

                    // Si quieres redirigir de vuelta a la lista:
                    if (data.redirect) {
                        setTimeout(() => { window.location.href = data.redirect; }, 1000);
                    }
                } else {
                    if (typeof showMessage === 'function') {
                        showMessage('warning', 'Solicitud procesada, pero sin confirmación explícita.');
                    }
                }

            } catch (err) {
                console.error(err);
                if (typeof showMessage === 'function') {
                    showMessage('danger', 'Error de conexión. Intenta nuevamente.');
                }
            }
        });

    }


    // SI ESTAMOS TRABAJANDO CON EL FORMULARIO DE EDITAR
    const formEditar = document.getElementById('formEditarProducto');
    if (formEditar){ 
        formEditar.addEventListener('submit', async (e) => {
            e.preventDefault();

            // Validación HTML5
            if (!formEditar.checkValidity()) {
                formEditar.reportValidity();
                return;
            }

            const fd = new FormData(formEditar);


            const csrf =
                document.querySelector('meta[name="csrf-token"]')?.content ||
                document.querySelector('input[name="_token"]')?.value ||
                '';


            try {


                const resp = await fetch(formEditarProducto.action, {
                    method: 'POST', // usamos POST hacia la acción 'editar'
                    body: fd,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': csrf
                    },
                    credentials: 'same-origin'
                });

                if (resp.status === 422) {
                   
                    const data = await resp.json();
                    const firstError =
                        Object.values(data.errors || {})[0]?.[0] ||
                        'Revisa los campos del formulario.';

                    if (typeof showMessage === 'function') {
                        showMessage('danger', firstError);
                    } else {
                        alert(firstError);
                    }
                    return;
                }

                if (!resp.ok) {
                    if (typeof showMessage === 'function') {
                        showMessage('danger', 'Error al actualizar el producto.');
                    } else {
                        alert('Error al actualizar el producto.');
                    }
                    return;
                }

                const data = await resp.json();

                if (data.ok) {
                    if (typeof showMessage === 'function') {
                        showMessage('success', data.message || 'Producto actualizado correctamente.');
                    } else {
                        alert(data.message || 'Producto actualizado correctamente.');
                    }

                    // Si quieres redirigir de vuelta a la lista:
                    if (data.redirect) {
                        window.location.href = data.redirect;
                    }
                } else {
                    if (typeof showMessage === 'function') {
                        showMessage('warning', 'Solicitud procesada, pero sin confirmación explícita.');
                    } else {
                        alert('Solicitud procesada, pero sin confirmación explícita.');
                    }
                }

            } catch (err) {
                console.error(err);
                if (typeof showMessage === 'function') {
                    showMessage('danger', 'Error de conexión. Intenta nuevamente.');
                } else {
                    alert('Error de conexión. Intenta nuevamente.');
                }
            }
        });
    }

    document.addEventListener('submit', async (e) => {
        const formEliminar = e.target.closest('.form-eliminar-producto');
        if (formEliminar){

            e.preventDefault();

            const btn = formEliminar.querySelector('.btn-eliminar-producto');
            const nombre = btn?.dataset.nombre || 'este producto';

            const confirmar = confirm(`¿Seguro que desea eliminar ${nombre}?`);
            if (!confirmar) return;

            const fd = new FormData(formEliminar);

            try {
                const resp = await fetch(formEliminar.action, {
                    method: 'POST',
                    body: fd, // aquí ya viaja _token
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json'
                    },
                    credentials: 'same-origin'
                });

                if (!resp.ok) {
                    if (typeof showMessage === 'function') {
                        showMessage('danger', 'No se pudo eliminar el producto.');
                    } else {
                        alert('No se pudo eliminar el producto.');
                    }
                    return;
                }

                const data = await resp.json();

                if (data.ok) {
                    if (typeof showMessage === 'function') {
                        showMessage('success', data.message || 'Producto eliminado correctamente.');
                        location.reload();
                    } else {
                        alert(data.message || 'Producto eliminado correctamente.');
                        location.reload();
                    }

                    const fila = formEliminar.closest('tr');

                    if (fila) fila.remove();
                } else {
                    if (typeof showMessage === 'function') {
                        showMessage('warning', data.message || 'No se pudo eliminar el producto.');
                    } else {
                        alert(data.message || 'No se pudo eliminar el producto.');
                    }
                }

            } catch (err) {
                console.error(err);
                if (typeof showMessage === 'function') {
                    showMessage('danger', 'Error de conexión al intentar eliminar el producto.');
                } else {
                    alert('Error de conexión al intentar eliminar el producto.');
                }
            }
        }
    });
});
