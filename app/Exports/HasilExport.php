<?php

namespace App\Exports;

use App\Models\Dosen;
use App\Models\Hasil;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;

class HasilExport implements FromQuery
{
    use Exportable;

    public function dosenId(int $id)
    {
        $this->dosen_id = $id;
        return $this;
    }

    public function query()
    {
        return Hasil::query()->where('dosen_id', $this->dosen_id);
    }
}
