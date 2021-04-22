<?php


namespace App\Http\Repository;


use App\Models\Unite;

class UniteRepository
{
    public function getAll()
    {
        return Unite::where('statut', 'ACTIVE')->get();
    }

    public function getOne($uniteId)
    {
        return Unite::find($uniteId);
    }

    public function create($datas)
    {
        $uniteObj = new Unite();
        return $this->store($uniteObj, $datas);
    }

    public function update($datas)
    {
        $uniteObj = Unite::findOrFail($datas['unite_id']);
        return $this->store($uniteObj, $datas);
    }

    private function store($uniteObj, $datas)
    {
        $uniteObj->libelle = $datas['libelle'];
        $uniteObj->code = $datas['code'];
        return $uniteObj->save() ? $uniteObj : null;
    }

    public function delete($uniteId)
    {
        $uniteObj = Unite::findOrFail($uniteId);
        $uniteObj->statut = "SUPPRIMER";
        return $uniteObj->save() ? $uniteObj : null;
    }
}
