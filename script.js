function agregarDesdeCaja(producto, cantidad, precio) {
  document.getElementById('producto').value = producto;
  document.getElementById('cantidad').value = cantidad;
  document.getElementById('precio').value = precio;
}


document.getElementById('ventaForm').addEventListener('submit', function (e) {
  e.preventDefault();

  const producto = document.getElementById('producto').value;
  const cantidad = parseInt(document.getElementById('cantidad').value);
  const precio = parseFloat(document.getElementById('precio').value);
  const total = cantidad * precio;

  const tabla = document.querySelector('#tablaVentas tbody');
  const fila = document.createElement('tr');
  fila.innerHTML = `
    <td>${producto}</td>
    <td>${cantidad}</td>
    <td>$${precio.toFixed(2)}</td>
    <td>$${total.toFixed(2)}</td>
    <td><button onclick="this.parentElement.parentElement.remove()">Eliminar</button></td>
  `;
  tabla.appendChild(fila);

  // Resetea el formulario
  this.reset();
});
