<?php include __DIR__ . '/../layout/header.php'; ?>

<h2>Editar Proyecto</h2>

<form method="POST" action="index.php?action=proyectos&subaction=editar&id=<?php echo $proyecto['id']; ?>" class="form-container">
    <div class="form-group">
        <label for="nombre_proyecto">Nombre del Proyecto *</label>
        <input type="text" id="nombre_proyecto" name="nombre_proyecto" value="<?php echo htmlspecialchars($proyecto['nombre_proyecto']); ?>" required>
    </div>
    
    <div class="form-group">
        <label for="cliente_id">Cliente *</label>
        <select id="cliente_id" name="cliente_id" required>
            <option value="">Seleccione un cliente</option>
            <?php foreach ($clientes as $cliente): ?>
                <option value="<?php echo $cliente['id']; ?>" <?php echo $cliente['id'] == $proyecto['cliente_id'] ? 'selected' : ''; ?>>
                    <?php echo htmlspecialchars($cliente['nombre']); ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
    
    <div class="form-group">
        <label for="descripcion">Descripcion</label>
        <textarea id="descripcion" name="descripcion" rows="4"><?php echo htmlspecialchars($proyecto['descripcion']); ?></textarea>
    </div>
    
    <div class="form-group">
        <label for="estado">Estado</label>
        <select id="estado" name="estado">
            <option value="recibido" <?php echo $proyecto['estado'] == 'recibido' ? 'selected' : ''; ?>>Recibido</option>
            <option value="validado" <?php echo $proyecto['estado'] == 'validado' ? 'selected' : ''; ?>>Validado</option>
            <option value="en_preparacion" <?php echo $proyecto['estado'] == 'en_preparacion' ? 'selected' : ''; ?>>En Preparacion</option>
            <option value="despachado" <?php echo $proyecto['estado'] == 'despachado' ? 'selected' : ''; ?>>Despachado</option>
            <option value="confirmado" <?php echo $proyecto['estado'] == 'confirmado' ? 'selected' : ''; ?>>Confirmado</option>
        </select>
    </div>
    
    <div class="form-group">
        <label for="monto">Monto (S/)</label>
        <input type="number" id="monto" name="monto" step="0.01" value="<?php echo $proyecto['monto']; ?>">
    </div>
    
    <div class="form-actions">
        <button type="submit" class="btn btn-primary">Actualizar Proyecto</button>
        <a href="index.php?action=proyectos" class="btn btn-secondary">Cancelar</a>
    </div>
</form>

<?php include __DIR__ . '/../layout/footer.php'; ?>