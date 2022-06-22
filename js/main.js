/*Aquí yo creo una función para incrementar el contador*/
function incrementar(idProducto, cantidad) {
    // Cojo el número actual del producto.
    var numeroProducto = document.getElementById(`contar${idProducto}`);
    var inputCantidadProducto = document.getElementById(`cantidadProducto${idProducto}`);
    var contador = numeroProducto.textContent;
    if(contador < cantidad){
      console.log("Entro aqui");
      contador++;
      numeroProducto.textContent = contador;
      inputCantidadProducto.value = contador;
    } else {
      ohSnap('No hay más stock', {color: 'red'});
    }
}

function decrementar(idProducto) {
    // Cojo el número actual del producto.
    var numeroProducto = document.getElementById(`contar${idProducto}`);
    var inputCantidadProducto = document.getElementById(`cantidadProducto${idProducto}`);
    var contador = numeroProducto.textContent;
    if(contador != 0) {
        contador--;
        numeroProducto.textContent = contador;
        inputCantidadProducto.value = contador;
    }
}

/* Cuando el usuario hace clic en el botón,
alternar entre ocultar y mostrar el contenido desplegable */
function menuPerfil() {
    document.getElementById("miDesplegablePerfil").classList.toggle("show");
}
  
/* Cuando el usuario hace clic en el botón,
alternar entre ocultar y mostrar el contenido desplegable */
function menuAdmin() {
  document.getElementById("miDesplegableAdmin").classList.toggle("show");
}

// Cierra el menú desplegable si el usuario hace clic fuera de él. 
window.onclick = function(event) {
  if (!event.target.matches('.ocultaMenu')) {
    var  listasDeplegables = document.getElementsByClassName("despegable-contenido");
    var i;
    for (i = 0; i < listasDeplegables.length; i++) {
      var abrirDesplegable  = listasDeplegables[i];
      if (abrirDesplegable.classList.contains('show')) {
        abrirDesplegable.classList.remove('show');
      }
    }
  }
}