@extends('backend.layouts.adminlte')
@section('content')
    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <a class="btn btn-info" href="/backend/vote">
                Back
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
                          Vote
                      </th>
                      <th style="width: 30%">
                          Player
                      </th>
                      <th>
                          Phone
                      </th>
                      <th>
                          Create_at
                      </th>
                      <th style="width: 20%">
                      </th>
                  </tr>
              </thead>
              <tbody>
                @foreach($voteLogs as $voteLog)
                  <tr>
                      <td>
                          {{ $voteLog->id }}
                      </td>
                      <td>
                          {{ $voteLog->vote_id }}
                      </td>
                      <td>
                          {{ $voteLog->player->name }}
                      </td>
                      <td>
                          {{ $voteLog->phone }}
                      </td>
                      <td>
                          {{ $voteLog->created_at }}
                      </td>
                      <td class="project-actions text-right">
                          <a class="btn btn-info btn-sm" href="">
                              <i class="fas fa-pencil-alt">
                              </i>
                              Check
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
                  {{ $voteLogs->links() }}
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