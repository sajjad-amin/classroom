<div class="modal fade" id="newPost" tabindex="-1" role="dialog" aria-labelledby="postModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="postModalTitle">Create Post</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="theme-form" method="post" action="{{route('dashboard.post.create')}}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" value="{{$course->id}}">
                <input type="hidden" name="section" value="{{$section}}">
                <div class="modal-body">
                    <div class="modal-body">
                        <div class="mb-3">
                            <textarea name="text" rows="5" class="form-control" placeholder="Type here..." required></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="col-form-label pt-0" for="image">Add File</label>
                            <input name="image" class="form-control" id="image" type="file">
                        </div>
                        <div class="m-3">
                            <img id="imageDisplay" class="img-fluid" src="{{asset('images/dummy-image.webp')}}" alt="">
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
