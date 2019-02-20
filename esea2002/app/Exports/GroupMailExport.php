<?php 
namespace App\Exports;

use App\Models\MGroupEmail;
use Illuminate\Contracts\View\View;
use App\Models\MGroupEmailUser;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;

use Maatwebsite\Excel\Concerns\Exportable;

class GroupMailExport implements FromView
{

    public function __construct(int $id)
    {
        $this->id = $id;
    }
    
    public function view():View{
        //export with view
        $list =MGroupEmailUser::where('group_id', $this->id)->get();
        return view('theme.backend.section.excel.groupMail')->with(['list' => $list]);
        // return view('', ['list' => MGroupEmailUser::where('group_id', $this->id)]);
        //none view
        // return MGroupEmailUser::where('group_id', $this->id);
    }
}