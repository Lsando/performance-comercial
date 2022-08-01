<!DOCTYPE html>
<html lang="en">
    <head>
    <title>Bootstrap Theme Company</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"> </script>
    <link href="{{asset('assets/css/bootstrap-duallistbox.css')}}" rel="stylesheet" />
    <style>
        .chart-container{
            width: 100%;
            max-width: 1024px;
            height: 100%;
            max-height: 600px;
            position: relative;
            display: flex;
            margin-right:-120px;
        }
    </style>
    
    <script src="{{asset('assets/js/jquery.bootstrap-duallistbox.js')}}"></script>
    <script src="{{asset('assets/js/jquery.bootstrap-duallistbox.min.js')}}"></script>
    <meta name="csrf_token" content="{{ csrf_token() }}" />
    </head>
    <body>
        <div class="container">

            <div class="row">
                <div class="col-md-6">
                    <label for="" class="col-md-4 control-label">Data inicial</label>
                    <div class="col-md-8">
                        <input type="date" class="form-control"  id="start_date">
                    </div>
                </div>
                <div class="col-md-6">
                    <label for="" class="col-md-4 control-label">Data final</label>
                    <div class="col-md-8">
                        <input type="date" class="form-control" id="final_date">
                    </div>
                </div>
                
                <div class="col-sm-9">
                    <select multiple="multiple" size="10" name="duallistbox_demo1" id="lista_usuarios">
                        @foreach ($users  as $user)
                            <option value="{{$user->co_usuario}}">{{$user->no_usuario}}</option>
                        @endforeach
                    </select>
                
                </div>
                <div class="col-sm-3">
                    <div class="row" style="margin-top: 25px">
                        <button type="button" class="btn btn-default" onclick="reports()"  >Relátorio</button>
                    </div>
                    <div class="row" style="margin-top: 25px">
                        <button type="button" class="btn btn-default" onclick="pizza_report()"  >Pizza</button>
                    </div>
                </div>
            
            </div>
            <div class="row">
                <div id="relatorios">
                    
                </div>
                <div class="chart-container">

                    <canvas id="pizza_report" style=""></canvas>
                </div>
            </div>
        </div>
        {{--  --}}
        <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@0.7.0"></script>
        <script src="{{asset('assets/js/chart.js')}}"></script>
        <script>
            var dualList = $('[name=duallistbox_demo1]').bootstrapDualListbox();
            
            $('[name=duallistbox_demo1]').bootstrapDualListbox({

            // default text
                filterTextClear: 'Mostrar todos',
                filterPlaceHolder: 'Filtro',
                moveSelectedLabel: 'Mover',
                moveAllLabel: 'Move todos',
                removeSelectedLabel: 'Remover',
                removeAllLabel: 'Remover todos',

  
                                                        
            });
            function reports(){
                var users = $('#lista_usuarios').val();

                let data_inicio = $('#start_date').val();
                let data_final = $('#final_date').val();

                $.ajax({
                    url: '{{route("get_report")}}',
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        users: users,
                        _token: "{{ csrf_token() }}",
                        start_date: data_inicio,
                        end_date: data_final,
                    },
                    dataType: "json",
                    success: function(response){
                        var res = response;
                        var table = '';
                        for(let i in res){
                            // console.log(res[i].data[0]);
                            table += `<div class="table-responsive">
                            <table class="table table-bordered">
                            <thead>
                              <tr>
                                <th scope="col">${res[i].data[0].consultor}</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <th scope="row">Periodo</th>
                                <th scope="row">Receita liquida</th>
                                <th scope="row">Custo fixo</th>
                                <th scope="row">Comissão</th>
                                <th scope="row">Lucro</th>
                              </tr>`;
                            var data = res[i].data;
                            for(let j in data){
                                // console.log(data[j].receita);
                                var lucro = data[j].receita_liquida - (data[j].custo_fixo + data[j].comissao);
                                table += `<tr>
                                    <td>${data[j].periodo}</td>
                                    <td>${data[j].receita_liquida}</td>
                                    <td>${data[j].custo_fixo}</td>
                                    <td>${data[j].comissao}</td>
                                    <td>${data[j].lucro}</td>
                                    
                                </tr>`;
                            }
                              
                              table += '</tbody></table></div>';
                            ;
                            
                        }
                        $('#relatorios').append(table);
                    }
                });
            }

            function pizza_report(){

                var users = $('#lista_usuarios').val();

                let data_inicio = $('#start_date').val();
                let data_final = $('#final_date').val();

                $.ajax({
                    url: '{{route("pizza_report")}}',
                    type: 'POST',
                    dataType: "json",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        users: users,
                        _token: "{{ csrf_token() }}",
                        start_date: data_inicio,
                        end_date: data_final,
                    },
                    success: function(response){
                        // console.log(response.x_values);
                        drawPieChart(response.x_values, response.y_values, 'pizza_report', response.total, response.total);

                        
                    }
                });
            }

        </script>
    </body>
</html>