@extends('layouts/contentLayoutMaster')

@section('title', 'CADASTRO TIPO DE DEPENDENTES')

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
            <h4 class="card-title">Inclusão Tipo de Dependentes</h4>
            </div>
            <div class="card-body">
            <form class="form" method="post" action="/tipodependentes/add">
                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                <input type="hidden" name="id" value="{{$tipodependente->id}}" />
                <div class="row">
                <div class="col-md-6 col-12">
                    <div class="mb-1">
                    <label class="form-label" for="first-name-column">Código</label>
                    <input
                        type="text"
                        id="codigo"
                        class="form-control"
                        placeholder="Código TIPO"
                        name="codigo"
                        value="{{$tipodependente->codigo}}"
                    />
                    </div>
                </div>
                <div class="col-md-6 col-12">
                    <div class="mb-1">
                    <label class="form-label" for="first-name-column">Descrição</label>
                    <input
                        type="text"
                        id="descricao"
                        class="form-control"
                        placeholder="Descrição TIPO"
                        name="descricao"
                        value="{{$tipodependente->descricao}}"
                    />
                    </div>
                </div>
                <div class="col-md-6 col-12">
                    <div class="mb-1">
                    <label class="form-label" for="first-name-column">Status</label>
                    <input
                        type="text"
                        id="status"
                        class="form-control"
                        placeholder="Status"
                        name="status"
                        value="{{$tipodependente->status}}"
                    />
                    </div>
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-primary me-1">Salvar</button>
                    <button type="reset" class="btn btn-outline-secondary">Reset</button>
                </div>
                </div>
            </form>
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