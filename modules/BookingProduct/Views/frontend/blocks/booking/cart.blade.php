@php $total_amount = 0; @endphp
@foreach ($result as $val)
    <?php
    $image_url = get_file_url($val['image_id'], 'full');
    $image_details = get_file_details($val['image_id'], '#');
    $total_amount += $val['qty'] * $val['price'];
    ?>
    <div class="item">
        <img src="{{ $image_url }}" title="{{ isset($image_details['title']) ? $image_details['title'] : '#' }}" alt="{{ isset($image_details['alt']) ? $image_details['alt'] : '#' }}">
        <span>{{ $val['title'] }}</span>
        <div class="counter-container">
            <button type="button" class="button decrement" decre-dataid="" onclick="decrement_cart('{{ $val['id'] }}','{{ $val['price'] }}')">-</button>
            <input type="number" class="count-input" id="counter_{{ $val['id'] }}" value="{{ $val['qty'] }}" min="0" readonly>
            <button type="button" class="button increment" onclick="increment_cart('{{ $val['id'] }}','{{ $val['price'] }}')">+</button>
        </div>
        <div class="item-price" id="cart_prod_prive_show_{{ $val['id'] }}">{{ priceConvert($val['qty'] * $val['price']) }} €</div>
        {{-- 81,23 € --}}
    </div>
@endforeach
<input type="hidden" id="cart_total_amount" value="{{ $total_amount }}">

