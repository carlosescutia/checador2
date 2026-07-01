<div class="ui stackable grid container">
    <div class="row">
        <div class="twelve wide column">
            <h1 class="ui header">Catálogos</h1>
            <div class="row">
                <div class="twelve wide column">
                    <h2 class="ui header">Aplicación</h2>
                    <div class="ui stackable grid container">
                        <?php
                            $permisos_requeridos = array(
                                'empleado.can_edit',
                            );
                        ?>
                        <?php if (has_permission_or($permisos_requeridos, $permisos_usuario)): ?>
                            <div class="four wide column">
                                <?php include "empleado/boton.php" ?>
                            </div>
                        <?php endif ?>

                        <?php
                            $permisos_requeridos = array(
                                'recurso.can_edit',
                            );
                        ?>
                        <?php if (has_permission_or($permisos_requeridos, $permisos_usuario)): ?>
                            <div class="four wide column">
                                <?php include "recurso/boton.php" ?>
                            </div>
                        <?php endif ?>

                        <?php
                            $permisos_requeridos = array(
                                'parametro_sistema.can_edit',
                            );
                        ?>
                        <?php if (has_permission_or($permisos_requeridos, $permisos_usuario)): ?>
                            <div class="five wide column">
                                <?php include "parametro_sistema/boton.php" ?>
                            </div>
                        <?php endif ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="four wide column">
            <div class="ui secondary segment">
                <h2 class="ui header">Sistema</h2>
                <div class="ui stackable grid container">
                    <?php
                        $permisos_requeridos = array(
                            'usuario.can_edit',
                        );
                    ?>
                    <?php if (has_permission_or($permisos_requeridos, $permisos_usuario)): ?>
                        <div class="sixteen wide column">
                            <?php include "usuario/boton.php" ?>
                        </div>
                    <?php endif ?>

                    <?php
                        $permisos_requeridos = array(
                            'rol.can_view',
                        );
                    ?>
                    <?php if (has_permission_or($permisos_requeridos, $permisos_usuario)): ?>
                        <div class="sixteen wide column">
                            <?php include "rol/boton.php" ?>
                        </div>
                    <?php endif ?>

                    <?php
                        $permisos_requeridos = array(
                            'opcion_sistema.can_edit',
                        );
                    ?>
                    <?php if (has_permission_or($permisos_requeridos, $permisos_usuario)): ?>
                        <div class="sixteen wide column">
                            <?php include "opcion_sistema/boton.php" ?>
                        </div>
                    <?php endif ?>

                    <?php
                        $permisos_requeridos = array(
                            'acceso_sistema.can_edit',
                        );
                    ?>
                    <?php if (has_permission_or($permisos_requeridos, $permisos_usuario)): ?>
                        <div class="sixteen wide column">
                            <?php include "acceso_sistema/boton.php" ?>
                        </div>
                    <?php endif ?>
                </div>
            </div>
        </div>
    </div>
</div>
