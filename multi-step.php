on view:-
multi-step-form.blade.php
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- Add Parsaly js-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.9.2/parsley.min.js" integrity="sha512-eyHL1atYNycXNXZMDndxrDhNAegH2BDWt1TmkXJPoGf1WLlNYt08CSjkqF5lnCRmdm3IrkHid8s2jOUY4NIZVQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <style>
        section{
            padding-top: 100px;
        }
        .form-section{
            padding-left:15px;
            display: none; 
        }
        .form-section.current{
            display: inherit;
        }
        .btn-info,.btn-btn-success{
            margin-top:10px;
        }
        .parsley-errors-list{
            margin:2px 0 3px;
            padding:0;
            list-style-type: none;
            color: red; 
        }
    </style>
    </head>
    <body>
        <section>
            <div class="container">
                <div class="row">
                    <div class="col-xl-6 offset-md-3">
                        <div class="card-header text-white bg-info">
                            <h5>Multi Step Form</h5>
                        </div>

                        <div class="card-body">
                            <form method="post" action="{{route('form.submit')}}" class="contact-form">
                                @csrf
                                <div class="form-section">
                                    <label for="name">Name : </label>
                                    <input type="text" name="name" class="form-control" required>

                                    <label for="email">Email : </label>
                                    <input type="text" name="email" class="form-control" required>
                                </div>

                                <div class="form-section">
                                    <label for="password">Password : </label>
                                    <input type="text" name="password" class="form-control" required>

                                    <label for="mobile">Mobile : </label>
                                    <input type="text" name="mobile" class="form-control" required>
                                </div>

                                <div class="form-section">
                                    <label for="gender">Gender : </label>
                                    <input type="text" name="gender" class="form-control" required>

                                    <label for="qualification">qualification : </label>
                                    <input type="text" name="qualification" class="form-control" required>
                                </div>

                                <div class="form-navigation">
                                    <button type="button" class="previous btn btn-info float-left">Previous</button>
                                    <button type="button" class="next btn btn-info float-right">Next</button>
                                    <button type="submit" class="btn btn-success float-right">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    <script>
        $(function(){
            var $sections=$('.form-section');

            function navigateTo(index){
                $sections.removeClass('current').eq(index).addClass('current');
                $('.form-navigation .previous').toggle(index>0);
                var atTheEnd=index >= $sections.length - 1;
                $('.form-navigation .next').toggle(!atTheEnd);
                $('.form-navigation [type=submit]').toggle(atTheEnd);
            }

            function curIndex()
            {
                return $sections.index($sections.filter('.current'));
            }

            $('.form-navigation .previous').click(function(){
                navigateTo(curIndex()-1);
            });

            $('.form-navigation .next').click(function(){
                $('.contact-form').parsley().whenValidate({
                    group: 'block-' +curIndex()
                }).done(function(){
                    navigateTo(curIndex()+1);
                });
            });

            $sections.each(function(index,section){
                $(section).find(':input').attr('data-parsley-group','block-'+index);
            });
    
            navigateTo(0);
        });
    </script>

    </body>
    </html>

---
On Controller:-
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FormController extends Controller
{
    function index()
    {
        return view('multi-step-form');
    }

    function formSubmit(Request $request)
    {
        return $request->all();
    }
}


On route:-
<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FormController;

Route::get('/', function () {
    return view('welcome');
});
Route::get('form',[FormController::class,'index']);
Route::post('form-submit',[FormController::class,'formSubmit'])->name('form.submit');





