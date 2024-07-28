<?php

namespace App\Repository\Json;
use App\Interfaces\AccessManagement as IAccess;
use Illuminate\Support\Facades\Storage;

class AccessManagement implements IAccess {
    public function findAll()
    {
        $file = Storage::get('access.json');
        if (!empty($file)) {
            $dataOneLevel = json_decode($file, true);
        } else {
            $dataOneLevel = [];
        }

        $keyToExtract = ['id', 'menu_name', 'menu_path'];

        $data = []; 
        foreach ($dataOneLevel as $key => $value) {
            $data[] = array_intersect_key($value, array_flip($keyToExtract));
        }


        return $data;
    }

    public function getOne($id)
    {
        $file = Storage::get('access.json');
        if (!empty($file)) {
            $dataOneLevel = json_decode($file, true);
        } else {
            $dataOneLevel = [];
        }
        foreach ($dataOneLevel as $value) {
            if($value['id'] == $id) {
                return $value;
            }
        }
        return [];
    }

    public function create($data)
    {
        $file = Storage::get('access.json');
        if (!empty($file)) {
            $dataOneLevel = json_decode($file, true);
        } else {
            $dataOneLevel = [];
        }
        $ids = array_map(function($data) { return $data['id']; }, $dataOneLevel);
        $maxId = max($ids);
        $nextId = $maxId + 1;
        $newData = $data;
        $newData['id'] = $nextId;
        array_push($dataOneLevel, $newData);
        Storage::put('access.json', json_encode($dataOneLevel));
    }

    public function update($accessData, $id)
    {
        $file = Storage::get('access.json');
        if (!empty($file)) {
            $dataOneLevel = json_decode($file, true);
        } else {
            $dataOneLevel = [];
        }
        foreach ($dataOneLevel as $value) {
            if ($value['id'] == $id) {
                foreach ($accessData as $key => $access) {
                    $value[$key] = $access;
                }
            }
        }
        Storage::put('access.json', json_encode($dataOneLevel));
    }

    public function delete($id)
    {
        $file = Storage::get('access.json');
        if (!empty($file)) {
            $dataOneLevel = json_decode($file, true);
        } else {
            $dataOneLevel = [];
        }
        foreach ($dataOneLevel as $i => $value) {
            if ($value['id'] == $id) {
                array_splice($dataOneLevel, $i, 1);
                break;
            }
        }
        Storage::put('access.json', json_encode($dataOneLevel));
    }
}