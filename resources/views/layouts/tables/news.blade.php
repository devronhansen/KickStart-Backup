<!-- Table News-->
<div class="container col-md-12">
    <br>
    <div>
        <button type="button" class="btn btn-primary col-xs-offset-10" data-toggle="modal" data-target="#model-0">Neuer
            Eintrag
        </button>
    </div>
    <!-- Modal -->
    <div class="modal" id="model-0" tabindex="" role="dialog"
         aria-labelledby="myModalLabel"
         aria-hidden="true">
        <form method="POST" action="news" id="create" files=true enctype="multipart/form-data">
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
                            <input type="text" class="form-control" id="titel-0" name="title" maxlength="250" required>
                        </div>
                        <div class="form-group">
                            <label for="textblock-0">Text:</label>
                            <textarea class="form-control noresize" id="textblock-0" rows="10" required
                                      name="content"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="file_0">Neues Bild hochladen:</label>
                            <input type="file" id="file_0" name="file_0" accept="image/x-png, image/gif, image/jpeg">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <p></p>
                        <button type="submit" class="btn btn-success" name="submit">Speichern</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </form>
    </div>
    <!-- /.modal -->
    <br>
    <table class="table table-hover {{--table-bordered--}}">
        <thead>
        <tr>
            <th class="col-md-2">Titel</th>
            <th>Text</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach($news as $one_news)
            <!-- Tablerow -->
            <tr>
                <td data-toggle="modal" data-target="#model-{{ $one_news->id }}"
                    class="td-title"> {{ $one_news->title }} </td>
                <td data-toggle="modal" data-target="#model-{{ $one_news->id }}"
                    class="td-content"> {{ $one_news->content }} </td>

                <td class="trash">
                    {{--<form method="POST" action="news/{{ $one_news->id }}" id="delete">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        <button type="submit" class="btn btn-error"><span class="glyphicon glyphicon-trash"></span>
                        </button>--}}
                    <button type="button" class="btn btn-error" data-toggle="modal"
                            data-target="#delete-modal-{{ $one_news->id }}"><span
                                class="glyphicon glyphicon-trash"></span>
                    </button>
                    <div class="modal fade" tabindex="-1" role="dialog" id="delete-modal-{{ $one_news->id }}">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                                aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title">Möchten Sie diesen Eintrag wirklich löschen?</h4>
                                </div>
                                {{-- <div class="modal-body">
                                     <p>One fine body&hellip;</p>
                                 </div>--}}
                                <div class="modal-footer">
                                    <form method="POST" action="news/{{ $one_news->id }}" id="delete">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        <button type="submit" class="btn btn-danger">Eintrag löschen</button>
                                    </form>
                                </div>
                    {{--</form>--}}
                </td>
            </tr>

            <!-- Modal -->
            <form method="POST" action="news/{{ $one_news->id }}" files=true enctype="multipart/form-data">
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
                                <h4 class="modal-title" id="myModalLabel">Eintrag bearbeiten</h4>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="titel-{{ $one_news->id }}">Titel:</label>
                                    <input type="text" class="form-control" id="titel-{{ $one_news->id }}" name="title"
                                           value="{{$one_news->title}}" maxlength="250" required>
                                </div>
                                <div class="form-group">
                                    <label for="textblock">Text:</label>
                                    <textarea class="form-control noresize" id="textblock" rows="10" required
                                              name="content">{{$one_news->content}}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="pic">Bild:</label>
                                    <img src="files/news_{{ $one_news->id }}.png" class="img-responsive" alt="Bild">
                                </div>
                                <div class="form-group">
                                    <label for="file">Neues Bild hochladen:</label>
                                    <input type="file" id="file" name="file"
                                           accept="image/x-png, image/gif, image/jpeg">
                                </div>

                            </div>
                            <div class="modal-footer">
                                <p>Eintrag erstellt: {{ ($one_news->created_at->format('d.m.Y H:i:s')) }}<br>
                                    Eintrag bearbeitet: {{ ($one_news->updated_at->format('d.m.Y H:i:s')) }} von {{ $one_news->getname->name }}</p>
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
