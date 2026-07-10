<div class="ui stackable grid container">
    <div class="row">
        <div class="twelve wide column">
            <h1 class="ui header">Reportes</h1>
            <div class="row">
                <div class="twelve wide column">
                    <div class="ui stackable grid container">

                        <?php
                            $permisos_requeridos = array(
                                'reporte_empleado.can_view',
                                'reporte_operador.can_view',
                                'reporte_admin.can_view',
                            );
                            if (has_permission_or($permisos_requeridos, $permisos_usuario)) { ?>
                                <div class="eight wide column">
                                    <?php include "btn_asistencia.php" ?>
                                </div>
                            <?php }
                        ?>

                        <?php
                            $permisos_requeridos = array(
                                'reporte_empleado.can_view',
                                'reporte_operador.can_view',
                                'reporte_admin.can_view',
                            );
                            if (has_permission_or($permisos_requeridos, $permisos_usuario)) { ?>
                                <div class="eight wide column">
                                    <?php include "btn_incidentes.php" ?>
                                </div>
                            <?php }
                        ?>

                        <?php
                            $permisos_requeridos = array(
                                'reporte_empleado.can_view',
                                'reporte_operador.can_view',
                                'reporte_admin.can_view',
                            );
                            if (has_permission_or($permisos_requeridos, $permisos_usuario)) { ?>
                                <div class="eight wide column">
                                    <?php include "btn_bitacora.php" ?>
                                </div>
                            <?php }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

