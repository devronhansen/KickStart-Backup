<!-- Table News-->
<div class="container col-md-12">
    <br>
    <script src="/js/jquery.pajinate.js"></script>
    <script type="text/javascript">
			$(document).ready(function(){
				$('#paging_container1').pajinate();
			});
    </script>
    <div id="wrapper">
      <div id="paging_container1" class="container col-md-12">
		<div class="pajinate_page_navigation"></div>

		<ul class="pajinate_content">
          @for ($i = 1; $i < 8 * 24; $i++)
          {{--*/ $date = date("d.m.Y",$today + (86400 * ($i - 1)) + (604800 * 0) ) /*--}}
          {{--*/ $date_long = date("Y-m-d H:i:s",$today + (86400 * ($i - 1)) + (604800 * 0) ) /*--}}
					 <li>
             <p>
               <strong>
                 @if ($i % 7 == 1)
                     Montag
                 @elseif ($i % 7 == 2)
                     Dienstag
                 @elseif ($i % 7 == 3)
                     Mittwoch
                 @elseif ($i % 7 == 4)
                     Donnerstag
                 @elseif ($i % 7 == 5)
                     Freitag
                 @elseif ($i % 7 == 6)
                     Samstag
                 @elseif ($i % 7 == 0)
                     Sonntag
                 @else
                     Hier ist was falsch gelaufen...
                 @endif
                 , der {{ $date }}
              </strong>
            </p>
                <table class="table">
                    <col style="width:150px">
                    <col style="width:*">
                    @if (isset($menu[$date_long]))
                    <tbody>
                        <tr>
                            <td>Vollkost</td>
                            <td>{{$menu[$date_long]->vollkost}}</td>
                        </tr>
                        <tr>
                            <td>Vegetarisch</td>
                            <td>{{$menu[$date_long]->vegetarisch}}</td>
                        </tr>
                        <tr>
                            <td>Fitness</td>
                            <td>{{$menu[$date_long]->fitness}}</td>
                        </tr>
                        <tr>
                            <td>Nachspeise</td>
                            <td>{{$menu[$date_long]->nachtisch}}</td>
                        </tr>
                    </tbody>
                    @else
                    <tbody>
                        <tr>
                            <td>Vollkost</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Vegetarisch</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Fitness</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Nachspeise</td>
                            <td></td>
                        </tr>
                    </tbody>
                    @endif
                </table>
                <hr>
          </li>

          @endfor
    		</ul>
    	</div>
    </div>

            <tr data-toggle="modal" data-target="#model-menu-{{$i}}" class="td-title">

    <marquee scrollamount="15" scrolldelay="1">
  <p><img src="http://static.tumblr.com/68d74ad72b013652f1b0511b4bb5d8b6/s61rejd/I22mp7fci/tumblr_static_jesus.gif" alt="Jebus"></p>
</marquee>
</div>
