<?php

namespace App\Http\Livewire\Admin\Alert;

use App\Models\Alert;
use App\Models\Store;
use Livewire\Component;

class AlertStore extends Component
{
    public $store;
    public $title;
    public $body;
    public $store_id;
    public $alert_id;

    protected $listeners = ['alertStored'=> '$refresh'];
    public function mount()
    {
        $this->store_id = $this->store->id;
    }

    public function render()
    {
        $alerts = Alert::where('store_id', $this->store->id)->get();
        return view('livewire.admin.alert.alert-store', [
            'alerts' => $alerts,
        ]);
    }

    public function saveAlert()
    {

        $this->validate([
            'title' => 'required|max:255',  // Corrected the validation rule
            'body' => 'required|min:5',
        ]);

        Alert::create([
            'title' => $this->title,
            'body' => $this->body,
            'store_id' => $this->store_id,
        ]);
        $this->title = "";
        $this->body = "";

        // check number of alerts to block store
        $count = $this->store->alerts->count();
        if($count>=3){
            $this->store->update([
                'status'=>'blocked',
            ]);

            session()->flash('success', 'تم ارسال التحذير وحظر المستخدم بنجاح.');
            $this->emit('alertStored');

        }else{
            session()->flash('success', 'تم ارسال التحذير بنجاح.');
            $this->emit('alertStored');
        }

    }

    public function delete($alert_id)
    {

        $alert = Alert::findOrFail($alert_id);
        $alert->delete();
        session()->flash('success', 'تم حذف التحذير بنجاح.');
    }
    public function deleteAllAlerts()
    {
        $this->store->alerts()->delete();

        session()->flash('success', 'تم حذف جميع اخطارات المتجر بنجاح');
        $this->emit('alertStored');
    }
    public function unBlocked()
    {
        $store = Store::findOrFail($this->store_id);
        $store->update([
            'status'=>'approved',
        ]);
        session()->flash('success' , 'تم فك حظر المستخدم بنجاح✔');
        $this->emit('alertStored');

    }
}
