<?php include __DIR__ . '/../layout/header.php'; ?>

<h2>Nuevo Cliente</h2>

<form method="POST" action="index.php?action=clientes&subaction=crear" class="form-container">
    <div class="form-group">
        <label for="nombre">Nombre *</label>
        <input type="text" id="nombre" name="nombre" required>
    </div>
    
    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" id="email" name="email">
    </div>
    
    <div class="form-group">
        <label for="telefono">Telefono</label>
        <input type="text" id="telefono" name="telefono">
    </div>
    
    <div class="form-group">
        <label for="direccion">Direccion</label>
        <textarea id="direccion" name="direccion" rows="3"></textarea>
    </div>
    
    <div class="form-actions">
        <button type="submit" class="btn btn-primary">Guardar Cliente</button>
        <a href="index.php?action=clientes" class="btn btn-secondary">Cancelar</a>
    </div>
</form>

<?php include __DIR__ . '/../layout/footer.php'; ?>