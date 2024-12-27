<div class="card mb-3">
    <div class="card-body">
        <form action="{{ route('user.user.update') }}" method="post" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="type" value="all">
            <input type="hidden" name="id" value="{{ $user->id }}">
            <div class="row">
                <div class="col-md-6 mb-2 form-group">
                    <label class="col-form-label">Tên <span class="text-danger fw-900">*</span></label>
                    <input type="text" class="form-control" value="{{ $user->name }}" name="name">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-6 col-sm-12 mb-2">
                    <label class="col-form-label">Điện thoại </label>
                    <input type="text" class="form-control update-phone" value="{{ $user->phone }}" name="phone">
                </div>
                <div class="col-md-6 col-sm-12 mb-2">
                    <label class="col-form-label">Email </label>
                    <input type="text" class="form-control update-email" value="{{ $user->email }}" name="email">
                </div>
            </div>
            <div class="pb-4">
                {!! NoCaptcha::display() !!}
            </div>
            <button type="submit" class="btn bg-gradient-cyan-blue btn-create text-white">
                <i class="fas fa-save"></i> Cập nhật
            </button>
        </form>
    </div>
</div>
@push('js')
    @include('user.pages.user.detail.script.info')
@endpush
