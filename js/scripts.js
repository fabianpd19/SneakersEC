$(document).ready(function () {
  // API Key de OpenWeather
  const apiKey = "f1fef26d7354e13c49821b4a071afe5b";

  // Obtener la geolocalización del usuario
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(success, error);
  } else {
    $("#weather-data").html(
      "La geolocalización no es soportada por este navegador."
    );
  }

  function success(position) {
    const lat = position.coords.latitude;
    const lon = position.coords.longitude;

    // URL de la API de OpenWeather
    const weatherURL = `https://api.openweathermap.org/data/2.5/weather?lat=${lat}&lon=${lon}&appid=${apiKey}&units=metric&lang=es`;

    // Realizar la solicitud AJAX
    $.ajax({
      url: weatherURL,
      method: "GET",
      success: function (response) {
        const weatherDescription = response.weather[0].description;
        const temperature = response.main.temp;
        const city = response.name;
        const icon = `http://openweathermap.org/img/wn/${response.weather[0].icon}.png`;

        // Mostrar los datos del clima
        $("#weather-data").html(`
                    <div class="text-center">
                        <h6>${city}</h6>
                        <img src="${icon}" class="weather-icon" alt="Weather icon">
                        <p>${temperature}°C, ${weatherDescription}</p>
                    </div>
                `);
      },
      error: function () {
        $("#weather-data").html("No se pudieron obtener los datos del clima.");
      },
    });
  }

  function error() {
    $("#weather-data").html("No se pudo obtener la ubicación.");
  }

  // Ocultar y mostrar la sección de clima
  $("#weather").click(function () {
    $(this).toggleClass("collapsed");
  });
});

$(document).ready(function () {
  $("#floatingButton").click(function () {
    $("#myModal").modal("toggle");
  });
});
