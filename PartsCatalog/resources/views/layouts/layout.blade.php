<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.4/css/bulma.min.css">
    <script defer src="https://use.fontawesome.com/releases/v5.3.1/js/all.js"></script>
    <style media="screen">
      .mx-1 {
        margin-left: 10px;
        margin-right: 10px;
      }

      .my-2 {
        margin-top: 20px;
        margin-bottom: 20px;
      }
    </style>
    <title></title>
  </head>
  <body>
    <section class="hero is-info">
      <div class="hero-body">
        <div class="container">
          <div class="columns">
            <div class="column">
              @yield("title")
            </div>
            <div class="column is-3">
              @yield("top-button")
            </div>
          </div>

        </div>
      </div>
    </section>
    <section class="section">
      @yield("content")
    </section>
    <script>
      let menu = document.getElementById("menu");
      menu.onclick = function () {
        menu.classList.toggle('is-active')
      }
    </script>
  </body>
</html>
