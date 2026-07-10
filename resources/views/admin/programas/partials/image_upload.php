<?php
// Imagen actual del programa (si existe)
$imagenActual = $programa['imagen_principal'] ?? null;
?>

<!-- Zona de preview -->
<div class="img-upload-preview mb-3" id="previewZone">
    <?php if ($imagenActual): ?>
        <img src="<?= BASE_URL . htmlspecialchars($imagenActual) ?>" alt="Imagen actual" id="previewImg" class="img-preview-actual">
        <div class="img-preview-badge">
            <i class="bi bi-star-fill me-1"></i>Imagen actual
        </div>
    <?php else: ?>
        <div class="img-placeholder" id="imgPlaceholder">
            <i class="bi bi-image fs-1 text-muted"></i>
            <span class="text-muted small mt-2">Sin imagen</span>
        </div>
        <img src="" alt="Preview" id="previewImg" class="img-preview-actual d-none">
    <?php endif; ?>
</div>

<!-- Input de archivo -->
<label for="inputImagenPrograma" class="btn btn-outline-primary w-100 btn-sm mb-2">
    <i class="bi bi-upload me-2"></i>
    <?= $imagenActual ? 'Cambiar imagen' : 'Seleccionar imagen' ?>
</label>
<input type="file" name="imagen_principal" id="inputImagenPrograma" class="d-none" accept=".jpg,.jpeg,.png,.webp">

<p class="text-muted small mb-0 text-center">
    JPG, PNG o WEBP · Máx. 2 MB<br>
    Se redimensionará a 800×600 px
</p>

<!-- Validación y preview cliente -->
<script>
    document.getElementById('inputImagenPrograma').addEventListener('change', function () {
        const file = this.files[0];
        if (!file) return;

        const allowed = ['image/jpeg', 'image/png', 'image/webp'];
        if (!allowed.includes(file.type)) {
            alert('Formato no permitido. Solo JPG, PNG o WEBP.');
            this.value = '';
            return;
        }
        if (file.size > 2 * 1024 * 1024) {
            alert('La imagen supera los 2 MB.');
            this.value = '';
            return;
        }

        const reader = new FileReader();
        reader.onload = e => {
            const img = document.getElementById('previewImg');
            const placeholder = document.getElementById('imgPlaceholder');

            img.src = e.target.result;
            img.classList.remove('d-none');
            if (placeholder) placeholder.classList.add('d-none');

            // Actualizar badge si ya existía
            const badge = document.querySelector('.img-preview-badge');
            if (badge) badge.textContent = '✓ Nueva imagen lista';
        };
        reader.readAsDataURL(file);
    });
</script>