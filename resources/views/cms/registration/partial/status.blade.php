<div class="modal fade" id="statusModal-{{ $data->id }}" tabindex="-1" aria-labelledby="deleteModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-bottom-0 py-2">
                <h5 class="modal-title">Update Status</h5>
                <a href="javascript:;" class="primaery-menu-close" data-bs-dismiss="modal">
                    <i class="material-icons-outlined">close</i>
                </a>
            </div>
            <form action="{{ route('registrations.status', $data->id) }}" method="POST">
                <div class="modal-body">
                    <div class="col-md-12">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-select mb-3" aria-label="Default select example" id="status" name="status">
                            <option selected disabled>--- Select Status ---</option>
                            <option value="pending" {{ $data->status == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="treating" {{ $data->status == 'treating' ? 'selected' : '' }}>Treating</option>
                            <option value="completed" {{ $data->status == 'completed' ? 'selected' : '' }}>Completed</option>
                            <option value="cancelled" {{ $data->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer border-top-0">
                    @csrf
                    @method('PUT')
                    <button type="submit" class="btn btn-info">Update</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>