<?php include __DIR__ . '/../layout/header.php'; ?>

<h2>Gestion de Proyectos</h2>

<div class="actions-bar">
    <a href="index.php?action=proyectos&subaction=crear" class="btn btn-primary">+ Nuevo Proyecto</a>
</div>

<?php if (empty($proyectos)): ?>
    <div class="alert alert-info">No hay proyectos registrados.</div>
<?php else: ?>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Proyecto</th>
                    <th>Cliente</th>
                    <th>Estado</th>
                    <th>Monto</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($proyectos as $proyecto): ?>
                <tr>
                    <td><?php echo $proyecto['id']; ?></td>
                    <td><?php echo htmlspecialchars($proyecto['nombre_proyecto']); ?></td>
                    <td><?php echo htmlspecialchars($proyecto['cliente_nombre']); ?></td>
                    <td>
                        <form method="POST" action="index.php?action=proyectos&subaction=estado&id=<?php echo $proyecto['id']; ?>" class="form-estado">
                            <select name="estado" onchange="this.form.submit()">
                                <option value="recibido" <?php echo $proyecto['estado'] == 'recibido' ? 'selected' : ''; ?>>Recibido</option>
                                <option value="validado" <?php echo $proyecto['estado'] == 'validado' ? 'selected' : ''; ?>>Validado</option>
                                <option value="en_preparacion" <?php echo $proyecto['estado'] == 'en_preparacion' ? 'selected' : ''; ?>>En Preparacion</option>
                                <option value="despachado" <?php echo $proyecto['estado'] == 'despachado' ? 'selected' : ''; ?>>Despachado</option>
                                <option value="confirmado" <?php echo $proyecto['estado'] == 'confirmado' ? 'selected' : ''; ?>>Confirmado</option>
                            </select>
                        </form>
                    </td>
                    <td>S/ <?php echo number_format($proyecto['monto'], 2); ?></td>
                    <td class="actions">
                        <a href="index.php?action=proyectos&subaction=editar&id=<?php echo $proyecto['id']; ?>" class="btn-edit">Editar</a>
                        <a href="index.php?action=proyectos&subaction=eliminar&id=<?php echo $proyecto['id']; ?>" class="btn-delete" onclick="return confirm('Eliminar este proyecto?')">Eliminar</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php endif; ?>

<?php include __DIR__ . '/../layout/footer.php'; ?>