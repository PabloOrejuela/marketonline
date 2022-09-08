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
                'password' => md5($this->request->getPostGet('cedula')),
                'email' => $this->request->getPostGet('email'),
                'telefono' => $this->request->getPostGet('telefono'),
                'pais' => $this->request->getPostGet('pais'),
                'direccion' => $this->request->getPostGet('direccion'),
                'descripcion' => $this->request->getPostGet('descripcion'),
                'image' => $this->request->getFile('image'),
                'idrol' => $this->request->getPostGet('idrol'),
            );

    //echo '<pre>'.var_export($data, true).'</pre>';
            $this->validation->setRuleGroup('registro_influencer');
            
            if (!$this->validation->withRequest($this->request)->run()) {
                //Depuración
                //dd($validation->getErrors());
                
                return redirect()->back()->withInput()->with('errors', $this->validation->getErrors());
            }else{ 
                
                $idusuario = $this->usuarioModel->_getUsuarioId($data['cedula']);
                //echo '<pre>'.var_export($idusuario, true).'</pre>';exit;
                if ($idusuario == 0) {
                    //INSERT
                    $this->usuarioModel->save($data);
                    $idusuario = $this->db->insertID();

                    $this->_upload($data['image'], $idusuario);
                }
                return redirect()->to('/lista_influencers');
            }
            
        }else{
            $this->logout();
        }
    }

    private function _upload($imageFile, $idusuario){
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

                $data = array(
                    'image' => $newImageName,
                );

                //echo '<pre>'.var_export($newImageName, true).'</pre>';
                $imageFile->move(ROOTPATH.'public/uploads/avatars/'.$idusuario, $newImageName);

                //Hago el resize
                $path = 'public/uploads/avatars/'.$idusuario.'/'.$newImageName;

                $this->image->withFile($path)
                            ->resize(800, 400, true, 'height')
                            ->save($path);

                $this->usuarioModel->update($idusuario, $data);
                return true;
            }else{
                
                echo '<pre>'.var_export($this->validator->listErrors(), true).'</pre>';
                return false;
            }

            
        }
    }

    public function lista_influencers(){
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
                $data['influencers'] = $this->usuarioModel->where('idrol', 2)->findAll();
                
                //echo '<pre>'.var_export($data['influencers'][0]->image, true).'</pre>';exit;
                $data['version'] = $this->CI_VERSION;
                $data['title']='Influencers';
                $data['main_content']='usuarios/lista_influencers';
                return view('includes/template', $data);
            }
            
        }else{
            $this->logout();
        }
    }

    public function frm_editar_influencer(){
        $data['idrol'] = $this->session->idrol;
        $data['idusuario'] = $this->session->idusuario;
        $data['logged_in'] = $this->session->logged_in;
        $data['nombre'] = $this->session->nombre;
        if ($data['logged_in'] == 1) {
            if ($this->session->idempresa) {
                return redirect()->to('/home');
                
            }else{
                
                //echo '<pre>'.var_export($data['idempresa'], true).'</pre>';
                
                $data['categorias'] = $this->categoriaModel->findAll();
                $data['influencer'] = $this->usuarioModel->find($data['idusuario']);

                echo '<pre>'.var_export($this->session->idusuario, true).'</pre>';exit;
                $data['version'] = $this->CI_VERSION;
                $data['title']='Administracion - Editar datos del Influencer';
                $data['main_content']='usuarios/frm_editar_influencer';
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
