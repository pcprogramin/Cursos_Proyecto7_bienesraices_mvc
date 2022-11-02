document.addEventListener('DOMContentLoaded',function(){
    eventListeners();
    darkMode();
});

function eventListeners(){
    const mobileMenu=document.querySelector('.mobile-menu');
    mobileMenu.addEventListener('click',navegacionResponsive);

    const metodoContacto = document.querySelectorAll('input[name="contacto[contacto]"]');
    metodoContacto.forEach(input => input.addEventListener('click',mostrarMetodoConctacto));

}
function navegacionResponsive(){
    const navegacion= document.querySelector('.navegacion');
    navegacion.classList.toggle('mostrar');
}
function darkMode(){
    const botonDarkMode=document.querySelector('.dark-mode-boton');
    botonDarkMode.addEventListener('click',()=>{
        document.body.classList.toggle('dark-mode');
    });
}
function mostrarMetodoConctacto(e){
    const contactoDiv =document.querySelector('#contacto');
    if(e.target.value == 'telefono'){
        contactoDiv.innerHTML=`
        <label for="telefono">Teléfono</label>
        <input type="tel" placeholder="Tu Teléfono" id="telefono" name="contacto[telefono]">

        <p>Elija teléfono, elija la fecha y la hora para llamar</p>

        <label for="fecha">Fecha:</label>
        <input type="date" id="fecha" name="contacto[fecha]">

        <label for="hora">Hora:</label>
        <input type="time" id="hora" min="09:00" max="18:00" name="contacto[hora]">
        `;
    }else{
        contactoDiv.innerHTML=`
        <label for="email">E-mail</label>
        <input type="email" placeholder="Tu Email" id="email" name="contacto[email]" require>
        `;
    }
}