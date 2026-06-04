<?php include __DIR__ . '/../layout/header.php'; ?>

<h2>Nuevo Proyecto</h2>

<form method="POST" action="index.php?action=proyectos&subaction=crear" class="form-container">
    <div class="form-group">
        <label for="nombre_proyecto">Nombre del Proyecto *</label>
        <input type="text" id="nombre_proyecto" name="nombre_proyecto" required>
    </div>
    
    <div class="form-group">
        <label for="cliente_id">Cliente *</label>
        <select id="cliente_id" name="cliente_id" required>
            <option value="">Seleccione un cliente</option>
            <?php foreach ($clientes as $cliente): ?>
                <option value="<?php echo $cliente['id']; ?>"><?php echo htmlspecialchars($cliente['nombre']); ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    
    <div class="form-group">
        <label for="descripcion">Descripcion</label>
        <textarea id="descripcion" name="descripcion" rows="4"></textarea>
    </div>
    
    <div class="form-group">
        <label for="monto">Monto (S/)</label>
        <input type="number" id="monto" name="monto" step="0.01" value="0.00">
    </div>
    
    <div class="form-actions">
        <button type="submit" class="btn btn-primary">Guardar Proyecto</button>
        <a href="index.php?action=proyectos" class="btn btn-secondary">Cancelar</a>
    </div>
</form>

<?php include __DIR__ . '/../layout/footer.php'; ?>