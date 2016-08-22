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
                 <th class="col-md-1">ID</th>
                 <th>Titel</th>
                 <th>Text</th>
                 <th>Delete</th>
               </tr>
             </thead>
             <tbody>
               @foreach($data as $id => $user)
               <!-- Tablerow -->
               <tr>
                 <td data-toggle="modal" data-target="#model-{{ $id }}"> {{ $user->id }} </td>
                 <td data-toggle="modal" data-target="#model-{{ $id }}"> {{ $user->title }} </td>
                 <td data-toggle="modal" data-target="#model-{{ $id }}"> {{ $user->content }} </td>
                 <td><button type="button" class="btn btn-error"><span class="glyphicon glyphicon-trash"></span></button></td>
               </tr>

               <!-- Modal -->
               {{-- <form method="POST" action="{{ route('RouteAufMichSelbst', $id, 'Edit=1 oder so uebergeben') }}"> --}}
               <form method="POST">
                  <div class="modal" id="model-{{ $id }}" tabindex="" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                          <div class="modal-content">
                              <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                  <h4 class="modal-title" id="myModalLabel">{{$user->title}}</h4>
                              </div>
                              <div class="modal-body">
                                  <div class="form-group">
                                    <label for="titel">Titel:</label>
                                    <input type="text" class="form-control" id="titel" name="">
                                  </div>
                                  <div class="form-group">
                                    <label for="textblock">Text:</label>
                                    <textarea class="form-control" id="textblock" rows="3" name="TextBlock_{{ $user->id }}"></textarea>
                                  </div>
                                  <div class="form-group">
                                    <label for="pic">Bild:</label>
                                     <img src="{{ $user->picture }}" class="img-responsive" alt="Bild">
                                  </div>

                              </div>
                              <div class="modal-footer">
                                  <p>Ich wurde erstellt am: {{ ($user->created_at->format('d.m.Y')) }}</p>
                                  <button type="submit" class="btn btn-danger" data-dismiss="modal">Loeschen</button>
                                  <button type="submit" class="btn btn-success" data-dismiss="modal">Speichern</button>
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
