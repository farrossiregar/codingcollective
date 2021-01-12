<?php

namespace App\Http\Livewire\Project;

use Livewire\Component;
use App\Models\Project;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $keyword;
    public function render()
    {
        $data = Project::select('projects.*')->orderBy('id','DESC');

        return view('livewire.project.index')
                    ->with(['data'=>$data->paginate(100)]);
    }
}
