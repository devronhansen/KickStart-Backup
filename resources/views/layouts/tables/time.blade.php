<!-- Table time-->
<div class="container col-md-12">
    <br>
    <div>
        <button type="button" class="btn btn-primary col-xs-offset-10" data-toggle="modal"
                data-target="#model-time-0"><span class="fa fa-plus-square" aria-hidden="true"></span>&ensp;Neuer
            Eintrag
        </button>
    </div>
    <!-- Modal -->
    <form method="POST" action="time" id="create" files=true enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="modal fade" id="model-time-0" tabindex="" role="dialog"
             aria-labelledby="myModalLabel"
             aria-hidden="true">
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
                            <label class="btn btn-primary btn-file">
                                <span class="glyphicon glyphicon-save"></span>
                                Neues Bild hochladen
                                <input type="file" name="file_0"
                                       accept=".bmp, .gif, .jpeg, .jpg, .png"
                                       style="display: none;">
                            </label>
                            <h4><span class="label label-default download-pic col-md-pull-1"></span></h4>
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
        </div>
    </form>
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
        @foreach($time as $one_time)
            <!-- Tablerow -->
            <tr>
                <td data-toggle="modal" data-target="#model-time-{{ $one_time->id }}"
                    class="td-title"> {{ $one_time->title }} </td>
                <td data-toggle="modal" data-target="#model-time-{{ $one_time->id }}"
                    class="td-content"> {{ $one_time->content }} </td>

                <td class="trash">
                    <button type="button" class="btn btn-error" data-toggle="modal"
                            data-target="#delete-modal-time-{{ $one_time->id }}"><span
                                class="glyphicon glyphicon-trash"></span>
                    </button>
                    <div class="modal fade" tabindex="-1" role="dialog" id="delete-modal-time-{{ $one_time->id }}">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                                aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title">Möchten Sie diesen Eintrag wirklich löschen?</h4>
                                </div>
                                <div class="modal-footer">
                                    <form method="POST" action="time/{{ $one_time->id }}" id="delete">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        <button type="submit" class="btn btn-danger">Eintrag löschen</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>

            <!-- Modal -->
            <form method="POST" action="time/{{ $one_time->id }}" files=true enctype="multipart/form-data">
                {{ csrf_field() }}
                {{ method_field('PATCH') }}
                <div class="modal fade" id="model-time-{{ $one_time->id }}" tabindex="" role="dialog"
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
                                    <label for="titel-{{ $one_time->id }}">Titel:</label>
                                    <input type="text" class="form-control" id="titel-{{ $one_time->id }}"
                                           name="title"
                                           value="{{$one_time->title}}" maxlength="250" required>
                                </div>
                                <div class="form-group">
                                    <label for="textblock">Text:</label>
                                    <textarea class="form-control noresize" id="textblock" rows="10" required
                                              name="content">{{$one_time->content}}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="pic">Bild:</label>
                                    <img src="files/time_{{ $one_time->id }}.jpg" class="img-responsive"
                                         alt="Kein Bild vorhanden"
                                         onerror="this.onerror=null;this.src='./files/placeholder.png';">
                                </div>
                                <div class="form-group">
                                    <label class="btn btn-primary btn-file">
                                        <span class="glyphicon glyphicon-save"></span>
                                        &ensp; Neues Bild hochladen <input type="file" name="file_0"
                                                                           accept=".bmp, .gif, .jpeg, .jpg, .png"
                                                                           style="display: none;">
                                    </label>
                                    <h4><span class="label label-default download-pic col-md-pull-1"></span></h4>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <p>Eintrag erstellt: {{ ($one_time->created_at->format('d.m.Y H:i:s')) }}<br>
                                    Eintrag bearbeitet: {{ ($one_time->updated_at->format('d.m.Y H:i:s')) }}
                                    von {{ $one_time->getUser->name }}</p>
                                <button type="submit" class="btn btn-success"><i class="fa fa-floppy-o"
                                                                                 aria-hidden="true"></i>&ensp;Speichern
                                </button>
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