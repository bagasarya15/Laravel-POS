<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>404 - Page Not Found</title>
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
              src="{{ asset('assets/images/samples/error-404.svg') }}"
              alt="Not Found"
            />
            <h1 class="fs-1">Halaman Tidak Ditemukan !</h1>
            <p class="fs-5 text-gray-600">
              Halaman yang anda cari tidak ditemukan.
            </p>
            <a href="{{ route('home') }}" class="btn btn-lg btn-outline-primary mt-3"
              >Kembali</a
            >
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
