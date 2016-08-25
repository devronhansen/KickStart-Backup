@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <ul class="nav nav-tabs">
                    @can('see-news')
                        <li class="active"><a data-toggle="tab" href="#news">Neuigkeiten</a></li>
                    @endcan
                    @can('see-offer_detail')
                        <li><a data-toggle="tab" href="#offer_detail">Angebote</a></li>
                    @endcan
                    @can('see-person')
                        <li><a data-toggle="tab" href="#person">Ansprechpartner</a></li>
                    @endcan
                    @can('see-time')
                        <li><a data-toggle="tab" href="#time">Öffnungszeiten</a></li>
                    @endcan
                    @can('see-menu')
                        <li><a data-toggle="tab" href="#menu">Speiseplan</a></li>
                    @endcan
                </ul>
                <div class="tab-content">

                    <div id="news" class="tab-pane fade in active">
                        @include('layouts.tables.news')
                    </div>

                    <div id="offer_detail" class="tab-pane fade">
                        @include('layouts.tables.offer_detail')
                    </div>

                    <div id="person" class="tab-pane fade">
                        @include('layouts.tables.person')
                    </div>

                    <div id="time" class="tab-pane fade">
                        @include('layouts.tables.time')
                    </div>

                    <div id="menu" class="tab-pane fade">
                        @include('layouts.tables.menu')
                    </div>

                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
