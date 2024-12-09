<section class="contact__area shortcode-contact-form">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-12">
                <div class="contact__form-wrap">
                    @if ($formTitle = $shortcode->form_title)
                        <h2 class="title">{!! BaseHelper::clean($formTitle) !!}</h2>
                    @endif

                    @if ($formDescription = $shortcode->form_description)
                        <p class="truncate-2-custom">{!! BaseHelper::clean($formDescription) !!}</p>
                    @endif

                    {!! $form
                        ->setFormInputClass('')
                        ->setFormInputWrapperClass('form-grp mb-3')
                        ->setFormLabelClass('form-label')
                        ->renderForm()
                    !!}
                    <p class="ajax-response mb-0"></p>
                </div>
            </div>
        </div>
    </div>
</section>
