@extends('layouts/contentLayoutMaster')

@section('title', 'CADASTRO DE ESCOLARIDADE')

@section('content')
<!-- chamados list start -->
<section class="app-chamado-list">
    <div class="row" style="align-content: space-between; justify-content: space-between;">
        
        <!-- list and filter start -->
        <div class="card">
            <div class="card-datatable table-responsive pt-0">
            <section id="multiple-column-form">
  <div class="row">
    <div class="col-12">
      <div class="card">
            <div class="card-header">
            <h4 class="card-title">REMOVER ESCOLARIDADE?</h4>
            </div>
            <div class="card-body">
                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                <input type="hidden" name="id" value="{{$escolaridade->id}}" />
                <div class="row">
                <div class="col-md-6 col-12">
                    <div class="mb-1">
                    <label class="form-label" for="first-name-column">Deseja Remover o Registro {{$escolaridade->descricao}}</label>
                    
                    </div>
                </div>
                <div class="col-12">
                    <a href="/escolaridades/delete/{{$escolaridade->id}}" type="submit" class="btn btn-primary me-1">DESEJO EXCLUIR</a>
                    <a href="/escolaridades" class="btn btn-outline-secondary">Voltar</a>
                </div>
                </div>
            </div>
        </div>
        </div>
    </div>
    </section>
            </div>
        </div>
        <!-- Modal to add new user Ends-->
    </div>
  <!-- list and filter end -->
</section>
<!-- chamado list ends -->
@endsection

@section('page-script')
@endsection