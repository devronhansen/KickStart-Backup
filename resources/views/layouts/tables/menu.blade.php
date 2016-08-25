<!-- Table News-->
<div class="container col-md-12">
    <br>
    <table class="table table-hover {{--table-bordered--}}">
        <thead>
        <tr>
            <th class="col-md-2">NACH LINKS</th>
            <th>AKTUELLE WOCHE: (WOCHE) --- NACH RECHTS</th>
        </tr>
        </thead>
        <tbody>
        @for ($i = 1; $i < 8; $i++)
            <!-- Tablerow -->
            <tr>
                {{-- data-toggle abhaengig, ob id vorhanden und so fuer patch / create --}}
                <td><strong>
                    @if ($i == 1)
                        Montag
                    @elseif ($i == 2)
                        Dienstag
                    @elseif ($i == 3)
                        Mittwoch
                    @elseif ($i == 4)
                        Donnerstag
                    @elseif ($i == 5)
                        Freitag
                    @elseif ($i == 6)
                        Samstag
                    @elseif ($i == 7)
                        Sonntag
                    @else
                        Hier ist was falsch gelaufen...
                    @endif
                </strong></td>
                <td> {{ date("Y-m-d",$today + (86400 * ($i - 1)) + (604800 * 1) ) }} </td>
            </tr>
            <tr data-toggle="modal" data-target="#model-menu-{{$i}}" class="td-title">
                <td colspan="2">
                    <!-- Tabelle in der Tabelle -->
                    <table class="table transparentbackground">
                        <tbody>
                            <tr>
                                <td>Vollkost</td>
                                <td>VOLLKOSTWERT</td>
                            </tr>
                            <tr>
                                <td>Vegetarisch</td>
                                <td>VEGETARISCHER WERT</td>
                            </tr>
                            <tr>
                                <td>Fitness</td>
                                <td>FITNESSNAHRUNG</td>
                            </tr>
                            <tr>
                                <td>Nachspeise</td>
                                <td>VOLLKOSTWERT</td>
                            </tr>
                        </tbody>
                    </table>
<!-- 2 Modals, 1 fuer Patch, 1 fuer Create oder so -->
                </td>
            </tr>
        @endfor
        </tbody>
    </table>
</div>
