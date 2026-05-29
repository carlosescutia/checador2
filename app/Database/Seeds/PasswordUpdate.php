<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PasswordUpdate extends Seeder
{
    public function run()
    {
        $usuario_model = model('Usuario_model');

        $usuarios = $usuario_model->get_usuarios_todos();
        foreach ($usuarios as $usuarios_item) {
            echo 'Usuario: ' . $usuarios_item['nom_usuario'] . " -> ";
            echo substr($usuarios_item['password'], 0, 4) . " -> ";
            if ( substr($usuarios_item['password'], 0, 4) !== '$2y$' ) {
                echo 'Actualizando pwd' ;
                $data = array(
                    'id_usuario' => $usuarios_item['id_usuario'],
                    'password' => password_hash($usuarios_item['password'], PASSWORD_DEFAULT),
                );
                $usuario_model->save($data);
            } else {
                echo 'Pwd sin cambio' ;
            }
            echo "\n";
        }
    }
}
