<div class="container">
  <h1>{{ $city->city }}, {{ $city->region }}, {{ $city->country }}</h1>

  <ul>
    <li><strong>Location ID:</strong> {{ $city->locId }}</li>
    <li><strong>Postal Code:</strong> {{ $city->postalCode }}</li>
    <li><strong>Latitude:</strong> {{ $city->latitude }}</li>
    <li><strong>Longitude:</strong> {{ $city->longitude }}</li>
    <li><strong>Metro Code:</strong> {{ $city->metroCode }}</li>
    <li><strong>Area Code:</strong> {{ $city->areaCode }}</li>
  </ul>

  <h2>Closest Cities</h2>

  @if($closestCities->count() > 0)
  <ul>
    @foreach($closestCities as $closestCity)
    <li>{{ $closestCity->city }}, {{ $closestCity->region }}, {{ $closestCity->country }}
    @endforeach
  </ul>
  @else
  <p>No closest cities found.</p>
  @endif