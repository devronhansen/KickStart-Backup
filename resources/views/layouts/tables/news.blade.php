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
            <th>ID</th>
            <th>Header</th>
            <th>Text</th>
            <th>Delete</th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $id => $user)
            <!-- Tablerow -->
            <tr data-toggle="modal" data-target="#model-{{ $id }}">
                <td> {{ $user->id }} </td>
                <td> {{$user->name}} </td>
                <td> {{ $test_text }} </td>
                <td>
                    <button type="button" class="btn btn-error"><span class="glyphicon glyphicon-trash"></span></button>
                </td>
            </tr>

            <!-- Modal -->
            {{-- <form method="POST" action="{{ route('RouteAufMichSelbst', $id, 'Edit=1 oder so uebergeben') }}"> --}}
            <form method="POST">
                <div class="modal" id="model-{{ $id }}" tabindex="" role="dialog" aria-labelledby="myModalLabel"
                     aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal"
                                        aria-hidden="true">&times;</button>
                                <h4 class="modal-title" id="myModalLabel">{{$user->name}}</h4>
                            </div>
                            <div class="modal-body">
                                <p>Ich wurde erstellt am: {{ $user->created_at }}</p>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-default" data-dismiss="modal">Close</button>
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
