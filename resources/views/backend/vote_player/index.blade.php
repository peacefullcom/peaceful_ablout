@extends('backend.layouts.adminlte')
@section('content')
    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <a class="btn btn-info" href="/backend/vote-player/create/{{ $vote->id }}">
                Create
          </a>
        </div>
        <div class="card-body p-0">
          <table class="table table-striped projects">
              <thead>
                  <tr>
                      <th style="width: 1%">
                          ID
                      </th>
                      <th style="width: 20%">
                          Code
                      </th>
                      <th style="width: 30%">
                          Name
                      </th>
                      <th>
                          Img
                      </th>
                      <th>
                          Vote_count
                      </th>
                      <th>
                          Sort
                      </th>
                      <th>
                          is_active
                      </th>
                      <th style="width: 20%">
                      </th>
                  </tr>
              </thead>
              <tbody>
                @foreach($votePlayers as $votePlayer)
                  <tr>
                      <td>
                          {{ $votePlayer->id }}
                      </td>
                      <td>
                          {{ $votePlayer->code }}
                      </td>
                      <td>
                          {{ $votePlayer->name }}
                      </td>
                      <td>
                          {{ $votePlayer->img }}
                      </td>
                      <td>
                          {{ $votePlayer->vote_count }}
                      </td>
                      <td>
                          {{ $votePlayer->sort }}
                      </td>
                      <td class="project-state">
                          @if($votePlayer->is_active)
                            <span class="badge badge-success">ON</span>
                          @else
                            <span class="badge badge-warning">OFF</span>
                          @endif
                      </td>
                      <td class="project-actions text-right">
                          <a class="btn btn-info btn-sm" href="/backend/vote-player/edit/{{ $votePlayer->id }}">
                              <i class="fas fa-pencil-alt">
                              </i>
                              Edit
                          </a>
                          <a class="btn btn-danger btn-sm" href="javascript:if(confirm('确定要删除吗？'))location='/backend/vote-player/delete/{{ $votePlayer->id }}'">
                              <i class="fas fa-trash">
                              </i>
                              Delete
                          </a>
                      </td>
                  </tr>
                  @endforeach
              </tbody>
          </table>
          
        </div>
        <!-- /.card-body -->
        <div class="card-footer">   
            <div class="text-center">
                  {{ $votePlayers->links() }}
            </div>
        </div>

      <!-- /.card -->
    </section>
    <!-- /.content -->
<!-- warningModal start -->
    <div class="modal fade" id="warningModal" tabindex="-1">
     <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title text-danger">Warning</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body text-danger" id='warningText'>
            
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal" id='stop'>No</button>
          <button type="button" class="btn btn-primary" id='continue'>Yes</button>
        </div>
        
      </div>
    </div> 
    
  </div> 
<!-- warningModal end -->


@stop

@section('script')
<script>
function deleteClick(id, name) {
    
}


</script>

@stop