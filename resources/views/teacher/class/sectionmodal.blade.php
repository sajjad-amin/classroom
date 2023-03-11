<div class="modal fade" id="newSection" tabindex="-1" role="dialog" aria-labelledby="postModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="postModalTitle">Create Section</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="theme-form" method="post" action="{{route('dashboard.class.section.add',['id' => $course->id])}}" >
                @csrf
                <div class="modal-body">
                    <div class="modal-body">
                        <div class="mb-3">
                            <input name="name" class="form-control" id="name" type="text" placeholder="Section Name">
                        </div>
                        <div class="mb-3">
                            <textarea name="description" class="form-control" id="description" rows="3" placeholder="Description"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <input type="submit" class="btn btn-primary" value="Create" />
                </div>
            </form>
        </div>
    </div>
</div>
