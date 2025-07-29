<?php

namespace App\Http\Services;

use App\Http\Repositories\ObjekRepository;

class ObjekService
{
    protected $objekRepository;

    public function __construct(ObjekRepository $objekRepository)
    {
        $this->objekRepository = $objekRepository;
    }

    public function getAll()
    {
        return $this->objekRepository->getAll();
    }

    public function simpanPostData($request)
    {
        $data = $request->validated();
        return $this->objekRepository->simpan($data);
    }

    public function ubahGetData($request)
    {
        return $this->objekRepository->getDataById($request->id);
    }

    public function perbaruiPostData($request)
    {
        $data = $request->validated();
        return [true, $this->objekRepository->perbarui($request->id, $data)];
    }

    public function hapusPostData($request)
    {
        return $this->objekRepository->hapus($request);
    }

    public function import($request)
    {
        return $this->objekRepository->import($request);
    }
}