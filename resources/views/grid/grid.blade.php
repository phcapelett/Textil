@extends('menuVertical')


<link rel="stylesheet" type="text/css" href="{{asset('css/vue-select.css')}}">

@section('content')

    <Grid 
        :obj="{{json_encode($obj)}}" 
        :namemodal="{{json_encode($nameModal)}}" 
        :json="{{json_encode($json)}}" 
        :lista="{{json_encode($lista)}}"
        auth="{{json_encode(json_decode(@$auth))}}"
    />
    <template v-slot:form>
        {!!  \App\Utils\Functions::montaFormulario($obj->classebase,$obj->classebase.'.json',$nameModal, $obj) !!} 
    </template>

@endsection


<script src="{{ asset('js/jquery.min.js') }}"></script>