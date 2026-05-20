@extends('layouts.admin')
 
@section('titulo', 'Editar Evento')
 
@section('contenido')
 
{{-- ── MENSAJES FLASH ── --}}
@if(session('error'))
    <div style="background:rgba(248,113,113,0.15); color:#f87171; border:1px solid rgba(248,113,113,0.3); padding:14px 18px; border-radius:12px; margin-bottom:24px; display:flex; align-items:center; gap:10px;">
        <i class="fa-solid fa-circle-exclamation"></i> {{ session('error') }}
    </div>
@endif
 
@if(session('success'))
    <div style="background:rgba(34,197,94,0.15); color:#22c55e; border:1px solid rgba(34,197,94,0.3); padding:14px 18px; border-radius:12px; margin-bottom:24px; display:flex; align-items:center; gap:10px;">
        <i class="fa-solid fa-circle-check"></i> {{ session('success') }}
    </div>
@endif
 
{{-- ══════════════════════════════════════════
     FORMS DE ELIMINAR IMAGEN — FUERA del form principal
     El navegador NO permite forms anidados, por eso
     estos van aquí arriba y se disparan con JS.
════════════════════════════════════════════ --}}
@foreach($evento->imagenes as $img)
<form id="form-delete-img-{{ $img->id }}"
      action="{{ route('admin.eventos.imagen.delete', $img->id) }}"
      method="POST"
      style="display:none;">
    @csrf
</form>
@endforeach
 
{{-- ── ENCABEZADO ── --}}
<div style="padding: 20px 0 40px 0; text-align:center;">
    <div style="display: inline-block; background: rgba(251,191,36,0.1); padding: 15px; border-radius: 50%; margin-bottom: 16px;">
        <i class="fa-solid fa-calendar-check" style="font-size: 2.5rem; color: var(--accent);"></i>
    </div>
    <h1 style="margin: 0; font-size: 2.2rem; color: #fff;">Editar Evento</h1>
    <p style="max-width:600px; margin: 12px auto; color: var(--text-muted);">
        Actualiza la información del evento y gestiona la galería de imágenes.
    </p>
</div>
 
{{-- ── FORMULARIO PRINCIPAL ── --}}
<div style="max-width:850px; margin:auto; background: var(--card-bg); backdrop-filter: blur(10px); padding: 35px; border-radius: 24px; border: 1px solid var(--border-color); box-shadow: 0 20px 25px -5px rgba(0,0,0,0.2);">
 
    <form method="POST" action="{{ route('admin.eventos.update', $evento->id) }}" enctype="multipart/form-data">
        @csrf
 
        <div style="display:grid; gap:24px;">
 
            {{-- Mes y Título --}}
            <div style="display: grid; grid-template-columns: 1fr 2fr; gap: 20px;">
                <div>
                    <label style="display:block; font-weight:600; color:#f1f5f9; margin-bottom:8px;">
                        <i class="fa-solid fa-calendar-day" style="color:var(--accent); margin-right:8px;"></i> Mes
                    </label>
                    <input type="text" name="mes" value="{{ old('mes', $evento->mes) }}"
                        style="width:100%; padding:14px; background:rgba(15,23,42,0.5); border:1px solid var(--border-color); border-radius:12px; color:#fff; outline:none;"
                        onfocus="this.style.borderColor='var(--primary)'" onblur="this.style.borderColor='var(--border-color)'" required>
                    @error('mes') <p style="color:#f87171; font-size:0.85rem; margin-top:6px;">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label style="display:block; font-weight:600; color:#f1f5f9; margin-bottom:8px;">
                        <i class="fa-solid fa-font" style="color:var(--accent); margin-right:8px;"></i> Título
                    </label>
                    <input type="text" name="titulo" value="{{ old('titulo', $evento->titulo) }}"
                        style="width:100%; padding:14px; background:rgba(15,23,42,0.5); border:1px solid var(--border-color); border-radius:12px; color:#fff; outline:none;"
                        onfocus="this.style.borderColor='var(--primary)'" onblur="this.style.borderColor='var(--border-color)'" required>
                    @error('titulo') <p style="color:#f87171; font-size:0.85rem; margin-top:6px;">{{ $message }}</p> @enderror
                </div>
            </div>
 
            {{-- Descripción --}}
            <div>
                <label style="display:block; font-weight:600; color:#f1f5f9; margin-bottom:8px;">
                    <i class="fa-solid fa-align-left" style="color:var(--accent); margin-right:8px;"></i> Descripción
                </label>
                <textarea name="descripcion" rows="2" required placeholder="Breve resumen de la actividad..."
    style="width:100%; padding:14px; background:rgba(15,23,42,0.5); border:1px solid var(--border-color); border-radius:12px; color:#fff; outline:none; resize:vertical;"
    onfocus="this.style.borderColor='var(--primary)'" onblur="this.style.borderColor='var(--border-color)'"
    oninvalid="this.setCustomValidity('⚠️ Debes escribir una descripción del evento')"
    oninput="this.setCustomValidity('')">{{ old('descripcion', $evento->descripcion) }}</textarea>
            </div>
 
            {{-- Galería actual --}}
            <div style="background:rgba(0,0,0,0.2); padding:20px; border-radius:18px; border:1px solid var(--border-color);">
                <label style="display:block; font-weight:600; color:#fff; margin-bottom:15px;">
                    <i class="fa-solid fa-images" style="color:var(--primary); margin-right:8px;"></i>
                    Imágenes en la galería
                    <span style="font-size:0.8rem; color:var(--text-muted); margin-left:8px;">
                        ({{ $evento->imagenes->count() }}/3)
                    </span>
                </label>
 
                @if($evento->imagenes->isEmpty())
                    <p style="color:var(--text-muted); font-size:0.9rem; text-align:center; padding:20px 0;">
                        <i class="fa-solid fa-image-slash" style="margin-right:6px;"></i> Sin imágenes aún.
                    </p>
                @else
                    <div style="display:grid; grid-template-columns:repeat(auto-fill, minmax(110px,1fr)); gap:12px;">
                        @foreach($evento->imagenes as $img)
                        <div style="position:relative; border-radius:12px; overflow:hidden; border:1px solid var(--border-color); aspect-ratio:1/1;">
                            <img src="{{ asset('meses/' . $img->imagen) }}"
                                 style="width:100%; height:100%; object-fit:cover; display:block;">
 
                            {{-- ✅ Botón que dispara el form externo con JS --}}
                            <button type="button"
                                onclick="if(confirm('¿Eliminar esta imagen permanentemente?')) document.getElementById('form-delete-img-{{ $img->id }}').submit()"
                                style="position:absolute; top:6px; right:6px; background:rgba(239,68,68,0.9); color:#fff; border:none; border-radius:50%; width:28px; height:28px; cursor:pointer; display:flex; align-items:center; justify-content:center; font-size:0.75rem; transition:0.2s;"
                                onmouseover="this.style.background='#dc2626'"
                                onmouseout="this.style.background='rgba(239,68,68,0.9)'"
                                title="Eliminar imagen">
                                <i class="fa-solid fa-xmark"></i>
                            </button>
                        </div>
                        @endforeach
                    </div>
                @endif
            </div>
 
            {{-- Subir nuevas imágenes (solo si hay espacio) --}}
            @if($evento->imagenes->count() < 3)
            <div>
                <label style="display:block; font-weight:600; color:#f1f5f9; margin-bottom:12px;">
                    <i class="fa-solid fa-plus-circle" style="color:var(--primary); margin-right:8px;"></i>
                    Añadir imágenes
                    <span style="font-size:0.8rem; color:var(--text-muted);">
                        (puedes añadir hasta {{ 3 - $evento->imagenes->count() }} más)
                    </span>
                </label>
                <div id="drop-area-edit"
                     style="border:2px dashed var(--border-color); padding:30px; border-radius:16px; text-align:center; background:rgba(15,23,42,0.2); transition:all 0.3s ease; cursor:pointer;"
                     onclick="document.getElementById('upload-edit').click()">
                    <input type="file" name="imagenes[]" multiple accept="image/*" id="upload-edit"
                           style="display:none;" onchange="updateFileCount(this)">
                    <i class="fa-solid fa-cloud-arrow-up" style="font-size:2rem; color:var(--primary); display:block; margin-bottom:10px;"></i>
                    <span id="file-name-text" style="color:var(--text-main); font-weight:600;">Haz clic para subir archivos</span>
                    <br>
                    <span style="color:var(--text-muted); font-size:0.8rem;">Se mantendrán las imágenes anteriores · JPG, PNG, WEBP · Máx. 4MB</span>
                </div>
            </div>
            @else
            <div style="background:rgba(251,191,36,0.08); border:1px solid rgba(251,191,36,0.25); border-radius:12px; padding:14px 18px; color:#fbbf24; font-size:0.9rem;">
                <i class="fa-solid fa-triangle-exclamation" style="margin-right:8px;"></i>
                Ya tienes 3 imágenes (máximo permitido). Elimina alguna para poder subir nuevas.
            </div>
            @endif
 
            <hr style="border:0; border-top:1px solid var(--border-color); margin:4px 0;">
 
            {{-- Botones --}}
            <div style="display:flex; gap:12px; justify-content:flex-end; align-items:center;">
                <a href="{{ route('admin.eventos') }}"
                   style="text-decoration:none; color:var(--text-muted); font-weight:600; padding:12px 24px; border-radius:12px; transition:color 0.2s;"
                   onmouseover="this.style.color='#fff'" onmouseout="this.style.color='var(--text-muted)'">
                    Cancelar
                </a>
                <button type="submit"
                    style="background:var(--primary); color:#fff; padding:14px 35px; border:none; border-radius:12px; cursor:pointer; font-weight:700; box-shadow:0 4px 12px rgba(99,102,241,0.3); display:flex; align-items:center; gap:10px; transition:opacity 0.2s;"
                    onmouseover="this.style.opacity='0.85'" onmouseout="this.style.opacity='1'">
                    <i class="fa-solid fa-rotate"></i> Actualizar Evento
                </button>
            </div>
 
        </div>
    </form>
</div>
 
<script>
function updateFileCount(input) {
    const label = document.getElementById('file-name-text');
    const area  = document.getElementById('drop-area-edit');
 
    if (input.files && input.files.length > 0) {
        const n = input.files.length;
        label.innerText = n + (n === 1 ? ' nueva imagen lista' : ' nuevas imágenes listas');
        label.style.color      = 'var(--accent)';
        area.style.borderColor = 'var(--accent)';
        area.style.background  = 'rgba(251,191,36,0.05)';
    } else {
        label.innerText        = 'Haz clic para subir archivos';
        label.style.color      = 'var(--text-main)';
        area.style.borderColor = 'var(--border-color)';
        area.style.background  = 'rgba(15,23,42,0.2)';
    }
}
</script>
 
@endsection