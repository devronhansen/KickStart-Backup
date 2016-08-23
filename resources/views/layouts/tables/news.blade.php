<!-- Table News-->
<div class="container col-md-12">
    <br>
    <div>
        <button type="button" class="btn btn-primary col-xs-offset-10">Neuer Eintrag</button>
    </div>
    <br>
    <table class="table table-striped table-hover table-bordered">
        <thead>
        <tr>
            <th class="col-md-1">Titel</th>
            <th>Text</th>
            <th>Delete</th>
        </tr>
        </thead>
        <tbody>
        @foreach($news as $one_news)
            <!-- Tablerow -->
            <tr>
                <td data-toggle="modal" data-target="#model-{{ $one_news->id }}"> {{ $one_news->title }} </td>
                <td data-toggle="modal" data-target="#model-{{ $one_news->id }}"> {{ $one_news->content }} </td>
                <td>
                    <form method="POST" action="news/{{ $one_news->id }}" id="delete">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                    <button type="submit" class="btn btn-error"><span class="glyphicon glyphicon-trash"></span></button>
                        </form>
                </td>
            </tr>

            <!-- Modal -->

            <form method="POST" action="news/{{ $one_news->id }}">
                {{ csrf_field() }}
                {{ method_field('PATCH') }}
                <div class="modal" id="model-{{ $one_news->id }}" tabindex="" role="dialog"
                     aria-labelledby="myModalLabel"
                     aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal"
                                        aria-hidden="true">&times;</button>
                                <h4 class="modal-title" id="myModalLabel">{{$one_news->title}}</h4>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="titel">Titel:</label>
                                    <input type="text" class="form-control" id="titel" name="title" value="{{$one_news->title}}">
                                </div>
                                <div class="form-group">
                                    <label for="textblock">Text:</label>
                                    <textarea class="form-control" id="textblock" rows="3"
                                              name="content">{{$one_news->content}}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="pic">Bild:</label>
                                    <img src="{{ $one_news->picture }}" class="img-responsive" alt="Bild">
                                </div>

                            </div>
                            <div class="modal-footer">
                                <p>Ich wurde erstellt am: {{ ($one_news->created_at->format('d.m.Y')) }}</p>
                                <button type="submit" class="btn btn-success">Speichern</button>
                            </form>
                                {{--<form method="POST" action="news/{{ $one_news->id }}" id="delete">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}--}}
                                <button type="submit" class="btn btn-danger" data-dismiss="modal" form="delete">Löschen</button>
                                {{--     <button type="submit" class="btn btn-warning" data-dismiss="modal">Close</button>--}}
                               {{-- </form>--}}
                            </div>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>

            <!-- /.modal -->

        @endforeach
        </tbody>
    </table>
</div>
