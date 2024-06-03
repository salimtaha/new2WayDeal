<?php

namespace App\Http\Livewire\Admin\Withdrawal;

use App\Models\WithdrawalMethod;
use Livewire\Component;
use Livewire\WithPagination;

class MethodsTable extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    protected $listeners =['addMethod'=>'$refresh'];
    public function render()
    {
        $methods = WithdrawalMethod::paginate(2);
        return view('livewire.admin.withdrawal.methods-table' , compact('methods'));
    }

    public function delete($id)
    {
        $method = WithdrawalMethod::findOrFail($id);
        $method->delete();
        session()->flash('success' , 'fff');
    }
    public function disabled($id)
    {
        $method = WithdrawalMethod::findOrFail($id);
        $method->update(['status'=>'disabled']);
        session()->flash('success' , 'fff');
    }
    public function enable($id)
    {
        $method = WithdrawalMethod::findOrFail($id);
        $method->update(['status'=>'available']);
        session()->flash('success' , 'aVILABEL');
    }
}
