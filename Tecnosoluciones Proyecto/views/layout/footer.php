        </main>
        <footer>
            <p>TecnoSoluciones S.A. - Sistema de Gestion de Proyectos</p>
            <p><?php echo date('Y'); ?></p>
        </footer>
    </div>
</body>
</html>
<?php
if (isset($_SESSION['tipo_mensaje'])) unset($_SESSION['tipo_mensaje']);
?>