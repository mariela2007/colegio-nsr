@extends('layouts.admin')

@section('titulo', 'Inicio admin')

@section('contenido')
    <!-- Sección de Bienvenida -->
    <div style="text-align:center; padding: 20px 0 40px 0;">
        <i class="fa-solid fa-hand-sparkles" style="font-size: 3rem; color: var(--accent); margin-bottom: 20px;"></i>
        <h1 style="margin: 0; font-size: 2.2rem; background: linear-gradient(to right, #fff, var(--text-muted)); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">
            ¡Bienvenido, Administrador!
        </h1>
        <p style="max-width:600px; margin: 16px auto; color: var(--text-muted); font-size: 1.1rem; line-height: 1.6;">
            Desde aquí tienes el control total del contenido del <strong>Colegio NSR</strong>. Gestiona noticias, eventos y la galería de imágenes de forma rápida.
        </p>
    </div>

    <!-- Rejilla de Tarjetas Informativas -->
    <div style="display:grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 24px; margin-top: 20px;">
        
        <!-- Tarjeta: Estado -->
        <div style="background: rgba(255,255,255,0.03); padding: 30px; border-radius: 20px; border: 1px solid var(--border-color); position: relative; overflow: hidden;">
            <i class="fa-solid fa-server" style="position: absolute; right: -10px; bottom: -10px; font-size: 5rem; opacity: 0.05;"></i>
            
            <div style="display: flex; align-items: center; gap: 15px; margin-bottom: 15px;">
                <div style="background: rgba(99, 102, 241, 0.2); padding: 10px; border-radius: 12px;">
                    <i class="fa-solid fa-check-double" style="color: var(--primary); font-size: 1.2rem;"></i>
                </div>
                <h2 style="margin: 0; font-size: 1.25rem; color: #fff;">Estado del Sistema</h2>
            </div>
            <p style="margin: 0; color: var(--text-muted); line-height: 1.6; font-size: 0.95rem;">
                Todas las secciones están sincronizadas. El inventario, las noticias y los eventos están listos para ser actualizados.
            </p>
        </div>

        <!-- Tarjeta: Identidad -->
        <div style="background: rgba(251, 191, 36, 0.05); padding: 30px; border-radius: 20px; border: 1px solid rgba(251, 191, 36, 0.2); position: relative; overflow: hidden;">
            <i class="fa-solid fa-palette" style="position: absolute; right: -10px; bottom: -10px; font-size: 5rem; opacity: 0.05;"></i>
            
            <div style="display: flex; align-items: center; gap: 15px; margin-bottom: 15px;">
                <div style="background: rgba(251, 191, 36, 0.2); padding: 10px; border-radius: 12px;">
                    <i class="fa-solid fa-brush" style="color: var(--accent); font-size: 1.2rem;"></i>
                </div>
                <h2 style="margin: 0; font-size: 1.25rem; color: #fff;">Identidad NSR</h2>
            </div>
            <p style="margin: 0; color: var(--text-muted); line-height: 1.6; font-size: 0.95rem;">
                El panel utiliza los colores institucionales (Azul y Amarillo) para mantener la coherencia visual con la marca del colegio.
            </p>
        </div>

    </div>

    <!-- Pie de página de bienvenida -->
    <div style="margin-top: 40px; text-align: center; border-top: 1px solid var(--border-color); padding-top: 30px;">
        <span style="background: var(--sidebar-bg); padding: 8px 20px; border-radius: 50px; font-size: 0.85rem; color: var(--accent); border: 1px solid var(--border-color);">
            <i class="fa-solid fa-circle-info"></i> Selecciona una opción en el menú lateral para comenzar.
        </span>
    </div>
@endsection