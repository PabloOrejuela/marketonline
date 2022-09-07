<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Usuarios extends BaseController {

    public function frm_registrar_influencer(){
        $data['idrol'] = $this->session->idrol;
        $data['idusuario'] = $this->session->idusuario;
        $data['logged_in'] = $this->session->logged_in;
        $data['nombre'] = $this->session->nombre;
        if ($data['logged_in'] == 1) {
            if ($this->session->idempresa) {
                return redirect()->to('/home');
                
            }else{
                
                //echo '<pre>'.var_export($data['idempresa'], true).'</pre>';
                $data['rol'] = 2; //Rol de influencer
                $data['categorias'] = $this->categoriaModel->findAll();

                // echo '<pre>'.var_export($data['categorias'], true).'</pre>';exit;
                $data['version'] = $this->CI_VERSION;
                $data['title']='Administracion - Registrar influencer';
                $data['main_content']='usuarios/frm_registrar_influencer';
                return view('includes/template', $data);
            }
            
        }else{
            $this->logout();
        }
    }

    public function registrar_influencer(){
        $data['idrol'] = $this->session->idrol;
        $data['idusuario'] = $this->session->idusuario;
        $data['logged_in'] = $this->session->logged_in;
        $data['nombre'] = $this->session->nombre;
        if ($data['logged_in'] == 1) {
            //Validar
            $data = array(
                'nombre' => $this->request->getPostGet('nombre'),
                'cedula' => $this->request->getPostGet('cedula'),
                'email' => $this->request->getPostGet('email'),
                'telefono' => $this->request->getPostGet('telefono'),
                'pais' => $this->request->getPostGet('pais'),
                'direccion' => $this->request->getPostGet('direccion'),
                'descripcion' => $this->request->getPostGet('descripcion'),
                'image' => $this->request->getFile('image')
            );

    echo '<pre>'.var_export($data, true).'</pre>';
            $this->validation->setRuleGroup('registro_influencer');
            
            if (!$this->validation->withRequest($this->request)->run()) {
                //Depuración
                //dd($validation->getErrors());
                
                return redirect()->back()->withInput()->with('errors', $this->validation->getErrors());
            }else{ 
                

                //El Id debe venir de inserción del nuevo usuario
                $id = 2;
                //$this->_upload($data['image'], $id);
            }
            
        }else{
            $this->logout();
        }
    }

    private function _upload($imageFile, $id){
        //echo '<pre>'.var_export($imageFile, true).'</pre>';
        if ($imageFile->isValid() && !$imageFile->hasMoved()) {
            //validaciones de la imagen
            $validated = $this->validate([
                'image' => [
                    'uploaded[image]',
                    'mime_in[image, image/png,image/jpg,image/jpeg,image/gif]',
                    'max_size[image, 1500000]'
                ]
            ]);

            if ($validated) {
                $newImageName = $imageFile->getRandomName();
                //echo '<pre>'.var_export($newImageName, true).'</pre>';
                $imageFile->move(WRITEPATH.'uploads/avatars/'.$id, $newImageName);
                return true;
            }else{
                
                echo '<pre>'.var_export($this->validator->listErrors(), true).'</pre>';
                return false;
            }

            
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
