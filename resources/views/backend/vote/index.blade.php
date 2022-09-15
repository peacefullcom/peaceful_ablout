@extends('backend.layouts.adminlte')
@section('content')
    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <a class="btn btn-info" href="/backend/vote/create">
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
                          Title
                      </th>
                      <th style="width: 30%">
                          Start_at - End_at
                      </th>
                      <th>
                          vote_count
                      </th>
                      <th>
                          view_count
                      </th>
                      <th>
                          player_count
                      </th>
                      <th style="width: 20%">
                      </th>
                  </tr>
              </thead>
              <tbody>
                @foreach($votes as $vote)
                  <tr>
                      <td>
                          {{ $vote->id }}
                      </td>
                      <td>
                          {{ $vote->title }}
                      </td>
                      <td>
                          {{ $vote->start_at }} - {{ $vote->end_at }}
                      </td>
                      <td>
                          {{ $vote->vote_count }}
                      </td>
                      <td>
                          {{ $vote->view_count }}
                      </td>
                      <td>
                          {{ $vote->player_count }}
                      </td>
                      <td class="project-actions text-right">
                          <a class="btn btn-success btn-sm" href="/backend/vote-player/{{ $vote->id }}">
                              <i class="fas fa-user-alt">
                              </i>
                              Player
                          </a>
                          <a class="btn btn-primary btn-sm" href="/backend/vote-log/{{ $vote->id }}">
                              <i class="fas fa-copy">
                              </i>
                              Log
                          </a>
                          <a class="btn btn-info btn-sm" href="/backend/vote/edit/{{ $vote->id }}">
                              <i class="fas fa-pencil-alt">
                              </i>
                              Edit
                          </a>
                          <a class="btn btn-danger btn-sm" href="javascript:if(confirm('确定要删除吗？'))location='/backend/vote/delete/{{ $vote->id }}'">
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
                  {{ $votes->links() }}
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