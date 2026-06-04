<?php include __DIR__ . '/../layout/header.php'; ?>

<h2>Editar Cliente</h2>

<form method="POST" action="index.php?action=clientes&subaction=editar&id=<?php echo $cliente['id']; ?>" class="form-container">
    <div class="form-group">
        <label for="nombre">Nombre *</label>
        <input type="text" id="nombre" name="nombre" value="<?php echo htmlspecialchars($cliente['nombre']); ?>" required>
    </div>
    
    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($cliente['email']); ?>">
    </div>
    
    <div class="form-group">
        <label for="telefono">Telefono</label>
        <input type="text" id="telefono" name="telefono" value="<?php echo htmlspecialchars($cliente['telefono']); ?>">
    </div>
    
    <div class="form-group">
        <label for="direccion">Direccion</label>
        <textarea id="direccion" name="direccion" rows="3"><?php echo htmlspecialchars($cliente['direccion']); ?></textarea>
    </div>
    
    <div class="form-actions">
        <button type="submit" class="btn btn-primary">Actualizar Cliente</button>
        <a href="index.php?action=clientes" class="btn btn-secondary">Cancelar</a>
    </div>
</form>

<?php include __DIR__ . '/../layout/footer.php'; ?>