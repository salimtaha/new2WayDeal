<?php

namespace App\Http\Livewire\Admin\Store;

use Livewire\Component;
use Livewire\WithPagination;

class ShowProduct extends Component
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
    public function deleteProduct($productId)
    {
        $product = $this->store->products()->find($productId);

        if ($product) {
            $product->delete();
            session()->flash('message', 'تم حذف المناج بنجاح.');
        } else {
            session()->flash('error', 'لا يمكن حذف المنتج.');
        }
        $this->resetPage();
    }


    public function render()
    {
        $products = $this->store->products()
            ->where(function($query) {
                $query->where('name', 'like', '%' . $this->searchTerm . '%')
                      ->orWhereHas('category', function($query) {
                          $query->where('name', 'like', '%' . $this->searchTerm . '%');
                      });
            })
            ->latest()->paginate(5);

        return view('livewire.admin.store.show-product', [
            'products' => $products,
        ]);
    }
}
