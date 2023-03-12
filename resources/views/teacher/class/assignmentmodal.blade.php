<div class="modal fade" id="newAssignment" tabindex="-1" role="dialog" aria-labelledby="assignmentmodalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="assignmentmodalTitle">Create Assignment</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="theme-form" method="post" enctype="multipart/form-data" action="{{route('dashboard.assignment.create')}}" >
                @csrf
                <input type="hidden" name="course_id" value="{{$course->id}}" />
                <input type="hidden" name="teacher_id" value="{{Auth::user()->id}}" />
                <input type="hidden" name="section" value="{{$section}}" />
                <div class="modal-body">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="title" class="col-form-label">Assignment Title:</label>
                            <input name="title" class="form-control" id="title" type="text" placeholder="Assignment Title" required>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="col-form-label">Description:</label>
                            <textarea name="description" class="form-control" id="description" rows="3" placeholder="Description" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="due_date" class="col-form-label">Due Date:</label>
                            <input name="due_date" class="form-control" id="due_date" type="datetime-local" placeholder="Due Date" required>
                        </div>
                        <div class="mb-3">
                            <label for="points" class="col-form-label">Points:</label>
                            <select name="points" class="form-control" id="points" required>
                                @for($i=1;$i<=100;$i++)
                                    <option value="{{$i}}">{{$i}}</option>
                                @endfor
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="attachment" class="col-form-label">Upload Attachment:</label>
                            <input name="attachment" class="form-control" id="attachment" type="file" placeholder="Upload Attachment" required>
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
