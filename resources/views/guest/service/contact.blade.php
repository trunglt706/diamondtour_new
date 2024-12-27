<div class="widget_form_contact_style_3">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-9">
                <h1 class="title">@lang('messages.service.mau_thong_tin')</h1>
                <p class="description">@lang('messages.service.mau_thong_tin_des')</p>
                <form method="POST" action="{{ route('demo.contact.create') }}">
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-6">
                            <input type="text" placeholder="@lang('messages.contact.ho')" class="form-control" id="your-name"
                                name="first_name">
                        </div>
                        <div class="col-md-6">
                            <input type="text" placeholder="@lang('messages.contact.name') *" class="form-control"
                                id="your-surname" name="last_name" required>
                        </div>
                        <div class="col-md-6">
                            <input type="email" placeholder="@lang('messages.email_address') *" class="form-control" id="your-email"
                                name="email" required>
                        </div>
                        <div class="col-md-6">
                            <input type="text" placeholder="@lang('messages.phone') *" class="form-control"
                                id="your-subject" name="your-subject" required>
                        </div>
                        <div class="col-12">
                            <textarea placeholder="@lang('messages.service.de_lai_yeu_cau') *" class="form-control" id="your-message" name="comment" rows="5"
                                required></textarea>
                        </div>
                        <div class="col-12">
                            <div class="row">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-submit">@lang('messages.service.gui_yeu_cau')</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
