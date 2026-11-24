 <table class="table table-striped table-bordered table-hover table-responsive">
                                     <thead>
                                          <tr>
                                                <th>Present Status</th>
                                                <th>From socioeconomic study</th>
                                                <th>After completion</th>
                                                
                                            </tr>
                                     </thead>
                                     <tbody>
                                         <tr>
                                             <th>Private connection</th>
                                             <td>  {!! Form::number('before[private_conn]',null,['class'=>'form-control']) !!}</td>

                                             <td>  {!! Form::number('after[private_conn]',null,['class'=>'form-control']) !!}</td>
                                         </tr>
                                         <tr>
                                             <th>Public tap stand</th>
                                             <td>  {!! Form::number('before[public_tap]',null,['class'=>'form-control']) !!}</td>
                                             <td>  {!! Form::number('after[public_tap]',null,['class'=>'form-control']) !!}</td>
                                         </tr>
                                         <tr>
                                             <th>Source </th>
                                             <td>  {!! Form::number('before[source]',null,['class'=>'form-control']) !!}</td>
                                             <td>  {!! Form::number('after[source]',null,['class'=>'form-control']) !!}</td>
                                         </tr>
                                         <tr>
                                             <th>Average time spent to fetch water, min</th>
                                             <td>  {!! Form::number('before[average_time]',null,['class'=>'form-control']) !!}</td>
                                             <td>  {!! Form::number('after[average_time]',null,['class'=>'form-control']) !!}</td>
                                         </tr>
                                         <tr>
                                             <th>Per capita availability, lpcd</th>
                                             <td>  {!! Form::number('before[per_capita]',null,['class'=>'form-control']) !!}</td>
                                             <td>  {!! Form::number('after[per_capita]',null,['class'=>'form-control']) !!}</td>
                                         </tr>
                                         <tr>
                                             <th>Quality</th>
                                             <td>  {!! Form::number('before[quality]',null,['class'=>'form-control']) !!}</td>
                                             <td>  {!! Form::number('after[quality]',null,['class'=>'form-control']) !!}</td>
                                         </tr>
                                         <tr>
                                             <th>Public Toilets</th>
                                             <td>  {!! Form::number('before[public_toilet]',null,['class'=>'form-control']) !!}</td>
                                             <td>  {!! Form::number('after[public_toilet]',null,['class'=>'form-control']) !!}</td>
                                         </tr>
                                         <tr>
                                             <th>Water seal cistern flush</th>
                                             <td>  {!! Form::number('before[water_seal]',null,['class'=>'form-control']) !!}</td>
                                             <td>  {!! Form::number('after[water_seal]',null,['class'=>'form-control']) !!}</td>
                                         </tr>
                                         <tr>
                                             <th>VIP</th>
                                             <td>  {!! Form::number('before[vip]',null,['class'=>'form-control']) !!}</td>
                                             <td>  {!! Form::number('after[vip]',null,['class'=>'form-control']) !!}</td>
                                         </tr>
                                         <tr>
                                             <th>Pit Latrine</th>
                                             <td>  {!! Form::number('before[pit_latrine]',null,['class'=>'form-control']) !!}</td>
                                             <td>  {!! Form::number('after[pit_latrine]',null,['class'=>'form-control']) !!}</td>
                                         </tr>
                                         <tr>
                                             <th>None</th>
                                             <td>  {!! Form::number('before[none]',null,['class'=>'form-control']) !!}</td>
                                             <td>  {!! Form::number('after[none]',null,['class'=>'form-control']) !!}</td>
                                         </tr>
                                     </tbody>

                                </table>