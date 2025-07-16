{{-- resources/views/customer/partials/_filter-sidebar.blade.php --}}
<form action="{{ route('customer.menu.index') }}" method="GET" id="filter-form">
    <div class="bg-primary text-white p-4 rounded-3">
        <h5 class="fw-bold mb-3 border-bottom pb-2">Filter</h5>
        <p class="fw-bold">Kategori</p>

        @php
            $categoryOptions = [
                'main-course' => 'Main Course',
                'add-on' => 'Add On',
                'dessert' => 'Dessert'
            ];
        @endphp

        @foreach($categoryOptions as $value => $label)
            <div class="form-check mb-2">
                <input class="form-check-input filter-input" type="checkbox" name="categories[]" value="{{ $value }}" id="cat-{{ $value }}" {{ in_array($value, request('categories', [])) ? 'checked' : '' }}>
                <label class="form-check-label" for="cat-{{ $value }}">{{ $label }}</label>
            </div>
        @endforeach

        <hr class="text-white">

        <p class="fw-bold">Urutan Harga</p>
        <div class="form-check mb-2">
            <input class="form-check-input filter-input" type="radio" name="sort" value="price_asc" id="lowToHigh" {{ request('sort') == 'price_asc' ? 'checked' : '' }}>
            <label class="form-check-label" for="lowToHigh">Terendah - Tertinggi</label>
        </div>
        <div class="form-check">
            <input class="form-check-input filter-input" type="radio" name="sort" value="price_desc" id="highToLow" {{ request('sort') == 'price_desc' ? 'checked' : '' }}>
            <label class="form-check-label" for="highToLow">Tertinggi - Terendah</label>
        </div>
    </div>
</form>