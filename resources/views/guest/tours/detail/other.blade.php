<div class="addon">
    <div class="block-tour-header">
        <ul class="nav nav-pills justify-content-center" id="pills-description-single-tour" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link text-uppercase active" id="pills-includes-tab" data-bs-toggle="pill"
                    data-bs-target="#pills-includes" type="button" role="tab" aria-controls="pills-includes"
                    aria-selected="true">@lang('messages.bao_gom')</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link text-uppercase" id="pills-excludes-tab" data-bs-toggle="pill"
                    data-bs-target="#pills-excludes" type="button" role="tab" aria-controls="pills-excludes"
                    aria-selected="false">@lang('messages.khong_bao_gom')</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link text-uppercase" id="pills-terms-tab" data-bs-toggle="pill"
                    data-bs-target="#pills-terms" type="button" role="tab" aria-controls="pills-terms"
                    aria-selected="false">@lang('messages.dieu_khoan')</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link text-uppercase" id="pills-notice-tab" data-bs-toggle="pill"
                    data-bs-target="#pills-notice" type="button" role="tab" aria-controls="pills-notice"
                    aria-selected="false">@lang('messages.luu_y')</button>
            </li>
        </ul>
    </div>
    <div class="block-tour-content">
        <div class="tab-content" id="pills-description-single-tour-content">
            <div class="tab-pane fade show active single-tour-content" id="pills-includes" role="tabpanel"
                aria-labelledby="pills-includes-tab" tabindex="0">
                {!! $item->include !!}
            </div>
            <div class="tab-pane fade single-tour-content" id="pills-excludes" role="tabpanel"
                aria-labelledby="pills-excludes-tab" tabindex="0">
                {!! $item->exclude !!}
            </div>
            <div class="tab-pane fade single-tour-content" id="pills-terms" role="tabpanel"
                aria-labelledby="pills-excludes-tab" tabindex="0">
                {!! $item->term !!}
            </div>
            <div class="tab-pane fade single-tour-content" id="pills-notice" role="tabpanel"
                aria-labelledby="pills-excludes-tab" tabindex="0">
                {!! $item->notice !!}
            </div>
        </div>
    </div>
</div>
