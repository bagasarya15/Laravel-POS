
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>500</title>
    <link rel="stylesheet" href="{{ asset('assets/css/main/app.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/pages/error.css') }}" />
  </head>


  <body>
    <div id="error">
      <div class="error-page container">
        <div class="col-md-8 col-12 offset-md-2">
          <div class="text-center">
            <img
              class="img-error"
              src="{{ asset('assets/images/samples/error-500.svg') }}"
              alt="Not Found"
            />
            <h1 class="error-title">Sistem bermasalah</h1>
            <p class="fs-5 text-gray-600">
                Situs web saat ini tidak tersedia. Coba lagi nanti atau hubungi developer.
            <a href="index.html" class="btn btn-lg btn-outline-primary mt-3"
              >Go Home</a
            >
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
