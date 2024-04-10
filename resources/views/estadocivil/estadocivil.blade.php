@extends('layouts/contentLayoutMaster')

@section('title', 'CADASTRO ESTADO CIVIL')

@section('content')
<!-- chamados list start -->
<div class="d-grid gap-2 d-md-flex justify-content-md-end">
    <a href="/estadocivil/add" class="btn btn-lg btn-success btn-round btn-sm waves-effect waves-float waves-light">
        Inserir
    </a>
</div>
<section class="app-chamado-list">
    <div class="row" style="align-content: space-between; justify-content: space-between;">
        <!-- list and filter start -->
        <div class="card">
            <!-- <div class="card-body border-bottom">
                <h4 class="card-title">Buscar & Filtros</h4>
                <div class="row">
                    <div class="col-md-4 user_role"></div>
                    <div class="col-md-4 user_plan"></div>
                    <div class="col-md-4 user_status"></div>
                </div>
            </div> -->
            
            <div class="card-datatable table-responsive pt-0">
            <table class="user-list-table table">
                <thead class="table-light">
                <tr>
                    <th></th>
                    <th>id</th>
                    <th>codigo</th>
                    <th>descrição</th>
                    <th>status</th>
                    <th>Dt Criação</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                  @if(sizeof($lista) > 0)
                    @foreach($lista as $c)
                    <tr>
                        <td></td>
                        <td>{{$c->id}}</td>
                        <td>{{$c->codigo}}</td>
                        <td>{{$c->descricao}}</td>
                        <td>{{$c->status}}</td>
                        <td>{{$c->created_at}}</td>
                        <td>
                            <a href="/estadocivil/edit/{{$c->id}}" class="btn btn-sm btn-warning">Editar</a>
                            <a href="/estadocivil/remover/{{$c->id}}" class="btn btn-sm btn-danger">Remover</button>
                        </td>
                    </tr>
                    @endforeach
                  @endif
                </tbody>

            </table>
            </div>
            <!-- Modal to add new user starts-->
        </div>
        <!-- Modal to add new user Ends-->
    </div>
  <!-- list and filter end -->
</section>
<!-- chamado list ends -->
@endsection

@section('page-script')
@endsection