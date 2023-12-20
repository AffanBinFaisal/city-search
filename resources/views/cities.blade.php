<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test</title>
</head>

<body>
    <h1>City Selection</h1>
    <input id="search" type="text" oninput="filter(event)" />
    <ul id="city-list">
        @foreach($cities as $city)
        <li><a href="test/{{ $city }}">{{ $city }}</a></li>
        @endforeach
    </ul>

    <script>
        var cities;
        document.addEventListener('DOMContentLoaded', function() {
            cities = <?php echo json_encode($cities); ?>;
            console.log(cities);
        });
        function filter(event) {
            const input = event.target.value.toLowerCase();
            const filteredCities = cities.filter(city => city.toLowerCase().startsWith(input));

            const cityList = document.getElementById('city-list');
            cityList.innerHTML = "";

            filteredCities.forEach(city => {
                const li = document.createElement('li');
                const a = document.createElement('a');
                a.href = "test/" + city;
                a.textContent = city;
                li.appendChild(a);
                cityList.appendChild(li);
            });
        }

    </script>
</body>

</html>