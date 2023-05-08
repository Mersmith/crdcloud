<div class="contenedor_navbar_pie">
    <div class="navbar_pie_menu">
        <a href="#seccion_crd">CRD Cloud</a>
        <a href="#seccion_registrate">Regístrate</a>
        <a href="#seccion_servicios">Servicios</a>
        <a href="#seccion_equipo">Equipo</a>
        <a href="#seccion_sedes">Sedes</a>
        <a href="#seccion_beneficios">Beneficios</a>
        <a href="{{ asset('documentos/orden.pdf') }}" target="_blank" class="boton_menu_principal">Orden</a>
        <a href="{{ route('ingresar') }}" target="_blank" class="boton_menu_principal">CRD Cloud</a>
    </div>
</div>

<script>
    // Intercepta los clics en los enlaces del menú
    document.querySelectorAll('.navbar_pie_menu a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault(); // Previene la acción por defecto del enlace
            document.querySelector(this.getAttribute('href')).scrollIntoView({
                behavior: 'smooth' // Desplazamiento suave
            });
        });
    });
  </script>
