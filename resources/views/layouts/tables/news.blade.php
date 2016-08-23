<!-- Table News-->
<div class="container col-md-12">
    <br>
    <div>
        <button type="button" class="btn btn-primary col-xs-offset-10" data-toggle="modal" data-target="#model-0">Neuer Eintrag</button>
    </div>
        <!-- Modal -->
            <div class="modal" id="model-0" tabindex="" role="dialog"
                 aria-labelledby="myModalLabel"
                 aria-hidden="true">
                 <form method="POST" action="news" id="create">
                     {{ csrf_field() }}
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal"
                                        aria-hidden="true">&times;</button>
                                <h4 class="modal-title" id="myModalLabel">Neuer Eintrag</h4>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="titel-0">Titel:</label>
                                    <input type="text" class="form-control" id="titel-0" name="title" maxlength="250">
                                </div>
                                <div class="form-group">
                                    <label for="textblock-0">Text:</label>
                                    <textarea class="form-control" id="textblock-0" rows="3"
                                              name="content"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="pic-0">Bild:</label>
                                    <img src="placeholder.png" class="img-responsive" alt="Bild" id="pic-0">
                                </div>

                            </div>
                            <div class="modal-footer">
                                <p></p>
                                <button type="submit" class="btn btn-success">Speichern</button>
                            </div>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </form>
            </div>
        <!-- /.modal -->
    <br>
    <table class="table table-striped table-hover table-bordered">
        <thead>
        <tr>
            <th class="col-md-1">Titel</th>
            <th>Text</th>
        </tr>
        </thead>
        <tbody>
        @foreach($news as $one_news)
            <!-- Tablerow -->
            <tr>
                <td data-toggle="modal" data-target="#model-{{ $one_news->id }}"> {{ $one_news->title }} </td>
                <td data-toggle="modal" data-target="#model-{{ $one_news->id }}"> {{ $one_news->content }} </td>
                <td class="tdcenter">
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
                                    <label for="titel-{{ $one_news->id }}">Titel:</label>
                                    <input type="text" class="form-control" id="titel-{{ $one_news->id }}" name="title" value="{{$one_news->title}}" maxlength="250">
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
                            </div>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
            </form>
            <!-- /.modal -->

        @endforeach
        </tbody>
    </table>
</div>
