<table class="table">
    <thead>

        <tr>
            <th colspan="14" style="font-weight: bold;text-align: center;">Beneficary Detail</th>
        </tr>


        <tr>
            <th style="width: 10px;">{{trans('app.sn')}}</th>
            @if(auth()->user()->user_group_id!=2)
            <th>Subproject Name</th>
            @endif
        <th colspan="24" style="font-weight: bold;">HH and Population by Ethnicity/Sex</th>

        </tr>
        <tr>
            <th></th>
              @if (auth()->user()->user_group_id != 2)
            <th></th>
            @endif
            <th colspan="4" style="font-weight: bold;">Braman/Chhetri</th>                            
            <th colspan="4" style="font-weight: bold;">Janajati</th>                            
            <th colspan="4" style="font-weight: bold;">Dalit</th>                            
            <th colspan="4" style="font-weight: bold;">Muslim</th>                            
            <th colspan="4" style="font-weight: bold;">Others</th>  
            <th colspan="4" style="font-weight: bold;">Total</th> 

        </tr>
        <tr>
            <th></th>
             @if (auth()->user()->user_group_id != 2)
            <th></th>
            @endif
            @for($i = 1; $i <=6; $i++)
                <th style="font-weight: bold;">HH</th>
                <th style="font-weight: bold;">M</th>
                <th style="font-weight: bold;">F</th>
                <th style="font-weight: bold;">T</th>
            @endfor
       

        </tr>
    </thead>
    <tbody>
        <?php
        $i = 1; 
        $col_bramin_hh=0;
              $col_bramin_m=0;
              $col_bramin_f=0;
              $col_bramin_t=0;

              $col_janjati_hh=0;
              $col_janjati_m=0;
              $col_janjati_f=0;
              $col_janjati_t=0;

              $col_dalit_hh=0;
              $col_dalit_m=0;
              $col_dalit_f=0;
              $col_dalit_t=0;

              $col_muslim_hh=0;
              $col_muslim_m=0;
              $col_muslim_f=0;
              $col_muslim_t=0;

              $col_other_hh=0;
              $col_other_m=0;
              $col_other_f=0;
              $col_other_t=0;

              $row_hh=0;
              $row_m=0;
              $row_f=0;
              $row_t=0;?>
       

        @foreach($beneficary as $key=>$ben)
        @foreach($ben as $val)
       <tr>
            <th scope=row>{{$i}}</th>
            @if(auth()->user()->user_group_id!=2)
            <td>{{$val->project->name}}</td>
            @endif
            <?php $bramin_t=$val->bramin_hh+$val->bramin_m+$val->bramin_f ;?>
            <td>{{$val->bramin_hh?$val->bramin_hh:0}}</td>
            <td>{{$val->bramin_m?$val->bramin_m:0}}</td>
            <td>{{$val->bramin_f?$val->bramin_f:0}}</td>
            <td style="font-weight: bold">{{$bramin_t}}</td>

            <?php $janajati_t= $val->janjati_hh+$val->janjati_m+$val->janjati_f; ?>
            <td>{{$val->janjati_hh?$val->janjati_hh:0}}</td>
            <td>{{$val->janjati_m?$val->janjati_m:0}}</td>
            <td>{{$val->janjati_f?$val->janjati_f:0}}</td>
            <td style="font-weight: bold">{{$janajati_t}}</td>

            <?php $dalit_t=$val->dalit_hh+$val->dalit_m+$val->dalit_f; ?>
            <td>{{$val->dalit_hh?$val->dalit_hh:0}}</td>
            <td>{{$val->dalit_m?$val->dalit_m:0}}</td>
            <td>{{$val->dalit_f?$val->dalit_f:0}}</td>
            <td style="font-weight: bold">{{$dalit_t}}</td>

            <?php $muslim_t=$val->muslim_hh+$val->muslim_m+$val->muslim_f; ?>
            <td>{{$val->muslim_hh?$val->muslim_hh:0}}</td>
            <td>{{$val->muslim_m?$val->muslim_m:0}}</td>
            <td>{{$val->muslim_f?$val->muslim_f:0}}</td>
            <td style="font-weight: bold">{{$muslim_t}}</td>


            <?php $other_t=$val->other_hh+$val->other_m+$val->other_f;?>
            <td>{{$val->other_hh?$val->other_hh:0}}</td>
            <td>{{$val->other_m?$val->other_m:0}}</td>
            <td>{{$val->other_f?$val->other_f:0}} </td>
            <td style="font-weight: bold">{{$other_t}}</td>

            <?php 
            $total_hh=$val->bramin_hh+$val->janjati_hh+$val->dalit_hh+$val->muslim_hh+$val->other_hh;
            $total_m=$val->bramin_m+$val->janjati_m+$val->dalit_m+$val->muslim_m+$val->other_m;
            $total_f=$val->bramin_f+$val->janjati_f+$val->dalit_f+$val->muslim_f+$val->other_f;
            $total_t=$bramin_t+$janajati_t+$dalit_t+$muslim_t+$other_t; ?>
             <td style="font-weight: bold">{{$total_hh}}</td>
             <td style="font-weight: bold">{{$total_m}}</td>
             <td style="font-weight: bold">{{$total_f}}</td>
             <td style="font-weight: bold">{{$total_t}}</td>

             <?php
              $col_bramin_hh+=$val->bramin_hh;
              $col_bramin_m+=$val->bramin_m;
              $col_bramin_f+=$val->bramin_f;
              $col_bramin_t+=$bramin_t;

              $col_janjati_hh+=$val->janjati_hh;
              $col_janjati_m+=$val->janjati_m;
              $col_janjati_f+=$val->janjati_f;
              $col_janjati_t+=$janajati_t;

              $col_dalit_hh+=$val->dalit_hh;
              $col_dalit_m+=$val->dalit_m;
              $col_dalit_f+=$val->dalit_f;
              $col_dalit_t+=$dalit_t;

              $col_muslim_hh+=$val->muslim_hh;
              $col_muslim_m+=$val->muslim_m;
              $col_muslim_f+=$val->muslim_f;
              $col_muslim_t+=$muslim_t;

              $col_other_hh+=$val->other_hh;
              $col_other_m+=$val->other_m;
              $col_other_f+=$val->other_f;
              $col_other_t+=$other_t;

              $row_hh+=$total_hh;
              $row_m+=$total_m;
              $row_f+=$total_f;
              $row_t+=$total_t;?>


        </tr>
            <?php $i++; ?>

        @endforeach
        @endforeach
        <tr>
            <td colspan="2" style="font-weight: bold; text-align:center;">Total</td>
           <td style="font-weight: bold" > {{$col_bramin_hh}}</td>
            <td style="font-weight: bold" >{{$col_bramin_m}}</td>
            <td style="font-weight: bold" >{{$col_bramin_f}}</td>
            <td style="font-weight: bold">{{$col_bramin_t}}</td>

            <td style="font-weight: bold">{{$col_janjati_hh}}</td>
            <td style="font-weight: bold">{{$col_janjati_m}}</td>
            <td style="font-weight: bold">{{$col_janjati_f}}</td>
            <td style="font-weight: bold">{{$col_janjati_t}}</td>

            <td style="font-weight: bold">{{$col_dalit_hh}}</td>
            <td style="font-weight: bold">{{$col_dalit_m}}</td>
            <td style="font-weight: bold">{{$col_dalit_f}}</td>
            <td style="font-weight: bold">{{$col_dalit_t}}</td>

            <td style="font-weight: bold">{{$col_muslim_hh}}</td>
           <td style="font-weight: bold"> {{$col_muslim_m}}</td>
            <td style="font-weight: bold">{{$col_muslim_f}}</td>
            <td style="font-weight: bold">{{$col_muslim_t}}</td>

            <td style="font-weight: bold">{{$col_other_hh}}</td>
            <td style="font-weight: bold">{{$col_other_m}}</td>
            <td style="font-weight: bold">{{$col_other_f}}</td>
            <td style="font-weight: bold">{{$col_other_t}}</td>

            <td style="font-weight: bold">{{$row_hh}}</td>
            <td style="font-weight: bold">{{$row_m}}</td>
            <td style="font-weight: bold">{{$row_f}}</td>
            <td style="font-weight: bold">{{$row_t}}</td>
        </tr>
        </tbody>

</table>
