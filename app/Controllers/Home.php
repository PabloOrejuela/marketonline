<?php

namespace App\Controllers;

class Home extends BaseController{

    public function index(){

        $this->session->destroy();
        $data['mensaje'] = $this->request->getPostGet('message');

        $data['version'] = $this->CI_VERSION;
        $data['title']='Acceso al sistema:';
        $data['main_content']='home/login';
        return view('includes/template_login', $data);
    }

    public function validate_credentials(){
        $data = array(
            'user' => $this->request->getPostGet('user'),
            'password' => $this->request->getPostGet('password'),
        );

        $this->validation->setRuleGroup('login');
        
        if (!$this->validation->withRequest($this->request)->run()) {
            //Depuración
            //dd($validation->getErrors());
            return redirect()->back()->withInput()->with('errors', $this->validation->getErrors());
        }else{ 

            $usuario = $this->usuarioModel->_getUsuario($data);
            //echo '<pre>'.var_export($usuario, true).'</pre>';
            if (isset($usuario) && $usuario != NULL) {
                //valido el login y pongo el id en sesion
                //echo '<pre>'.var_export($usuario, true).'</pre>';
                $sessiondata = [
                    'logged_in' => 1,
                    'idusuario' => $usuario->idusuario,
                    'nombre' => $usuario->nombre,
                    'idrol' => $usuario->idrol,
                    'nombreRol' => $usuario->nombreRol,
                    'administracion' => $usuario->administracion,
                    'influencer' => $usuario->influencer,
                    'cliente' => $usuario->cliente,
                    'ventas' => $usuario->ventas,
                ];

                $user = [
                    'logged' => 1
                ];
                
                $this->usuarioModel->update($usuario->idusuario, $user);
                $this->session->set($sessiondata);

                return redirect()->to('inicio');
            }else{

                return redirect()->to('/');
            }
        }
        
    }

    public function inicio(){

        $data['idrol'] = $this->session->idrol;
        $data['idusuario'] = $this->session->idusuario;
        $data['logged_in'] = $this->session->logged_in;
        $data['nombre'] = $this->session->nombre;
        if ($data['logged_in'] == 1) {
            if ($this->session->idempresa) {
                return redirect()->to('/');
                
            }else{
                
                //echo '<pre>'.var_export($data['idusuario'], true).'</pre>';exit;
                $data['version'] = $this->CI_VERSION;
                $data['title']='Administracion - Mercado';
                $data['main_content']='home/inicio';
                return view('includes/template', $data);
            }
            
        }else{
            $this->logout();
        }
    }

    public function logout(){
        //destruyo la session  y salgo
        $idusuario = $this->session->idusuario;
        $user = [
            'logged' => 0
        ];
        
        $this->usuarioModel->update($idusuario, $user);
        $this->session->destroy();
        return redirect()->to('/');
    }
}
