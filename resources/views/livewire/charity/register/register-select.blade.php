<div class="mb-3">
    <label for="governorate" class="form-label">المحافظه</label>
    <select wire:model.live="selectedGovernorate" class="form-select" id="governorate" name="governorate_id">
        <option value="" selected>اختر المحافظة</option>
        @foreach ($governorates as $governorate)
            <option value="{{ $governorate->id }}">{{ $governorate->name }}</option>
        @endforeach
    </select>


    @if (!is_null($cities))
    <label for="governorate" class="form-label" >المدينه</label>
    <select name="city_id"  class="form-select" >
        <option value="" selected>اختر المدينه</option>
        @foreach ($cities as $city)
            <option value="{{ $city->id }}">{{ $city->name }}</option>
        @endforeach
    </select>
    @endif

</div>

