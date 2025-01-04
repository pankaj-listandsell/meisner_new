@if(count($getProducts))
@foreach ($getProducts as $val)
<div class="image-box">
    <div class="img-text">
      <?php
          $image_url = get_file_url($val->image_id, 'full');
          $image_details = get_file_details($val->image_id, '#');
      ?>
      <img src="{{$image_url != '' ? $image_url : url('uploads/0000/1/2024/12/26/thumbmail-150.png')  }}" title="{{ isset($image_details['title']) ? $image_details['title'] : "#" }}" alt="{{ isset($image_details['alt']) ? $image_details['alt'] : "#" }}">
      <p>{{$val->title}}</p>
      <span>{!!$val->content!!}</span>
    </div>
    <div class="item-counter">
      <div class="counter-container">
        <button type="button" class="button decrement" onclick="decrement('{{$val->id}}')">-</button>
        <input type="number" class="count-input qty-{{$val->id}}" id="counter" value="1" min="0" readonly>
        <button type="button" class="button increment" onclick="increment('{{$val->id}}')">+</button>
      </div>
      <div class="item-btn">
        <a href="javascript:void(0)" onclick="addtocart('{{$val->id}}','{{$val->price}}')">Hinzufügen</a>
      </div>
    </div>
  </div>
  @endforeach
  @else
  <p>Keine Daten gefunden!</p>
  @endif
  <script>
    // document.querySelectorAll('.counter-container').forEach(container => {
    //     const input = container.querySelector('.count-input');

    //     container.querySelector('.increment').addEventListener('click', (event) => {
    //         event.preventDefault(); // Prevent default action
    //         input.value = parseInt(input.value) + 1;
    //     });

    //     container.querySelector('.decrement').addEventListener('click', (event) => {
    //         event.preventDefault(); // Prevent default action
    //         if (parseInt(input.value) > 0) {
    //         input.value = parseInt(input.value) - 1;
    //         }
    //     });
    //     });
  </script>
