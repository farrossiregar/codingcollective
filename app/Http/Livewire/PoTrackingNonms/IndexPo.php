<?php

namespace App\Http\Livewire\PoTrackingNonms;

use Livewire\Component;
use App\Models\PoTrackingNonmsPo;

class IndexPo extends Component
{
    public $keyword,$is_service_manager,$is_e2e,$is_finance;
    public function render()
    {
        $data = PoTrackingNonmsPo::orderBy('id','DESC');

        return view('livewire.po-tracking-nonms.index-po')->with(['data'=>$data->paginate(100)]);
    }

    public function mount()
    {
        $this->is_service_manager = check_access('is-service-manager');
        $this->is_e2e = check_access('is-e2e');
        $this->is_finance = check_access('is-finance');
    }
}
