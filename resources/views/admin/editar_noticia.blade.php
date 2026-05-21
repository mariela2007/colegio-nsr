@extends('layouts.admin')

@section('titulo', 'Editar Noticia')

@section('contenido')

{{-- ══ ENCABEZADO ══ --}}
<div style="padding: 20px 0 40px 0; text-align: center;">
    <div style="display: inline-block; background: rgba(99,102,241,0.1); padding: 12px; border-radius: 50%; margin-bottom: 16px;">
        <i class="fa-solid fa-pen-to-square" style="font-size: 2rem; color: var(--primary);"></i>
    </div>
    <h1 style="margin: 0; font-size: 2rem; color: #fff;">Editar Noticia</h1>
    <p style="max-width: 600px; margin: 12px auto; color: var(--text-muted);">
        Realiza los cambios necesarios en la publicación. Recuerda que la imagen debe ser clara y descriptiva.
    </p>
</div>

{{-- ══ FORMULARIO ══ --}}
<div style="max-width: 750px; margin: auto; background: var(--card-bg); backdrop-filter: blur(10px); padding: 32px; border-radius: 24px; border: 1px solid var(--border-color); box-shadow: 0 20px 25px -5px rgba(0,0,0,0.2);">

    <form action="{{ route('admin.noticias.update', $noticia->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div style="display: grid; gap: 24px;">

            {{-- Título --}}
            <div>
                <label style="display: block; font-weight: 600; color: #f1f5f9; margin-bottom: 8px;">
                    <i class="fa-solid fa-heading" style="color: var(--accent); margin-right: 8px;"></i> Título de la noticia
                </label>
                <input type="text" name="titulo" value="{{ old('titulo', $noticia->titulo) }}"
                    style="width: 100%; padding: 14px; background: rgba(15,23,42,0.5); border: 1px solid var(--border-color); border-radius: 12px; color: #fff; outline: none; transition: border-color 0.3s;"
                    onfocus="this.style.borderColor='var(--primary)'"
                    onblur="this.style.borderColor='var(--border-color)'"
                    required>
                @error('titulo')
                    <p style="color: #f87171; font-size: 0.85rem; margin-top: 6px;">{{ $message }}</p>
                @enderror
            </div>

            {{-- Descripción --}}
            <div>
                <label style="display: block; font-weight: 600; color: #f1f5f9; margin-bottom: 8px;">
                    <i class="fa-solid fa-align-left" style="color: var(--accent); margin-right: 8px;"></i> Contenido / Descripción
                </label>
                <textarea name="descripcion" rows="6"
                    style="width: 100%; padding: 14px; background: rgba(15,23,42,0.5); border: 1px solid var(--border-color); border-radius: 12px; color: #fff; outline: none; resize: vertical; transition: border-color 0.3s;"
                    onfocus="this.style.borderColor='var(--primary)'"
                    onblur="this.style.borderColor='var(--border-color)'"
                    required>{{ old('descripcion', $noticia->descripcion) }}</textarea>
                @error('descripcion')
                    <p style="color: #f87171; font-size: 0.85rem; margin-top: 6px;">{{ $message }}</p>
                @enderror
            </div>

            {{-- Imagen --}}
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; align-items: start;">

                {{-- Imagen actual --}}
                <div>
                    <label style="display: block; font-weight: 600; color: #f1f5f9; margin-bottom: 12px;">
                        <i class="fa-solid fa-image" style="color: var(--accent); margin-right: 8px;"></i> Imagen actual
                    </label>
                    @if($noticia->imagen)
                        <div style="position: relative; border-radius: 16px; overflow: hidden; border: 2px solid var(--border-color);">
                            <img src="{{ $noticia->imagen}}"
                                 alt="Imagen noticia"
                                 style="width: 100%; height: 180px; object-fit: cover; display: block;">
                            <div style="position: absolute; inset: 0; background: linear-gradient(to top, rgba(0,0,0,0.5), transparent);"></div>
                        </div>
                    @else
                        <div style="height: 180px; background: rgba(15,23,42,0.5); border: 2px dashed var(--border-color); border-radius: 16px; display: flex; align-items: center; justify-content: center; color: var(--text-muted); gap: 8px;">
                            <i class="fa-solid fa-image-slash"></i> Sin imagen
                        </div>
                    @endif
                </div>

                {{-- Subir nueva imagen --}}
                <div>
                    <label style="display: block; font-weight: 600; color: #f1f5f9; margin-bottom: 12px;">
                        <i class="fa-solid fa-cloud-arrow-up" style="color: var(--accent); margin-right: 8px;"></i> Nueva imagen
                    </label>
                    <div id="drop-zone"
                         style="background: rgba(15,23,42,0.3); border: 2px dashed var(--border-color); padding: 28px 20px; border-radius: 12px; text-align: center; cursor: pointer; transition: all 0.3s;"
                         onclick="document.getElementById('file-upload').click()"
                         ondragover="event.preventDefault(); this.style.borderColor='var(--primary)'"
                         ondragleave="this.style.borderColor='var(--border-color)'"
                         ondrop="handleDrop(event)">
                        <input type="file" name="imagen" id="file-upload" accept="image/*"
                               style="display: none;" onchange="previewImagen(this)">
                        <i class="fa-solid fa-cloud-arrow-up" style="font-size: 1.6rem; color: var(--primary); display: block; margin-bottom: 8px;"></i>
                        <span id="file-label" style="font-size: 0.88rem; color: var(--text-muted);">Haz clic o arrastra una imagen</span>
                    </div>
                    @error('imagen')
                        <p style="color: #f87171; font-size: 0.85rem; margin-top: 6px;">{{ $message }}</p>
                    @enderror
                </div>

            </div>

            <hr style="border: 0; border-top: 1px solid var(--border-color); margin: 4px 0;">

            {{-- Botones --}}
            <div style="display: flex; gap: 12px; justify-content: flex-end; align-items: center;">
                <a href="{{ route('admin.noticias') }}"
                   style="text-decoration: none; color: var(--text-muted); font-weight: 600; padding: 12px 24px; border-radius: 12px; transition: color 0.2s;"
                   onmouseover="this.style.color='#fff'"
                   onmouseout="this.style.color='var(--text-muted)'">
                    Cancelar
                </a>
                <button type="submit"
                    style="background: var(--primary); color: #fff; padding: 12px 28px; border: none; border-radius: 12px; cursor: pointer; font-weight: 700; box-shadow: 0 4px 12px rgba(99,102,241,0.3); display: flex; align-items: center; gap: 10px; transition: opacity 0.2s;"
                    onmouseover="this.style.opacity='0.85'"
                    onmouseout="this.style.opacity='1'">
                    <i class="fa-solid fa-floppy-disk"></i> Guardar Cambios
                </button>
            </div>

        </div>
    </form>
</div>

<script>
function previewImagen(input) {
    const label = document.getElementById('file-label');
    const zone  = document.getElementById('drop-zone');
    if (input.files && input.files[0]) {
        label.textContent      = input.files[0].name;
        label.style.color      = 'var(--accent)';
        zone.style.borderColor = 'var(--accent)';
    }
}

function handleDrop(e) {
    e.preventDefault();
    const input = document.getElementById('file-upload');
    input.files = e.dataTransfer.files;
    previewImagen(input);
    document.getElementById('drop-zone').style.borderColor = 'var(--border-color)';
}
</script>

@endsection