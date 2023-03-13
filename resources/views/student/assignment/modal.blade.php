<div class="modal fade" id="submissionModal" tabindex="-1" role="dialog" aria-labelledby="submitAssignment" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="submitAssignment">Upload Submission</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="{{route('class.assignment.submit')}}" enctype="multipart/form-data" >
                @csrf
                <input type="hidden" name="id" value="{{$assignment->id}}">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="submission">Upload a file</label>
                        <input type="file" class="form-control-file" id="submission" name="file">
                    </div>
                    <div class="form-group">
                        <label for="note">Write a note</label>
                        <textarea class="form-control" id="submission" name="note" rows="3"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
