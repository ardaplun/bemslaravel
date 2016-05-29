@extends('layouts.2nd-layout')

@section('content')
<section id="slider"><!--slider-->
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
              <center><p>
                this buildiiiiing is {{$building}} floor {{$floor}} and room {{$room}}
              </p><center>

            </div>
        </div>
    </div>
</section><!--/slider-->

<!-- <section>
    <div class="container">
        <div class="row">


            </div>
        </div>
    </div>
</section> -->
@endsection
