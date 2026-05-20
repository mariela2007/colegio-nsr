@extends('layouts.app')

@section('contenido')

<style>
* { box-sizing: border-box; }
body { margin: 0; background: #f4f7fb; }
.container { max-width: 100% !important; padding: 0 !important; }
.contenido { padding: 0 !important; margin: 0 !important; font-family: 'Plus Jakarta Sans', sans-serif; }

:root {
    --c-blue:   #0d3b66;
    --c-yellow: #ffca28;
}

/* ══ HEADER ══ */
.contacto-header {
    padding: 60px 10%;
    background: var(--c-blue);

    text-align: center;
    color: white;
}
.contacto-header h2 {
    font-size: 2.8rem;
    font-weight: 800;
    margin-bottom: 10px;
}
.linea {
    width: 70px; height: 5px;
    background: var(--c-yellow);
    margin: 18px auto;
    border-radius: 3px;
}
.contacto-header p {
    max-width: 650px;
    margin: auto;
    font-size: 1.15rem;
    line-height: 1.6;
    opacity: 0.9;
}

/* ══ MAIN ══ */
.contacto-main {
    padding: 80px 10%;
    background: #edf2f7;
}
.contacto-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 50px;
    align-items: stretch;
}

/* ══ FORMULARIO ══ */
.formulario-box {
    background: #fff;
    padding: 40px;
    border-radius: 20px;
    box-shadow: 0 10px 40px rgba(0,0,0,0.07);
    display: flex;
    flex-direction: column;
}
.formulario-box h3 {
    margin: 0 0 6px;
    color: var(--c-blue);
    font-size: 1.5rem;
    font-weight: 800;
}
.formulario-box p.subtitulo {
    margin: 0 0 28px;
    color: #888;
    font-size: 0.95rem;
}

.formulario {
    display: flex;
    flex-direction: column;
    gap: 0;
}

/* Fila de dos columnas */
.form-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 16px;
    margin-bottom: 16px;
}

/* Grupo de campo */
.form-group {
    display: flex;
    flex-direction: column;
    gap: 6px;
    margin-bottom: 16px;
}
.form-group label {
    font-size: 0.82rem;
    font-weight: 700;
    color: var(--c-blue);
    text-transform: uppercase;
    letter-spacing: 0.5px;
}
.form-group input,
.form-group textarea,
.form-group select {
    width: 100%;
    padding: 13px 16px;
    border-radius: 10px;
    border: 1.5px solid #e2e6ea;
    background: #f8fafc;
    font-size: 0.93rem;
    color: #333;
    outline: none;
    transition: all 0.25s ease;
    font-family: inherit;
}
.form-group input:focus,
.form-group textarea:focus,
.form-group select:focus {
    border-color: var(--c-blue);
    background: #fff;
    box-shadow: 0 0 0 3px rgba(13,59,102,0.08);
}
.form-group textarea {
    height: 120px;
    resize: none;
}

/* Botón */
.btn-enviar {
    margin-top: 8px;
    background: linear-gradient(135deg, #0d3b66, #08263f);
    color: white;
    padding: 15px;
    border-radius: 12px;
    border: none;
    font-weight: 700;
    font-size: 0.95rem;
    cursor: pointer;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    letter-spacing: 0.3px;
}
.btn-enviar:hover {
    transform: translateY(-3px);
    box-shadow: 0 10px 25px rgba(13,59,102,0.25);
}

/* ══ MAPA ══ */
.mapa-box {
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 10px 40px rgba(0,0,0,0.08);
    height: 100%;
    min-height: 500px;
}
.mapa-box iframe {
    width: 100%;
    height: 100%;
    min-height: 500px;
    border: none;
    display: block;
}

/* ══ RESPONSIVE ══ */
@media (max-width: 900px) {
    .contacto-grid { grid-template-columns: 1fr; }
    .contacto-main { padding: 50px 6%; }
    .form-row { grid-template-columns: 1fr; }
}
</style>

<!-- HEADER -->
<section class="contacto-header">
    <h2>Contáctanos</h2>
    <div class="linea"></div>
    <p>Nuestro equipo está disponible para brindarle información y orientación sobre nuestra propuesta educativa.</p>
</section>

<!-- CONTENIDO -->
<section class="contacto-main">
    <div class="contacto-grid">

        <!-- FORMULARIO -->
        <div class="formulario-box">
            <h3>Envíanos un mensaje</h3>
            <p class="subtitulo">Completa el formulario y te responderemos a la brevedad.</p>
@if(session('success'))
    <div style="background:rgba(34,197,94,0.15); color:#22c55e; border:1px solid rgba(34,197,94,0.3); padding:14px 18px; border-radius:12px; margin-bottom:20px; display:flex; align-items:center; gap:10px;">
        <i class="fa-solid fa-circle-check"></i> {{ session('success') }}
    </div>
@endif

@if($errors->any())
    <div style="background:rgba(248,113,113,0.15); color:#f87171; border:1px solid rgba(248,113,113,0.3); padding:14px 18px; border-radius:12px; margin-bottom:20px; display:flex; align-items:center; gap:10px;">
        <i class="fa-solid fa-circle-exclamation"></i> {{ $errors->first() }}
    </div>
@endif
<form action="{{ route('contacto.store') }}" method="POST" class="formulario">
                

                {{-- Nombre y Teléfono --}}
                <div class="form-row">
                    <div class="form-group">
                        <label>Nombre</label>
                        <input type="text" name="nombre" placeholder="Tu nombre completo" required>
                    </div>
                    <div class="form-group">
                        <label>Teléfono</label>
                        <input type="tel" name="telefono" placeholder="Ej: 999 999 999">
                    </div>
                </div>

                {{-- Correo --}}
                <div class="form-group">
                    <label>Correo electrónico</label>
                    <input type="email" name="email" placeholder="tucorreo@ejemplo.com" required>
                </div>

                {{-- Asunto --}}
                <div class="form-group">
                    <label>Asunto</label>
                    <select name="asunto">
                        <option value="" disabled selected>Selecciona un asunto</option>
                        <option value="Información general">Información general</option>
                        <option value="Matrícula">Matrícula</option>
                        <option value="Pensiones">Pensiones</option>
                        <option value="Otro">Otro</option>
                    </select>
                </div>

                {{-- Mensaje --}}
                <div class="form-group">
                    <label>Mensaje</label>
                    <textarea name="mensaje" placeholder="Escribe tu consulta aquí..." required></textarea>
                </div>

                <button type="submit" class="btn-enviar">
                    <i class="fa-solid fa-paper-plane"></i> Enviar mensaje
                </button>
            </form>
        </div>

        <!-- MAPA -->
        <div class="mapa-box">
            <iframe
                src="https://www.google.com/maps?q=Colegio+Nuestra+Señora+del+Rosario+Huanuco&output=embed">
            </iframe>
        </div>

    </div>
</section>

@endsection


