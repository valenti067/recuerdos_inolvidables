<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<div class="container" style="padding: 40px 20px; display: flex; justify-content: center; align-items: center; min-height: 70vh;">
    <div style="background: #ffffff; width: 100%; max-width: 600px; padding: 30px; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.08);">
        
        <h2 style="color: #e6196e; margin-bottom: 20px; font-size: 24px; font-weight: bold; display: flex; align-items: center; gap: 8px;">
            ➕ Registrar Nuevo Proveedor
        </h2>

        <form action="index.php?controller=proveedor&action=guardar" method="POST">

            <!-- Nombre Comercial / Empresa -->
            <div style="margin-bottom: 15px;">
                <label style="display: block; font-weight: bold; font-size: 13px; margin-bottom: 5px; color: #333;">Nombre Comercial / Empresa *</label>
                <input type="text" name="nombre_empresa" required placeholder="Ej. Quince Bella Donna" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 6px; font-size: 14px; box-sizing: border-box;">
            </div>

            <!-- Categoría -->
            <div style="margin-bottom: 15px;">
                <label style="display: block; font-weight: bold; font-size: 13px; margin-bottom: 5px; color: #333;">Categoría *</label>
                <select name="categoria" required style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 6px; font-size: 14px; box-sizing: border-box; background: white;">
                    <option value="">-- Selecciona una Categoría --</option>
                    <option value="Salones y Jardines">Salones y Jardines</option>
                    <option value="Vestidos y Trajes">Vestidos y Trajes</option>
                    <option value="Fotografía y Video">Fotografía y Video</option>
                    <option value="Banquetes y Catering">Banquetes y Catering</option>
                    <option value="Música y Animación">Música y Animación</option>
                    <option value="Decoración">Decoración</option>
                    <option value="Maquillaje y Peinado">Maquillaje y Peinado</option>
                    <option value="Invitaciones">Invitaciones</option>
                    <option value="Pastelería">Pastelería</option>
                    <option value="Otro">Otro</option>
                </select>
            </div>

            <!-- Teléfono y Correo en fila doble -->
            <div style="display: flex; gap: 15px; margin-bottom: 15px;">
                <div style="flex: 1;">
                    <label style="display: block; font-weight: bold; font-size: 13px; margin-bottom: 5px; color: #333;">Teléfono (WhatsApp)</label>
                    <input type="text" name="telefono" placeholder="5551122" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 6px; font-size: 14px; box-sizing: border-box;">
                </div>
                <div style="flex: 1;">
                    <label style="display: block; font-weight: bold; font-size: 13px; margin-bottom: 5px; color: #333;">Correo Electrónico</label>
                    <input type="email" name="email" placeholder="correo@ejemplo.com" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 6px; font-size: 14px; box-sizing: border-box;">
                </div>
            </div>

            <!-- Dirección / Ubicación -->
            <div style="margin-bottom: 15px;">
                <label style="display: block; font-weight: bold; font-size: 13px; margin-bottom: 5px; color: #333;">Dirección / Ubicación</label>
                <input type="text" name="direccion" placeholder="Ej. Pasaje Comercial El Ángel, Local 4" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 6px; font-size: 14px; box-sizing: border-box;">
            </div>

            <!-- Descripción del Servicio -->
            <div style="margin-bottom: 15px;">
                <label style="display: block; font-weight: bold; font-size: 13px; margin-bottom: 5px; color: #333;">Descripción del Servicio</label>
                <textarea name="descripcion" rows="4" placeholder="Describe los servicios que ofrece el proveedor..." style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 6px; font-size: 14px; box-sizing: border-box; resize: vertical;"></textarea>
            </div>

            <!-- Proveedor Destacado -->
            <div style="margin-bottom: 25px; background: #fff5f8; padding: 12px 15px; border-radius: 6px; border: 1px solid #fce4ec; display: flex; align-items: center; gap: 8px;">
                <input type="checkbox" name="destacado" id="destacado" value="1" style="width: 16px; height: 16px; accent-color: #e6196e;">
                <label for="destacado" style="font-size: 13px; font-weight: bold; color: #e6196e; cursor: pointer;">
                    ⭐ Marcar como Proveedor Destacado
                </label>
            </div>

            <!-- Botones -->
            <div style="display: flex; justify-content: space-between; align-items: center;">
                <a href="index.php?controller=proveedor&action=index" style="color: #666; text-decoration: none; font-size: 14px; font-weight: 500;">Cancelar</a>
                <button type="submit" style="background: #e6196e; color: white; border: none; padding: 10px 20px; border-radius: 6px; font-weight: bold; font-size: 14px; cursor: pointer;">
                    Guardar Proveedor
                </button>
            </div>
        </form>

    </div>
</div>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>