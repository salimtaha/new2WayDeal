<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;


class SearchHeader extends Component
{
    public $search;

    public function render()
    {
        $this->redirectTo();
        return view('livewire.admin.search-header');
    }

    public function redirectTo()
    {

        if ($this->search == "الاقسام") {
            return redirect()->route('admin.categories.index');
        }
        if ($this->search == "المستخدمين") {
            return redirect()->route('admin.users.index');
        }
        if ($this->search == "الاعدادات") {
            return redirect()->route('admin.settings.index');
        }
        if ($this->search == "المتاجر") {
            return redirect()->route('admin.stores.index');
        }
        if ($this->search == "التواصل معنا") {
            return redirect()->route('admin.contacts.index');
        }
        if ($this->search == "الملف الشخصي") {
            return redirect()->route('admin.profile.update');
        }
        if ($this->search == "المستخدمين") {
            return redirect()->route('admin.users.index');
        }
        if ($this->search == "مسئولين السحب") {
            return redirect()->route('admin.mediators.index');
        }

    }
}
