@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <ul class="nav nav-tabs">
              <li class="active"><a data-toggle="tab" href="#news">Home</a></li>
              <li><a data-toggle="tab" href="#menu1">Menu 1</a></li>
              <li><a data-toggle="tab" href="#menu2">Menu 2</a></li>
            </ul>
            <div class="tab-content">

              <div id="news" class="tab-pane fade in active">
                  @include('layouts.tables.news')
              </div>

              <div id="menu1" class="tab-pane fade">
                <h3>Menu 1</h3>
                <p>Some content in menu 1.</p>
              </div>

              <div id="menu2" class="tab-pane fade">
                <h3>Menu 2</h3>
                <p>Some content in menu 2.</p>
              </div>

            </div>
        </div>
    </div>
</div>
@endsection
