<html lang="en">
  <head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />

    <!-- Latest compiled and minified CSS -->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
    />

    <style>
      * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
      }

      .container {
        width: 100vw;
        height: 100vh;
        position: relative;
      }

      .center_div {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
      }

      .hide{
        display:hide;
      }
    </style>
  </head>

  <body>
    <header>
      <!-- place navbar here -->
    </header>
    <main>

      <div class=" text-center mt-5 "><h3>User registration Form</h3></div>
      <div class="container">




        <div class="center_div mt-5">

        <div class="add"></div>
        <div class="wait_div"></div>

        <form>


<div class="container">

  <article class="row">



          <div class="col-6">
            <div class="mb-3">
              <label for="name">Enter your name</label>
              <input type="text" name="name" class="form-control" placeholder="john doe">
            </div>
          </div>

          <div class="col-6">
            <div class="mb-3">
              <label for="name">Enter your email</label>
              <input type="email" name="email"  class="form-control" placeholder="johndoe@gmail.com">
            </div>
          </div>

          <div class="col-6">
            <div class="mb-3">
              <label for="name">Create strong password</label>
              <input type="password" name="password" class="form-control" placeholder="********">
            </div>
          </div>

          <div class="col-6">
            <div class="mb-3">
              <label for="name">Confirm password</label>
              <input type="password" name="confirm_password" class="form-control" placeholder="********" >
            </div>
          </div>


          <button class="btn btn-primary">click</button>

        </article>
        </div>

        </form>
        </div>
      </div>
    </main>
    <footer>
      <!-- place footer here -->
    </footer>
    <!-- Bootstrap JavaScript Libraries -->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

    <!--jequery start-->
    <script>
      $(document).ready(function () {

        $(document).on("click", ".btn", function (e) {

          e.preventDefault();

          let wait = $('.wait_div');

          let curelem = $(this);
          let btntext = $(".btn");


          let b = "clicked";


          const getresp = async (b) => {

          let add = $('.add');

          add.show();

          add.html('');
          add.removeClass('alert alert-danger');
          add.removeClass('alert alert-success');

      wait.html('please wait..')

      let forms = $('form');

    $('.btn').prop('disabled' , true);

  try {

    await  $.ajax({
            "url":"/api/user/store" ,
            "type":"post",
            "data": $('form').serialize(),
             success : function (res) {
              wait.html('');

              add.toggleClass('alert alert-success');
              add.html('your account successfully created!')

              setTimeout(()=>{
                add.hide();
                $('.btn').prop('disabled' , false);
              } , 3000);

              $(document).find('input').val('');
              } ,
              error : function(res){
                add.toggleClass('alert alert-warning')

                // let response = res.responseJSON

                const { status , errors} =  res.responseJSON;

                if(status == 0){
                  wait.html('');

                  add.html('fdd');

                  let parsedObject = JSON.parse(JSON.stringify(errors));

                  let reversedArray = [];
                  Object.entries(errors).forEach(function (pair) {
                      reversedArray.unshift(pair);
                  });

                  let reversedObject = Object.fromEntries(reversedArray);

                  $.each(reversedObject, function (ind_key, value_Elm) {

                    add.toggleClass('alert alert-warning')
                    add.html(value_Elm);
                    add.removeClass('alert alert-success')
                    add.addClass('alert alert-danger')

                  });

                  $('.btn').prop('disabled' , false);
                }
              }
          });

       } catch (error) {
        console.log(error)
       }

          }
          getresp();

        });
      });
    </script>
  </body>
</html>
