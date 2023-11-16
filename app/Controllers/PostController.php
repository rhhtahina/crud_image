<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class PostController extends BaseController
{
    public function index()
    {
        return view('index');
    }

    // handle add new post ajax request

    public function add() {
        $file = $this->request->getFile('file');
        $fileName = $file->getRandomName();

        $data = [
            'title' => $this->request->getPost('title'),
            'category' => $this->request->getPost('category'),
            'body' => $this->request->getPost('body'),
            'image' => $fileName,
            'created_at' => date('Y-m-d H:i:s')
        ];

        $validation = \config\Services::validation();
        $validation->setRules([
            'image' => 'uploaded[file]|max_size[file,1024]|is_image[file]|mime_in[file,image/jpg,image/jpeg,image/png]',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return $this->response->setJSON([
                'error' => true,
                'message' => $validation->getErrors()
            ]);
        } else {
            $file->move('uploads/avatar', $fileName);
            $postModel = new \App\Models\PostModel();
            $postModel->save($data);
            return $this->response->setJSON([
                'error' => false,
                'message' => 'Successfully added new post!'
            ]);
        }
    }
}