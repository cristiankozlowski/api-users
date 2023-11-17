<?php

namespace App\Services;

use Exception;
use App\Repositories\Contracts\UserRepositoryInterface;

class UserService
{
    private $repository;

    public function __construct(UserRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function getAll(int $per_page, object $request)
    {
        return $this->repository->getAll($per_page);
    }

    public function createNewUser(array $request)
    {
        return $this->repository->create($request);
    }

    public function show(string $uuid)
    {
        return $this->repository->show($uuid);
    }

    // public function updateUser($request, $uuid)
    // {
    //     $user = $this->show($uuid);
    //     if($this->isMaster()) {
    //         $company = $this->getCompanyByUuid($request->company_identify);
    //         $cooperative = $this->getCooperativeByUuid($request->cooperative_identify);
    //     } else {
    //         $company = Company::where('id', auth()->user()->company_id)->first();
    //         $cooperative = Cooperative::where('id', auth()->user()->cooperative_id)->first();
    //     }

    //     if(!$company)
    //         return response()->json(['mensagem' => 'empresa não encontrada'], 404);

    //     if(!$cooperative)
    //         return response()->json(['mensagem' => 'cooperativa não encontrada'], 404);

    //     /**
    //      * Armazena os dados do usuário em um array
    //      */
    //     $data = [
    //         'name'           => $request->name,
    //         'email'          => $request->email,
    //         'password'       => (!empty($request->password) ? Hash::make($request->password) : $user->password),
    //         'cellphone'      => $request->cellphone,
    //         'cooperative_id' => $cooperative->id,
    //         'company_id'     => $company->id
    //     ];

    //     $response = $this->repository->update($user, $data);

    //     if(!$response)
    //         return response()->json(['mensagem' => 'O servidor encontrou um erro e não pode atualizar o usuário'], 500);

    //     $role = $this->repository->syncRole($user, $request->role);

    //     if(!$role)
    //         return response()->json(['mensagem' => 'O servidor encontrou um erro e não pode atualizar a regra'], 500);

    //     return response()->json($this->show($uuid), 200);
    // }

    // public function destroyUser($user)
    // {
    //     return $this->repository->destroy($user);
    // }

    // public function getAllTrashed(int $per_page, object $request)
    // {
    //     $filtros = null;
    //     /**
    //      * Se o usuario for diferente de master filtra por cooperativa
    //      */
    //     if(!($this->isMaster())) {
    //         $cooperative_id = auth()->user()->cooperative_id;
    //         $this->repository->filtro(['cooperative_id', '=', $cooperative_id]);
    //     }

    //     /**
    //      * Carrega os filtros
    //      */
    //     if($request->has('filtros')) {
    //         $filtros .= $request->get('filtros');
    //     }

    //     /**
    //      * Monta o filtro e passa pro repository
    //      */
    //     if(isset($filtros)) {
    //         $response = $this->mountFilter($filtros);

    //         if($response->status() == 500) {
    //             return $response;
    //         }
    //     }

    //     /**
    //      * Verifica se foi passado paginação
    //      */
    //     if($request->per_page) {
    //         $per_page = $request->per_page;
    //     }

    //     try {
    //         $users = $this->repository->getAllTrashed($per_page);

    //         return response()->json($users, 200);
    //     } catch(\Exception $e) {

    //         return response()->json(['mensagem' => $e->getMessage()], 500);
    //     }
    // }

    // public function restoreUser($user)
    // {
    //     return $this->repository->restore($user);
    // }

    // public function uploadProfile($image, $uuid)
    // {
    //     $user = $this->getUserByUuid($uuid);

    //     if(!$user)
    //         return response()->json(['mensagem' => 'usuário não encontrado'], 404);

    //     $path = $image->store("user/{$user->id}/profile", 'public');

    //     $response = $this->repository->uploadProfile($user, $path);

    //     if(!$response)
    //         return response()->json(['mensagem' => 'O servidor encontrou um erro e não pode atualizar a foto de perfil do usuário'], 500);

    //     return response()->json($this->getUserByUuid($uuid), 200);
    // }

    // public function getUserByUuidTrashed($uuid){
    //     return $this->repository->getTrashed($uuid);
    // }

    // public function getUserByUuid($uuid){
    //     return $this->repository->show($uuid);
    // }

    // public function getCooperativeByUuid($uuid){
    //     return $this->repositoryCooperative->show($uuid);
    // }

    // public function getCompanyByUuid($uuid){
    //     return $this->repositoryCompany->show($uuid);
    // }
}
