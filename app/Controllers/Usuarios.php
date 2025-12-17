<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\usuariosmodel;
use App\Models\cajasmodel;
use App\Models\rolesmodel;

class Usuarios extends BaseController
{
    protected $usuarios, $cajas, $roles;
    protected $reglas, $reglaslogin;
    public function __construct()
    {
        $this->usuarios = new usuariosmodel();
        $this->cajas = new cajasmodel();
        $this->roles = new rolesmodel();
        helper(['form']);

        $this->reglas = [
            'usuario' => [
                'rules' => 'required|is_unique[usuarios.usuario]',
                'errors' => [
                    'required' => 'El campo {field} es obligatorio.',
                    'is_unique' => 'El {field} ya existe en la base de datos.',
                ],
            ],
            'password' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'El campo {field} es obligatorio.',
                ],
            ],
            'repassword' => [
                'rules' => 'required|matches[password]',
                'errors' => [
                    'required' => 'El campo {field} es obligatorio.',
                    'matches' => 'Las contraseñas no coinciden.',
                ],
            ],
            'nombre' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'El campo {field} es obligatorio.',
                ],
            ],
            'id_caja' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'El campo {field} es obligatorio.',
                ],
            ],
            'id_rol' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'El campo {field} es obligatorio.',
                ],
            ],
        ];
        $this->reglaslogin = [
            'usuario'  => ['rules' => 'required', 'errors' => ['required' => 'El usuario es obligatorio.']],
            'password' => ['rules' => 'required', 'errors' => ['required' => 'La contraseña es obligatoria.']],
        ];
    }
    public function index($activo = 1)
    {
        $usuarios = $this->usuarios->where('activo', $activo)->findAll();
        $data = ['titulo' => 'Usuarios', 'datos' => $usuarios];

        return
            view('header')
            . view('usuarios/usuarios', $data)
            . view('footer');
    }
    public function eliminados($activo = 0)
    {
        $usuarios = $this->usuarios->where('activo', $activo)->findAll();
        $data = ['titulo' => 'Unidades eliminadas', 'datos' => $usuarios];

        return
            view('header')
            . view('usuarios/eliminados', $data)
            . view('footer');
    }

    public function nuevo()
    {
        $cajas = $this->cajas->where('activo', 1)->findAll();
        $roles = $this->roles->where('activo', 1)->findAll();
        $data = ['titulo' => 'Agregar usuario', 'cajas' => $cajas, 'roles' => $roles];
        return
            view('header')
            . view('usuarios/nuevo', $data)
            . view('footer');
    }
    public function insertar()
    {
        if ($this->validate($this->reglas)) {

            $hash = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);

            $this->usuarios->save([
                'usuario'       => $this->request->getPost('usuario'),
                'password'     => $hash,
                'nombre' => $this->request->getPost('nombre'),
                'id_caja'      => $this->request->getPost('id_caja'),
                'id_rol'       => $this->request->getPost('id_rol'),
                'activo'       => 1,
            ]);
            return redirect()->to(base_url('usuarios'));
        } else {
            $cajas = $this->cajas->where('activo', 1)->findAll();
            $roles = $this->roles->where('activo', 1)->findAll();
            $data = ['titulo' => 'Agregar usuario', 'cajas' => $cajas, 'roles' => $roles, 'validation' => $this->validator];
            return view('header')
                . view('usuarios/nuevo', $data)
                . view('footer');
        }
    }
    public function editar($id, $valid = null)
    {
        $unidad = $this->usuarios->where('id', $id)->first();
        if ($valid != null) {
            $data = ['titulo' => 'Editar unidad', 'datos' => $unidad, 'validation' => $valid];
        } else {
            $data = ['titulo' => 'Editar unidad', 'datos' => $unidad];
        }
        return
            view('header')
            . view('usuarios/editar', $data)
            . view('footer');
    }
    public function actualizar()
    {
        if ($this->validate($this->reglas)) {
            $this->usuarios->update($this->request->getPost('id'), [
                'nombre' => $this->request->getPost('nombre'),
                'nombre_corto' => $this->request->getPost('nombre_corto'),
            ]);
            return redirect()->to(base_url('usuarios'));
        } else {
            return $this->editar($this->request->getPost('id'), $this->validator);
        }
    }
    public function eliminar($id)
    {
        $this->usuarios->update($id, ['activo' => 0]);
        return redirect()->to(site_url('usuarios'));
    }
    public function reingresar($id)
    {
        $this->usuarios->update($id, ['activo' => 1]);
        return redirect()->to(site_url('usuarios'));
    }
    public function login()
    {
        return view('login');
    }
    public function valida()
    {
        if (! $this->validate($this->reglaslogin)) {
            return redirect()->to(site_url('login'))->withInput();
        }

        $usuario  = $this->request->getPost('usuario');
        $password = $this->request->getPost('password');

        $datosusuario = $this->usuarios->where('usuario', $usuario)->first();

        if (! $datosusuario) {
            session()->setFlashdata('error', 'Usuario no encontrado.');
            return redirect()->to(site_url('login'));
        }

        if (! password_verify($password, $datosusuario['password'])) {
            session()->setFlashdata('error', 'Contraseña incorrecta.');
            return redirect()->to(site_url('login'));
        }

        session()->set([
            'id_usuario' => $datosusuario['id'],
            'usuario'    => $datosusuario['usuario'],
            'nombre'     => $datosusuario['nombre'],
            'id_caja'    => $datosusuario['id_caja'],
            'id_rol'     => $datosusuario['id_rol'],
            'logged_in'  => true,
        ]);

        return redirect()->to(site_url('unidades'));
    }
    public function tables()
    {
        return view('unidades'); // o la vista real
    }
    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to(site_url('login'));
    }
}
