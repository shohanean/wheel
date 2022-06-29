<?php

namespace App\Exports;

use App\Models\Wheel;
use Maatwebsite\Excel\Concerns\FromCollection;

class WheelsExport implements FromCollection
{
    protected $this_start = 0;
    function __construct($start)
    {
        $this->this_start = $start;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Wheel::skip($this->this_start-1)->take(200)->get();
    }
}
