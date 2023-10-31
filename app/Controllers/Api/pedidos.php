<?php

namespace App\Controllers\Api;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;

class pedidos extends ResourceController
{
    protected $modelName = 'App\Models\PedidoModel';
    protected $format    = 'json';

    use ResponseTrait;

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

    public function create()
    {
        $data = $this->request->getJSON();
        $data->Criado_em = date("Y-m-d H:i:s");
        
        $dia_da_semana = date('w', strtotime($data->Data));
        if($dia_da_semana == 0 or $dia_da_semana == 6){
            return $this->failValidationError('Não é possível fazer reservas para sábados e domingos.');
        }

        if(!$this->model->where('Usuario_id', $data->Usuario_id)->where('Data', $data->Data)->findAll()){
            if($this->model->insert($data)){
                $response = [
                    'status'   => 201,
                    'error'    => null,
                    'messages' => [
                        'success' => 'Dados salvos'
                    ]
                ];
                return $this->respondCreated($response);
            }
            return $this->fail($this->model->errors());
        }
        return $this->failResourceExists('Uma reserva com a mesma data já foi efetuada.');
        

    }

    public function update($id = null)
    {
        $data = $this->request->getJSON();

        if(property_exists($data, "Data")){
            $dia_da_semana = date('w', strtotime($data->Data));
            if($dia_da_semana == 0 or $dia_da_semana == 6){
                return $this->failValidationError('Não é permitido alterar a reserva para um sábado ou domingo.');
            }

            if(!$this->model->where('Usuario_id', $data->Usuario_id)->where('Data', $data->Data)->findAll()){
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
        }else{
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
        

        return $this->failResourceExists('Uma reserva com a mesma data já foi efetuada.');
        
    }

    public function payAll($userId){
        if($this->model->where("Usuario_id", $userId)->where('Pago', 0)->findAll()){
            if($this->model->where("Usuario_id", $userId)->set(['Pago' => 1])->update()){
                $response = [
                    'status'   => 200,
                    'error'    => null,
                    'messages' => [
                        'success' => 'Todos os pedidos foram transformados em reservas'
                        ]
                    ];
                    return $this->respond($response);
            }
            return $this->fail($this->model->errors());
        }
        return $this->respond('Não há pedidos efetuados.', 400);
        
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
