var Textos = new Array();
// Aquí van los textos que van cambiando en el top-banner
Textos[0]="<i class='fa-solid fa-truck'></i>     Entregas gratuitas para pedidos de más de 75€";
Textos[1]="<i class='fa-solid fa-box-open'></i>    Devoluciones Gratis";
Textos[2]="<i class='fa-solid fa-people-carry-box'></i>    Envío y entrega en 4 - 7 días";
var nuevoTexto = -1; // para empezar en el primer texto -1, con 0 comienza por mostrar el segundo
var totalTextos = Textos.length;

/** Array con las imagenes que se iran mostrando en la portada */
const imagenes=new Array(
    ['img/portada06.jpg'],
    ['img/portada01.jpg'],
    ['img/portada07.jpg'],
    ['img/portada04.jpg']
);
var contador=0;

/** Funcion para cambiar la imagen */
function rotarImagenes() {
    // cambiamos la imagen
    contador++
    document.getElementById("imagen").src=imagenes[contador%imagenes.length][0];
}
/** Funcion para cambiar el texto */
function repetir() {
    nuevoTexto++;
    if (nuevoTexto == totalTextos) {
    nuevoTexto = 0;
    }
    document.getElementById('texto').innerHTML=Textos[nuevoTexto];
    // cambiar 4 por el valor en segundos
    setTimeout("repetir()", 4*1000);
}