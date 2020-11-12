@extends('layouts.app')
@section('content')
<div class="content-center">
    <header role="banner">
    <h1><button type="button" class="btn btn-info" data-toggle="modal" data-target="#createModal"><i class="dripicons-plus"></i> Add Directory</button>&nbsp;
    
	  Directory List</h1>
</header>

<div class="container-fluid">
  <div class="row">
  @if(count($directorys)>0)
  <div class="card-deck">
    @foreach($directorys as $directory)
   

      <div class="card">
        <img class="card-img-top" src="//placehold.it/720x350" alt="Card image cap">
        <div class="card-block">
          <h4 class="card-title">{{$directory->name}}</h4>
          <a href="{{ url('directory/search-files') }}"><button type="button" class="btn btn-secondary" ><i class="fa fa-search"> Search Files</i></button></a>&nbsp;
          <a href="{{ url('directory/add-files') }}"><button type="button" class="btn btn-info" ><i class="fa fa-plus"></i> Add Files</button></a>&nbsp;
          <button type="button" class="btn btn-info open-EditDirectoryDialog" data-id="{{$directory->id}}" data-toggle="modal" data-target="#editModal"><i class="fa fa-pencil"> Edit</i></button>&nbsp; <br>
          {!! Form::open(["route" => ["directory.destroy", $directory->id], "method" => "DELETE"]) !!}
          <br><button type="submit" data-id="{{$directory->id}}" class="btn btn-danger" onclick="return confirmDelete()"><i class="fa fa-trash"> Delete </i></button>&nbsp;
          {{ Form::close() }}
          <p class="card-text"><small class="text-muted"></small>&nbsp;</p>
          </div>
      </div>

    @endforeach
    </div>
    <div class="col-12 brand_col my-2 my-md-3">
      {!! $directorys->links() !!}
    </div>
    @else
        <div class="col-12 brand_col my-2 my-md-3">
            No directorys Available
        </div>
    @endif
  </div>
</div>





























</div>

<!-- Create Modal -->
<div id="createModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
    <div role="document" class="modal-dialog">
      <div class="modal-content">
        {!! Form::open(['route' => 'directory.store', 'method' => 'post', 'files' => true]) !!}
        <div class="modal-header">
          <h5 id="exampleModalLabel" class="modal-title">Add Directory</h5>
          <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i class="dripicons-cross"></i></span></button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-12 form-group">
                    <label>Directory Name *</label>
                    {{Form::text('name',null,array('required' => 'required', 'class' => 'form-control', 'placeholder' => 'Type Directory name...'))}}
                </div> 
            </div>
                           
            <div class="form-group">       
              <input type="submit" value="Submit" class="btn btn-primary">
            </div>
        </div>
        {{ Form::close() }}
      </div>
    </div>
</div>

<!-- Edit Modal -->
<div id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
  <div role="document" class="modal-dialog">
    <div class="modal-content">
        {{ Form::open(['route' => ['directory.update', 1], 'method' => 'PUT', 'files' => true] ) }}
        <input type="hidden" name="directory_id">
      <div class="modal-header">
        <h5 id="exampleModalLabel" class="modal-title">Update Directory</h5>
        <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i class="dripicons-cross"></i></span></button>
      </div>
      <div class="modal-body">
        <div class="row">
            <div class="col-md-12 form-group">
                <label>Directory Name *</label>
                {{Form::text('name',null, array('required' => 'required', 'class' => 'form-control'))}}
            </div>
        </div>
            
        <div class="form-group">       
            <input type="submit" value="Update" class="btn btn-primary">
          </div>
        </div>
      {{ Form::close() }}
    </div>
  </div>
</div>
@endsection

@section('footer-script')
<script type="text/javascript">

    $(document).on("click", ".open-EditDirectoryDialog", function(){
          var url ="directory/";
          var id = $(this).data('id').toString();
          url = url.concat(id).concat("/edit");
          
          
          $.get(url, function(data){
            $("#editModal input[name='directory_id']").val(data['id']);
            $("#editModal input[name='name']").val(data['name']);
          });
    });

    function confirmDelete() {
      if (confirm("If you delete directory, all files inside this directory will also be deleted. Are you sure want to delete ?")) {
          return true;
      }
      return false;
    }
    
    //Check numeric value
    $(".check_numeric").keydown(function (event) {
        if ((event.keyCode >= 48 && event.keyCode <= 57) ||
        (event.keyCode >= 96 && event.keyCode <= 105) ||
        event.keyCode == 8 || event.keyCode == 9 || event.keyCode == 37 ||
        event.keyCode == 39 || event.keyCode == 46 || event.keyCode == 190)
        {

        }
        else
        {
        event.preventDefault();
        }

   });
    
</script>
@endsection