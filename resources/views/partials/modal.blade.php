<div class="modal fade" id="deleteProject-{{$project->id}}" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId-{{$project->id}}" aria-hidden="true">
      <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm" role="document">
            <div class="modal-content">
                  <div class="modal-header">
                        <h5 class="modal-title" id="modalTitleId-{{$project->id}}">Delete project</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                        Stai per cancellare definitivamente un progetto, sei sicuro?
                  </div>
                  <div class="modal-footer">
                        <form action="{{route('admin.projects.destroy', $project->id)}}" method="post">
                              @csrf
                              @method('DELETE')
                              <button type="submit" class="btn btn-danger">
                                    Conferma
                              </button>
                        </form>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annulla</button>
                  </div>
            </div>
      </div>
</div>