@extends('layouts.admin')

@section('titulo', 'Gestión de Noticias')

@section('contenido')
    <!-- Cabecera -->
    <div style="padding: 20px 0 40px 0; text-align:center;">
        <i class="fa-solid fa-newspaper" style="font-size: 3rem; color: var(--primary); margin-bottom: 20px;"></i>
        <h1 style="margin: 0; font-size: 2.2rem; color: #fff;">Noticias</h1>
        <p style="max-width:720px; margin: 16px auto; color: var(--text-muted);">
            Administra las novedades del colegio. Publica eventos importantes o logros académicos.
        </p>
    </div>

    <!-- Alerta de Éxito -->
    @if(session('success'))
        <div style="max-width:900px; margin:0 auto 24px; padding:16px 20px; background: rgba(16, 185, 129, 0.1); border: 1px solid #10b981; color: #34d399; border-radius: 12px; display: flex; align-items: center; gap: 12px;">
            <i class="fa-solid fa-circle-check"></i>
            {{ session('success') }}
        </div>
    @endif

    <div style="max-width:900px; margin:auto; display:grid; gap:30px;">
        
        <!-- SECCIÓN: CREAR NOTICIA -->
        <section style="background: var(--card-bg); backdrop-filter: blur(10px); padding: 30px; border-radius: 24px; border: 1px solid var(--border-color);">
            <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 24px;">
                <div style="background: rgba(99, 102, 241, 0.2); padding: 8px; border-radius: 8px;">
                    <i class="fa-solid fa-plus" style="color: var(--primary);"></i>
                </div>
                <h2 style="margin: 0; color: #fff; font-size: 1.4rem;">Crear nueva noticia</h2>
            </div>

            <form action="{{ route('admin.noticias.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div style="display:grid; gap:20px;">
                    <div>
                        <label style="display:block; font-weight:600; color: var(--text-muted); margin-bottom: 8px;">Título</label>
                        <input type="text" name="titulo" value="{{ old('titulo') }}" 
                            style="width:100%; padding:14px; background: rgba(15, 23, 42, 0.5); border: 1px solid var(--border-color); border-radius: 12px; color: #fff; outline: none;" 
                            placeholder="Ej: Gran feria de ciencias 2026" required>
                        @error('titulo')<p style="color:#f87171; font-size: 0.85rem; margin-top: 6px;">{{ $message }}</p>@enderror
                    </div>

                    <div>
                        <label style="display:block; font-weight:600; color: var(--text-muted); margin-bottom: 8px;">Descripción</label>
                        <textarea name="descripcion" rows="4" 
                            style="width:100%; padding:14px; background: rgba(15, 23, 42, 0.5); border: 1px solid var(--border-color); border-radius: 12px; color: #fff; outline: none; resize: vertical;" 
                            placeholder="Escribe el contenido de la noticia aquí..." required>{{ old('descripcion') }}</textarea>
                        @error('descripcion')<p style="color:#f87171; font-size: 0.85rem; margin-top: 6px;">{{ $message }}</p>@enderror
                    </div>

                     <div>
<div>
    <label style="display:block; font-weight:600; color: var(--text-muted); margin-bottom: 8px;">Imagen (Opcional)</label>
    <div style="border: 2px dashed var(--border-color); padding: 20px; border-radius: 12px; text-align: center; transition: all 0.3s;" id="drop-zone">
        <input type="file" name="imagen" accept="image/*" id="upload-news" style="display: none;" onchange="updateFileName(this)">
        
        <label for="upload-news" style="cursor: pointer; display: flex; flex-direction: column; align-items: center; gap: 8px;">
            <i class="fa-solid fa-cloud-arrow-up" style="font-size: 1.5rem; color: var(--primary);"></i>
            <!-- Aquí es donde se mostrará el nombre -->
            <span id="file-name" style="color: var(--primary); font-weight: 600; font-size: 0.9rem;">Seleccionar imagen</span>
            <span id="file-chosen" style="color: var(--text-muted); font-size: 0.8rem;">Ningún archivo seleccionado</span>
        </label>
    </div>
</div>
                        @error('imagen')<p style="color:#f87171; font-size: 0.85rem; margin-top: 6px;">{{ $message }}</p>@enderror
                    </div>

                    <button type="submit" style="background: var(--primary); color:#fff; font-weight:700; padding:14px 24px; border:none; border-radius:12px; cursor:pointer; width:fit-content; box-shadow: 0 4px 12px rgba(99, 102, 241, 0.3);">
                        <i class="fa-solid fa-paper-plane" style="margin-right: 8px;"></i> Publicar Noticia
                    </button>
                </div>
            </form>
        </section>

        <!-- SECCIÓN: LISTADO -->
        <section style="background: var(--card-bg); backdrop-filter: blur(10px); padding: 30px; border-radius: 24px; border: 1px solid var(--border-color);">
            <h2 style="margin: 0 0 24px 0; color: #fff; font-size: 1.4rem; display: flex; align-items: center; gap: 10px;">
                <i class="fa-solid fa-list-ul" style="color: var(--accent);"></i> Noticias existentes
            </h2>

            @if($noticias->isEmpty())
                <div style="text-align: center; padding: 40px; color: var(--text-muted);">
                    <i class="fa-regular fa-folder-open" style="font-size: 2rem; display: block; margin-bottom: 10px;"></i>
                    No hay noticias publicadas todavía.
                </div>
            @else
                <div style="display:grid; gap:20px;">
                    @foreach($noticias as $noticia)
                        <div style="background: rgba(255,255,255,0.02); border: 1px solid var(--border-color); border-radius: 18px; padding: 20px; display: flex; gap: 20px; align-items: center; flex-wrap: wrap;">
                            
                            @if($noticia->imagen)
                                <img src="{{ asset('noticias/' . $noticia->imagen) }}" alt="Noticia" 
                                    style="width: 120px; height: 120px; object-fit: cover; border-radius: 12px; border: 1px solid var(--border-color);">
                            @else
                                <div style="width: 120px; height: 120px; background: var(--bg-dark); border-radius: 12px; display: flex; align-items: center; justify-content: center; color: var(--border-color);">
                                    <i class="fa-solid fa-image fa-2x"></i>
                                </div>
                            @endif

                            <div style="flex: 1; min-width: 250px;">
                                <h3 style="margin: 0 0 6px 0; color: #fff; font-size: 1.15rem;">{{ $noticia->titulo }}</h3>
                                <p style="margin: 0; color: var(--text-muted); font-size: 0.9rem; line-height: 1.5;">
                                    {{ Str::limit($noticia->descripcion, 100) }}
                                </p>
                            </div>

                            <div style="display:flex; gap:10px;">
                                <a href="{{ route('admin.noticias.edit', $noticia->id) }}" 
                                   style="background: rgba(255,255,255,0.05); color: #fff; padding: 10px; border-radius: 10px; text-decoration: none; border: 1px solid var(--border-color);" 
                                   title="Editar">
                                    <i class="fa-solid fa-pen"></i>
                                </a>
                                
                                <form action="{{ route('admin.noticias.destroy', $noticia->id) }}" method="POST" style="margin:0;" onsubmit="return confirm('¿Seguro que deseas eliminar esta noticia?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" style="background: rgba(248, 113, 113, 0.1); color: #f87171; padding: 10px; border: 1px solid rgba(248, 113, 113, 0.2); border-radius: 10px; cursor: pointer;" title="Eliminar">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </section>
    </div>
    <script>
function updateFileName(input) {
    const fileNameDisplay = document.getElementById('file-chosen');
    const container = document.getElementById('drop-zone');
    
    if (input.files && input.files.length > 0) {
        // Obtenemos el nombre del archivo
        let name = input.files[0].name;
        
        // Si el nombre es muy largo, lo cortamos para que no rompa el diseño
        if(name.length > 25) {
            name = name.substring(0, 22) + "...";
        }
        
        fileNameDisplay.innerText = "Archivo: " + name;
        fileNameDisplay.style.color = "#fbbf24"; // Color ámbar para resaltar que hay algo cargado
        container.style.borderColor = "var(--primary)";
        container.style.background = "rgba(99, 102, 241, 0.05)";
    } else {
        fileNameDisplay.innerText = "Ningún archivo seleccionado";
        fileNameDisplay.style.color = "var(--text-muted)";
        container.style.borderColor = "var(--border-color)";
        container.style.background = "transparent";
    }
}
</script>
@endsection