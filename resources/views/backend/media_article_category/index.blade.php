@extends('backend.layouts.adminlte')
@section('content')
    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <a class="btn btn-info" href="/backend/media-article-category/create">
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
                          Category Name
                      </th>
                      <th style="width: 30%">
                          Category Name EN
                      </th>
                      <th>
                          Sort Order
                      </th>
                      <th style="width: 8%" class="text-center">
                          Status
                      </th>
                      <th style="width: 20%">
                      </th>
                  </tr>
              </thead>
              <tbody>
                @foreach($articleCategories as $articleCategory)
                  <tr>
                      <td>
                          {{ $articleCategory->id }}
                      </td>
                      <td>
                          {{ $articleCategory->name }}
                      </td>
                      <td>
                          {{ $articleCategory->name_en }}
                      </td>
                      <td>
                          {{ $articleCategory->sort }}
                      </td>
                      <td class="project-state">
                          @if($articleCategory->is_publish)
                            <span class="badge badge-success">ON</span>
                          @else
                            <span class="badge badge-warning">OFF</span>
                          @endif
                      </td>
                      <td class="project-actions text-right">
                          <a class="btn btn-info btn-sm" href="/backend/media-article-category/edit/{{ $articleCategory->id }}">
                              <i class="fas fa-pencil-alt">
                              </i>
                              Edit
                          </a>
                          <a class="btn btn-danger btn-sm" href="javascript:if(confirm('确定要删除吗？'))location='/backend/media-article-category/delete/{{ $articleCategory->id }}'">
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
                  {{ $articleCategories->links() }}
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