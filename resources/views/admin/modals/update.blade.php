<div class="modal modal-right large fade" id="updateAdmin{{ $user->id }}" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Update Administrator</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ url('admin/'.$user->id.'/update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row g-3">
                        <input type="hidden" name="user_id" value="{{ $user->id }}">
                        <div class="col-md-12">
                            <label class="mb-3 top-label">
                                <input class="form-control" type="text" name="name" value="{{ $user->name }}" />
                                <span>FULL NAME</span>
                            </label>
                        </div>
                        <div class="col-md-12">
                            <label class="mb-3 top-label">
                                <input class="form-control" type="text" name="email" value="{{ $user->email }}" />
                                <span>EMAIL</span>
                            </label>
                        </div>
                        <div class="col-md-12">
                            <label class="mb-3 top-label">
                                <input class="form-control" type="password" name="password" />
                                <span>PASSWORD</span>
                            </label>
                        </div>
                        <div class="col-md-12">
                            <label class="mb-3 top-label">
                                <input class="form-control" type="password" name="password_confirmation" />
                                <span>PASSWORD CONFIRMATION</span>
                            </label>
                        </div>
                        <div class="col-md-12">
                            <label class="mb-3 top-label">
                                <select name="role_id" id="role{{ $user->id }}" class="form-control">
                                    <option value="">Pilih Role</option>
                                    @foreach ($roles as $role)
                                        @if ($role->id == 6)
                                            @continue
                                        @endif
                                        <option value="{{ $role->id }}" {{ $role->name === $user->getRoleNames()->first() ? 'selected' : '' }}>{{ $role->name }}</option>
                                    @endforeach
                                </select>
                                <span>CHOOSE ROLE (change the role first)</span>
                            </label>
                        </div>
                        <div class="col-md-12">
                            <label class="mb-3 top-label">
                                <select name="parent_id" id="parent{{ $user->id }}" class="form-control">
                                    <option label="&nbsp;"></option>
                                </select>
                                <span>CHOOSE PARENT</span>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Create</button>
                </div>
            </form>
        </div>
    </div>
</div>
