<?php include __DIR__ . '/../layout/header.php'; ?>

<h2>Gestion de Clientes</h2>

<div class="actions-bar">
    <a href="index.php?action=clientes&subaction=crear" class="btn btn-primary">+ Nuevo Cliente</a>
</div>

<?php if (empty($clientes)): ?>
    <div class="alert alert-info">No hay clientes registrados.</div>
<?php else: ?>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Telefono</th>
                    <th>Direccion</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($clientes as $cliente): ?>
                <tr>
                    <td><?php echo $cliente['id']; ?></td>
                    <td><?php echo htmlspecialchars($cliente['nombre']); ?></td>
                    <td><?php echo htmlspecialchars($cliente['email']); ?></td>
                    <td><?php echo htmlspecialchars($cliente['telefono']); ?></td>
                    <td><?php echo htmlspecialchars($cliente['direccion']); ?></td>
                    <td class="actions">
                        <a href="index.php?action=clientes&subaction=editar&id=<?php echo $cliente['id']; ?>" class="btn-edit">Editar</a>
                        <a href="index.php?action=clientes&subaction=eliminar&id=<?php echo $cliente['id']; ?>" class="btn-delete" onclick="return confirm('Eliminar este cliente?')">Eliminar</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php endif; ?>

<?php include __DIR__ . '/../layout/footer.php'; ?>