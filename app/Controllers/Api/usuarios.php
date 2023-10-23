<?php

namespace App\Controllers\Api;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;

class usuarios extends ResourceController
{
    protected $modelName = 'App\Models\UserModel';
    protected $format    = 'json';

    use ResponseTrait;

    public function __construct()
	{
		helper('form');
	}


    public function index()
    {
        return $this->respond($this->model->findAll());
    }

    public function show($id = null)
    {
        $data = $this->model->getWhere(['id' => $id])->getResult();

        if($data){
            return $this->respond($data);
        }

        return $this->failNotFound('Nenhum dado encontrado com id '.$id);
    }

    public function update($id = null)
    {
        $data = $this->request->getJSON();

        if($this->model->update($id, $data)){
            $response = [
                'status'   => 200,
                'error'    => null,
                'messages' => [
                    'success' => 'Dados atualizados'
                    ]
                ];
                return $this->respond($response);
            };

            return $this->fail($this->model->errors());
    }

    public function delete($id = null)
    {
        $data = $this->model->find($id);

        if($data){
            $this->model->delete($id);
            $response = [
                'status'   => 200,
                'error'    => null,
                'messages' => [
                    'success' => 'Dados removidos'
                ]
            ];
            return $this->respondDeleted($response);
        }

        return $this->failNotFound('Nenhum dado encontrado com id '.$id);

    }
}
