
<div class="card">
    <div class="card-header">
        <h4>إضافة طريقة دفع جديدة</h4>
    </div>
    <div class="card-body">
        <form wire:submit.prevent="addMethod">
            @csrf
            <div class="form-group">
                <label for="newPaymentMethod">اسم الطريقة</label>
                <input type="text" class="form-control"  id="newPaymentMethod" placeholder="اسم الطريقة"  multiple="multiple" wire:model.prevent="method"> <br>
                @error('method')
                    <div class="alert alert-danger">
                        {{ $message }}
                    </div>
                @enderror
                <input type="text" wire:model.prevent="description" class="form-control" id="newPaymentMethod" placeholder="الملاحظه ">
                @error('description')
                <div class="alert alert-danger">
                    {{ $message }}
                </div>
            @enderror
            </div><br><br>
            <button type="submit" class="btn btn-primary">إضافة</button>
        </form>
    </div>
</div>
