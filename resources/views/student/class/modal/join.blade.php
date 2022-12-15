<div class="modal fade" id="joinClass" tabindex="-1" role="dialog" aria-labelledby="joinClassLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="joinClassLabel">Join Class</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="{{route('class.join')}}">
                <div class="modal-body">
                    @csrf
                    <div class="form-group">
                        <label for="classCode">Class Code</label>
                        <input type="text" class="form-control" id="classCode" name="code" placeholder="Enter class code">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Join</button>
                </div>
            </form>
        </div>
    </div>
</div>
