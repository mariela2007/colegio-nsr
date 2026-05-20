@extends('layouts.app')

@section('contenido')

<style>
html { scroll-behavior: smooth; }
body { margin: 0; }
.container { max-width: 100% !important; padding: 0 !important; }
.contenido { padding: 0 !important; margin: 0 !important; font-family: 'Plus Jakarta Sans', sans-serif; }

:root {
    --c-blue:   #0d3b66;
    --c-yellow: #ffca28;
}

/* ══════════════════════════════
   CABECERA
══════════════════════════════ */
.section-aviso {
    padding: 60px 10%;
    background: var(--c-blue);
    color: white;
    text-align: center;
}
.section-aviso h2 { font-size: 2.5rem; margin: 0 0 10px; }
.section-aviso p {
    font-size: 1.1rem; max-width: 700px;
    margin: 0 auto; line-height: 1.6; opacity: 0.95;
}
.linea-amarilla {
    width: 90px; height: 6px;
    background: var(--c-yellow);
    margin: 20px auto; border-radius: 3px;
}

/* ══════════════════════════════
   TARJETAS SUPERIORES
══════════════════════════════ */
.section {
    padding: 70px 10%;
    background: #fcbf49;
}
.sub-title {
    text-transform: uppercase; color: var(--c-blue);
    font-weight: 700; letter-spacing: 2px;
    font-size: 0.75rem; margin-bottom: 8px; text-align: center;
}
.section-title {
    text-align: center; font-size: 2rem; font-weight: 900;
    color: var(--c-blue); margin: 0 0 40px;
    font-family: 'Montserrat', sans-serif;
}
.pillars-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 24px;
}
.pillar-card {
    background: white; border-radius: 20px; overflow: hidden;
    box-shadow: 0 10px 30px rgba(0,0,0,0.10);
    transition: transform 0.35s ease, box-shadow 0.35s ease;
    position: relative; display: flex; flex-direction: column;
}
.pillar-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 24px 48px rgba(0,0,0,0.16);
}
.pillar-card::after {
    content: ""; position: absolute; bottom: 0; left: 0;
    width: 100%; height: 4px; background: var(--c-blue);
    transform: scaleX(0); transform-origin: left; transition: transform 0.35s ease;
}
.pillar-card:hover::after { transform: scaleX(1); }
.card-img { width: 100%; height: 180px; overflow: hidden; flex-shrink: 0; }
.card-img img {
    width: 100%; height: 100%; object-fit: cover;
    transition: transform 0.5s ease; display: block;
}
.pillar-card:hover .card-img img { transform: scale(1.08); }
.card-icon {
    position: absolute; top: 152px; left: 20px;
    width: 48px; height: 48px;
    background: var(--c-blue); color: var(--c-yellow);
    border-radius: 14px; display: flex; align-items: center;
    justify-content: center; font-size: 1.1rem;
    box-shadow: 0 6px 18px rgba(0,0,0,0.2);
    z-index: 5; border: 3px solid #fff;
}
.card-body {
    padding: 16px 20px 24px;
    display: flex; flex-direction: column; flex: 1;
}
.card-order {
    font-size: 0.65rem; font-weight: 800;
    letter-spacing: 2px; text-transform: uppercase;
    color: #bbb; margin-bottom: 4px;
}
.card-title {
    font-size: 1.2rem; font-weight: 800; color: var(--c-blue);
    margin: 0 0 10px; font-family: 'Montserrat', sans-serif; line-height: 1.2;
}
.card-sep { width: 36px; height: 3px; background: var(--c-yellow); border-radius: 2px; margin-bottom: 14px; }
.card-desc { font-size: 0.95rem; color: #666; line-height: 1.6; flex: 1; margin: 0 0 18px; }
.btn-programa {
    display: flex; align-items: center; justify-content: center; gap: 8px;
    padding: 11px 16px; background: var(--c-blue); color: white;
    border-radius: 12px; text-decoration: none; font-weight: 700;
    font-size: 0.95rem; transition: background 0.3s, transform 0.2s; margin-top: auto;
}
.btn-programa:hover { background: #000; transform: translateY(-2px); }

/* ══════════════════════════════
   SECCIONES DETALLE — NUEVA ESTRUCTURA
══════════════════════════════ */
.programa-section {
    padding: 80px 8%;
    background: #edf2f7;
}
.programa-section.alt {
    background: #f4f7ff;
}

/* Flex balanceado 50/50 */
.programa-flex {
    display: flex;
    align-items: stretch;
    gap: 0;
    border-radius: 24px;
    overflow: hidden;
    box-shadow: 0 20px 60px rgba(0,0,0,0.09);
    min-height: 480px;
}

/* Imagen ocupa exactamente la mitad */
.programa-img {
    width: 50%;
    flex-shrink: 0;
    overflow: hidden;
    position: relative;
}
.programa-img img {
    width: 100%; height: 100%;
    object-fit: cover;
    display: block;
    transition: transform 0.5s ease;
}
.programa-img:hover img { transform: scale(1.04); }

/* Overlay con badge del nivel */
.programa-img-badge {
    position: absolute;
    top: 24px; left: 24px;
    background: var(--c-yellow);
    color: var(--c-blue);
    font-size: 0.7rem; font-weight: 900;
    letter-spacing: 2px; text-transform: uppercase;
    padding: 7px 14px; border-radius: 8px;
    box-shadow: 0 4px 14px rgba(0,0,0,0.15);
}

/* Contenido ocupa la otra mitad */
.programa-content {
    width: 50%;
    background: #fff;
    padding: 48px 44px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    gap: 0;
}
.programa-section.alt .programa-content {
    background: #f4f7ff;
}

/* Ícono + título */
.prog-icon {
    width: 52px; height: 52px;
    background: var(--c-blue);
    color: var(--c-yellow);
    border-radius: 16px;
    display: flex; align-items: center; justify-content: center;
    font-size: 1.3rem;
    margin-bottom: 18px;
    box-shadow: 0 8px 20px rgba(13,59,102,0.2);
}

.prog-label {
    font-size: 0.68rem; font-weight: 800;
    letter-spacing: 3px; text-transform: uppercase;
    color: #aaa; margin-bottom: 6px;
}

.titulo {
    font-size: 2rem; font-weight: 900;
    color: var(--c-blue); margin: 0 0 8px;
    font-family: 'Montserrat', sans-serif; line-height: 1.15;
}

.prog-sep {
    width: 50px; height: 4px;
    background: var(--c-yellow);
    border-radius: 2px; margin-bottom: 18px;
}

.descripcion {
    color: #666; font-size: 0.97rem;
    line-height: 1.75; margin-bottom: 28px;
}

/* Info boxes rediseñadas */
.info-boxes { display: flex; flex-direction: column; gap: 14px; }

.info-box {
    background: rgba(13,59,102,0.04);
    padding: 16px 20px;
    border-left: 4px solid var(--c-blue);
    border-radius: 12px;
    transition: background 0.2s, transform 0.2s;
}
.info-box:hover {
    background: rgba(13,59,102,0.08);
    transform: translateX(4px);
}

.info-box h4 {
    color: var(--c-blue);
    font-size: 0.88rem; font-weight: 800;
    margin: 0 0 8px;
    display: flex; align-items: center; gap: 8px;
}
.info-box h4 i { color: var(--c-yellow); font-size: 0.95rem; }

.info-box p,
.info-box li {
    color: #555; font-size: 0.875rem; line-height: 1.65; margin: 0;
}
.info-box ul { padding-left: 16px; margin: 0; }
.info-box ul li { margin-bottom: 3px; }

/* ══ ALTERNADO: imagen derecha ══ */
.programa-flex.reverse {
    flex-direction: row-reverse;
}

/* ══════════════════════════════
   RESPONSIVE
══════════════════════════════ */
@media (max-width: 1100px) {
    .pillars-grid { grid-template-columns: repeat(2, 1fr); }
}

@media (max-width: 900px) {
    .programa-flex,
    .programa-flex.reverse { flex-direction: column; }

    .programa-img { width: 100%; height: 260px; }

    .programa-content {
        width: 100%;
        padding: 28px 20px; /* ← menos padding lateral */
        box-sizing: border-box; /* ← evita que se salga */
    }

    .titulo { font-size: 1.5rem; }

    .info-box p,
    .info-box li { font-size: 0.95rem; } /* ← texto más compacto */
}

@media (max-width: 600px) {
    .pillars-grid { grid-template-columns: 1fr; }

    .section { padding: 50px 5%; }

    .programa-section { padding: 40px 4%; }

    .programa-content { padding: 24px 16px; } /* ← aún más ajustado en pantallas chicas */

    .titulo { font-size: 1.3rem; }

    .descripcion { font-size: 0.9rem; }

    .info-box { padding: 12px 14px; }

    .info-box h4 { font-size: 0.83rem; }

    .section-aviso { padding: 40px 6%; }
    .section-aviso h2 { font-size: 1.8rem; }
    .section-aviso p { font-size: 0.95rem; }
}
</style>

<!-- CABECERA -->
<div class="section-aviso">
    <h2>Formación Académica</h2>
    <div class="linea-amarilla"></div>
    <p>Brindamos una educación integral que fortalece los conocimientos, valores y habilidades de nuestros estudiantes en cada etapa de su desarrollo.</p>
</div>

<!-- ══ TARJETAS SUPERIORES ══ -->
<div class="section">
    <div class="sub-title">Nuestros Programas</div>
    <h2 class="section-title">Programas Académicos</h2>

    <div class="pillars-grid">

        <div class="pillar-card">
            <div class="card-img"><img src="{{ asset('imagen/inicial.jpg') }}" alt="Inicial"></div>
            <div class="card-icon"><i class="fa-solid fa-child"></i></div>
            <div class="card-body">
                <div class="card-order">Nivel 01</div>
                <h3 class="card-title">Inicial</h3>
                <div class="card-sep"></div>
                <p class="card-desc">Los niños inician su aprendizaje jugando, creando y conviviendo con sus compañeros.</p>
                <a href="#inicial" class="btn-programa">Ver programa <i class="fa-solid fa-arrow-right"></i></a>
            </div>
        </div>

        <div class="pillar-card">
            <div class="card-img"><img src="{{ asset('imagen/primaria.jpg') }}" alt="Primaria"></div>
            <div class="card-icon"><i class="fa-solid fa-book-open"></i></div>
            <div class="card-body">
                <div class="card-order">Nivel 02</div>
                <h3 class="card-title">Primaria</h3>
                <div class="card-sep"></div>
                <p class="card-desc">Se fortalecen lectura, escritura y matemáticas junto con valores y hábitos de estudio.</p>
                <a href="#primaria" class="btn-programa">Ver programa <i class="fa-solid fa-arrow-right"></i></a>
            </div>
        </div>

        <div class="pillar-card">
            <div class="card-img"><img src="{{ asset('imagen/secundaria.jpg') }}" alt="Secundaria"></div>
            <div class="card-icon"><i class="fa-solid fa-graduation-cap"></i></div>
            <div class="card-body">
                <div class="card-order">Nivel 03</div>
                <h3 class="card-title">Secundaria</h3>
                <div class="card-sep"></div>
                <p class="card-desc">Preparación académica y vocacional para estudios superiores o el mundo laboral.</p>
                <a href="#secundaria" class="btn-programa">Ver programa <i class="fa-solid fa-arrow-right"></i></a>
            </div>
        </div>

        <div class="pillar-card">
            <div class="card-img"><img src="{{ asset('imagen/psicopedagogia.jpg') }}" alt="Psicopedagogía"></div>
            <div class="card-icon"><i class="fa-solid fa-brain"></i></div>
            <div class="card-body">
                <div class="card-order">Servicio</div>
                <h3 class="card-title">Psicopedagogía</h3>
                <div class="card-sep"></div>
                <p class="card-desc">Apoyo integral para el aprendizaje y bienestar emocional de todos los estudiantes.</p>
                <a href="#psicopedagogia" class="btn-programa">Ver programa <i class="fa-solid fa-arrow-right"></i></a>
            </div>
        </div>

    </div>
</div>

<!-- ══ INICIAL — imagen izquierda ══ -->
<section id="inicial" class="programa-section">
    <div class="programa-flex">
        <div class="programa-img">
            <img src="{{ asset('img-programas/' . ($imagenes['inicial']->imagen ?? 'inicial.jpg')) }}" alt="Inicial">
            <div class="programa-img-badge">Nivel Inicial</div>
        </div>
        <div class="programa-content">
            <div class="prog-icon"><i class="fa-solid fa-child"></i></div>
            <div class="prog-label">Nivel 01</div>
            <h2 class="titulo">Inicial</h2>
            <div class="prog-sep"></div>
            <p class="descripcion">Educación inicial orientada al desarrollo integral del niño en las áreas emocional, social, motriz y cognitiva.</p>
            <div class="info-boxes">
                <div class="info-box">
                    <h4><i class="fa-solid fa-user-group"></i> Información general</h4>
                    <p><strong>Edades:</strong> 3 a 5 años &nbsp;·&nbsp; <strong>Horario:</strong> 8:00 a.m. – 12:00 p.m. &nbsp;·&nbsp; <strong>Modalidad:</strong> Presencial</p>
                </div>
                <div class="info-box">
                    <h4><i class="fa-solid fa-book"></i> Áreas de aprendizaje</h4>
                    <ul>
                        <li>Comunicación &nbsp;·&nbsp; Psicomotricidad &nbsp;·&nbsp; Arte y creatividad</li>
                        <li>Personal Social &nbsp;·&nbsp; Ciencia y Tecnología &nbsp;·&nbsp; Matemática</li>
                        <li>Computación &nbsp;·&nbsp; Inglés inicial</li>
                    </ul>
                </div>
                <div class="info-box">
                    <h4><i class="fa-solid fa-chalkboard-user"></i> Metodología</h4>
                    <p>Aprendizaje basado en juegos, exploración, actividades vivenciales y estimulación temprana.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ══ PRIMARIA — imagen derecha ══ -->
<section id="primaria" class="programa-section alt">
    <div class="programa-flex reverse">
        <div class="programa-img">
            <img src="{{ asset('img-programas/' . ($imagenes['primaria']->imagen ?? 'primaria.jpg')) }}" alt="Primaria">
            <div class="programa-img-badge">Nivel Primaria</div>
        </div>
        <div class="programa-content">
            <div class="prog-icon"><i class="fa-solid fa-book-open"></i></div>
            <div class="prog-label">Nivel 02</div>
            <h2 class="titulo">Primaria</h2>
            <div class="prog-sep"></div>
            <p class="descripcion">Formación académica con desarrollo de habilidades cognitivas, valores y hábitos de estudio.</p>
            <div class="info-boxes">
                <div class="info-box">
                    <h4><i class="fa-solid fa-user-group"></i> Información general</h4>
                    <p><strong>Edades:</strong> 6 a 11 años &nbsp;·&nbsp; <strong>Horario:</strong> 7:45 a.m. – 1:30 p.m. &nbsp;·&nbsp; <strong>Modalidad:</strong> Presencial</p>
                </div>
                <div class="info-box">
                    <h4><i class="fa-solid fa-book"></i> Cursos</h4>
                    <ul>
                        <li>Comunicación &nbsp;·&nbsp; Matemática &nbsp;·&nbsp; Ciencia y Tecnología</li>
                        <li>Personal Social &nbsp;·&nbsp; Inglés &nbsp;·&nbsp; Educación Física</li>
                        <li>Arte y Cultura &nbsp;·&nbsp; Religión &nbsp;·&nbsp; Computación &nbsp;·&nbsp; Tutoría</li>
                    </ul>
                </div>
                <div class="info-box">
                    <h4><i class="fa-solid fa-chalkboard-user"></i> Metodología</h4>
                    <p>Aprendizaje activo, trabajo en equipo, proyectos educativos y reforzamiento continuo.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ══ SECUNDARIA — imagen izquierda ══ -->
<section id="secundaria" class="programa-section">
    <div class="programa-flex">
        <div class="programa-img">
            <img src="{{ asset('img-programas/' . ($imagenes['secundaria']->imagen ?? 'secundaria.jpg')) }}" alt="Secundaria">
            <div class="programa-img-badge">Nivel Secundaria</div>
        </div>
        <div class="programa-content">
            <div class="prog-icon"><i class="fa-solid fa-graduation-cap"></i></div>
            <div class="prog-label">Nivel 03</div>
            <h2 class="titulo">Secundaria</h2>
            <div class="prog-sep"></div>
            <p class="descripcion">Formación académica y vocacional orientada a estudios superiores y desarrollo profesional.</p>
            <div class="info-boxes">
                <div class="info-box">
                    <h4><i class="fa-solid fa-user-group"></i> Información general</h4>
                    <p><strong>Edades:</strong> 12 a 16 años &nbsp;·&nbsp; <strong>Horario:</strong> 7:30 a.m. – 2:30 p.m. &nbsp;·&nbsp; <strong>Modalidad:</strong> Presencial</p>
                </div>
                <div class="info-box">
                    <h4><i class="fa-solid fa-book"></i> Cursos</h4>
                    <ul>
                        <li>Comunicación y Literatura &nbsp;·&nbsp; Matemática (Álgebra, Geometría, Trigonometría)</li>
                        <li>Ciencias (Biología, Química, Física) &nbsp;·&nbsp; Ciencias Sociales</li>
                        <li>Inglés &nbsp;·&nbsp; Ed. Física &nbsp;·&nbsp; Arte &nbsp;·&nbsp; Computación &nbsp;·&nbsp; Tutoría</li>
                    </ul>
                </div>
                <div class="info-box">
                    <h4><i class="fa-solid fa-chalkboard-user"></i> Metodología</h4>
                    <p>Aprendizaje por competencias, proyectos interdisciplinarios y preparación preuniversitaria progresiva.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ══ PSICOPEDAGOGÍA — imagen derecha ══ -->
<section id="psicopedagogia" class="programa-section alt">
    <div class="programa-flex reverse">
        <div class="programa-img">
            <img src="{{ asset('img-programas/' . ($imagenes['psicopedagogia']->imagen ?? 'psicopedagogia.jpg')) }}" alt="Psicopedagogía">
            <div class="programa-img-badge">Servicio</div>
        </div>
        <div class="programa-content">
            <div class="prog-icon"><i class="fa-solid fa-brain"></i></div>
            <div class="prog-label">Apoyo Integral</div>
            <h2 class="titulo">Psicopedagogía</h2>
            <div class="prog-sep"></div>
            <p class="descripcion">Servicio de orientación y apoyo psicopedagógico para el acompañamiento del estudiante en su desarrollo emocional y académico.</p>
            <div class="info-boxes">
                <div class="info-box">
                    <h4><i class="fa-solid fa-user-group"></i> Atención</h4>
                    <p>Dirigido a todos los niveles educativos del colegio.</p>
                </div>
                <div class="info-box">
                    <h4><i class="fa-solid fa-heart"></i> Funciones</h4>
                    <ul>
                        <li>Orientación emocional &nbsp;·&nbsp; Dificultades de aprendizaje</li>
                        <li>Seguimiento académico &nbsp;·&nbsp; Apoyo a docentes y padres</li>
                    </ul>
                </div>
                <div class="info-box">
                    <h4><i class="fa-solid fa-chalkboard-user"></i> Intervención</h4>
                    <p>Evaluación psicopedagógica, acompañamiento individual y estrategias de mejora del aprendizaje.</p>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection