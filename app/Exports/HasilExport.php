<?php

namespace App\Exports;

use App\Models\Dosen;
use App\Models\Hasil;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;

class HasilExport implements FromQuery
{
    use Exportable;

    public function mkId(int $id)
    {
        $this->dosen_id = $id;
        return $this;
    }

    public function query()
    {
        return Hasil::query()->where('matakuliah_id', $this->dosen_id);
    }
}
