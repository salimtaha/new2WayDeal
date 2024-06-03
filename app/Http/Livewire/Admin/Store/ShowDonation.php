<?php

namespace App\Http\Livewire\Admin\Store;

use Livewire\Component;
use Livewire\WithPagination;

class ShowDonation extends Component
{
    use WithPagination;
    public $store;
    public $searchTerm = '';
    public $message;
    protected $paginationTheme = 'bootstrap';

    public function mount($store)
    {
        $this->store = $store;
    }



    public function render()
    {
        $donations = $this->store->donations()
            ->where(function($query) {
                $query->WhereHas('charity', function($query) {
                          $query->where('name', 'like', '%' . $this->searchTerm . '%');
                      });
            })
            ->latest()->paginate(5);

        return view('livewire.admin.store.show-donation', [
            'donations' => $donations,
        ]);
    }

}
