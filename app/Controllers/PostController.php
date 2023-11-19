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

    // handle fetch all posts ajax request
    public function fetch() {
        $postModel = new \App\Models\PostModel();
        $posts = $postModel->findAll();
        $data = '';

        if ($posts) {
            foreach ($posts as $post) {
                $data .= '<div class="col-md-4">
                    <div class="card shadow-sm">
                        <a href="#" id="'.$post['id'].'" class="post_detail_btn"><img src="uploads/avatar/'.$post['image'].'" class="img-fluid card-img-top"></a>
                        <div class="card-body">
                            <div class="d-flex justify-content-between aligh-items-center">
                                <div class="card-title fs-5 fw-bold">'.$post['title'].'</div>
                                <div class="badge bg-dark">'.$post['category'].'</div>
                            </div>
                            <p>
                            '.substr($post['body'], 0, 80).'...
                            </p>
                        </div>
                        <div class="card-footer d-flex justify-content-between align-items-center">
                            <div class="fst-italic">'.date('d F Y', strtotime($post['created_at'])).'</div>
                            <div>
                                <a href="#" id="'.$post['id'].'" class="btn btn-success btn-sm post_edit_btn">Edit</a>
                                <a href="#" id="'.$post['id'].'" class="btn btn-danger btn-sm post_delete_btn">Delete</a>
                            </div>
                        </div>
                    </div>
                </div>';
            }
            return $this->response->setJSON([
                'error' => false,
                'message' => $data
            ]);
        } else {
            return $this->response->setJSON([
                'error' => true,
                'message' => '<div class="text-secondary text-center fw-bold my-5">No post found in the database!</div>'
            ]);
        }
    }
}