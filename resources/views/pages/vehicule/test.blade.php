

<h1>
    test Image
</h1>
@foreach ($cars as $car)
    <img src="images/car/{{ $car->image}}" />
  {{  $car->id}}
@endforeach
