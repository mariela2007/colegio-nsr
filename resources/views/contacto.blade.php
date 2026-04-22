@extends('layouts.app')

@section('contenido')

<style>

/* 🔥 SOLUCIÓN GLOBAL (EVITA DESBORDES) */
* {
    box-sizing: border-box;
}

/* RESET */
body {
    margin: 0;
    background: #f4f7fb;
}

.container {
    max-width: 100% !important;
    padding: 0 !important;
}

.contenido {
    padding: 0 !important;
    margin: 0 !important;
    font-family: 'Plus Jakarta Sans', sans-serif;
}

/* VARIABLES */
:root {
    --c-blue: #0d3b66;
    --c-yellow: #ffca28;
}

/* ==============================
   HEADER
============================== */
.contacto-header {
    padding: 60px 10%;
    background: linear-gradient(135deg, #0d3b66, #08263f);
    text-align: center;
    color: white;
}

.contacto-header h2 {
    font-size: 2.8rem;
    font-weight: 800;
    margin-bottom: 10px;
}

.linea {
    width: 70px;
    height: 5px;
    background: var(--c-yellow);
    margin: 18px auto;
    border-radius: 3px;
}

.contacto-header p {
    max-width: 650px;
    margin: auto;
    font-size: 1.05rem;
    line-height: 1.6;
    opacity: 0.9;
}

/* ==============================
   MAIN
============================== */

.contacto-main {
    padding: 80px 10%;
    background: #f4f7fb; /* gris claro elegante */
}
/* GRID */
.contacto-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 60px;
    align-items: stretch;
}

/* ==============================
   FORMULARIO
============================== */
.formulario-box {
    background: rgba(255,255,255,0.7);
    backdrop-filter: blur(10px);
    padding: 30px;
    border-radius: 18px;
    box-shadow: 0 10px 40px rgba(0,0,0,0.08);

    height: 100%;
    width: 100%;
    overflow: hidden;

    display: flex;
    flex-direction: column;
    justify-content: center;
}

.formulario-box h3 {
    margin-bottom: 18px;
    color: var(--c-blue);
    font-size: 1.5rem;
    font-weight: 700;
}

/* FORM */
.formulario {
    display: flex;
    flex-direction: column;
    gap: 18px;
}

/* INPUTS (ARREGLADO 🔥) */
.formulario input,
.formulario textarea {
    width: 100%;
    padding: 14px 16px;
    border-radius: 12px;
    border: 1.5px solid #e2e6ea;
    background: #ffffff;
    font-size: 0.95rem;
    transition: all 0.25s ease;

    box-sizing: border-box; /* 🔥 CLAVE */
}

/* FOCUS */
.formulario input:focus,
.formulario textarea:focus {
    border-color: var(--c-blue);
    box-shadow: 0 0 0 3px rgba(13,59,102,0.1);
}

/* TEXTAREA */
.formulario textarea {
    height: 110px;
    resize: none;
}

/* BOTÓN */
.btn-enviar {
    margin-top: 10px;
    background: linear-gradient(135deg, #0d3b66, #000);
    color: white;
    padding: 14px;
    border-radius: 12px;
    border: none;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
}

.btn-enviar:hover {
    transform: translateY(-3px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.2);
}

/* ==============================
   MAPA
============================== */
.mapa-box {
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 15px 45px rgba(0,0,0,0.1);
    height: 100%;
}

.mapa-box iframe {
    width: 100%;
    height: 100%;
    min-height: 450px;
    border: none;
}

/* ==============================
   RESPONSIVE
============================== */
@media (max-width: 900px) {
    .contacto-grid {
        grid-template-columns: 1fr;
    }

    .contacto-main {
        padding: 60px 6%;
    }
}

</style>

<!-- HEADER -->
<section class="contacto-header">
    <h2>Contáctanos</h2>
    <div class="linea"></div>
    <p>
Nuestro equipo está disponible para brindarle información y orientación sobre nuestra propuesta educativa.
</p>
</section>

<!-- CONTENIDO -->
<section class="contacto-main">

    <div class="contacto-grid">

        <!-- FORM -->
        <div class="formulario-box">
            <h3>Envíanos un mensaje</h3>

            <form action="https://formspree.io/f/mwvaoble" method="POST" class="formulario">
                @csrf

                <input type="text" name="nombre" placeholder="Nombre completo" required>
                <input type="email" name="email" placeholder="Correo electrónico" required>
                <textarea name="mensaje" placeholder="Escribe tu consulta..." required></textarea>

                <button type="submit" class="btn-enviar">Enviar</button>
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