$(() => {
    let showError = function (message) {
        $('.application-error-message').html(message).show()
    }

    let showSuccess = function (message) {
        $('.application-success-message').html(message).show()
    }

    let handleError = function (data) {
        if (typeof data.errors !== 'undefined' && data.errors.length) {
            handleValidationError(data.errors)
        } else {
            if (typeof data.responseJSON !== 'undefined') {
                if (typeof data.responseJSON.errors !== 'undefined') {
                    if (data.status === 422) {
                        handleValidationError(data.responseJSON.errors)
                    }
                } else if (typeof data.responseJSON.message !== 'undefined') {
                    showError(data.responseJSON.message)
                } else {
                    $.each(data.responseJSON, (index, el) => {
                        $.each(el, (key, item) => {
                            showError(item)
                        })
                    })
                }
            } else {
                showError(data.statusText)
            }
        }
    }

    let handleValidationError = function (errors) {
        let message = ''
        $.each(errors, (index, item) => {
            if (message !== '') {
                message += '<br />'
            }
            message += item
        })
        showError(message)
    }

    $(document).on('submit', '.application-form', function (event) {
        event.preventDefault()
        event.stopPropagation()

        const $form = $(this)
        const $button = $form.find('button[type=submit]')

        $('.application-success-message').html('').hide()
        $('.application-error-message').html('').hide()

        $.ajax({
            type: 'POST',
            cache: false,
            url: $form.prop('action'),
            data: new FormData($form[0]),
            contentType: false,
            processData: false,
            beforeSend: () => $button.addClass('button-loading'),
            success: ({ error, message }) => {
                if (!error) {
                    $form[0].reset()
                    $form.find('.application-error-message').hide()
                    showSuccess(message)
                } else {
                    showError(message)
                }

                if (typeof refreshRecaptcha !== 'undefined') {
                    refreshRecaptcha()
                }

                document.dispatchEvent(new CustomEvent('application-form.submitted'))
            },
            error: (error) => {
                if (typeof refreshRecaptcha !== 'undefined') {
                    refreshRecaptcha()
                }
                handleError(error)
            },
            complete: () => $button.removeClass('button-loading'),
        })
    })

    $(document).on('click', '.application-form button', function () {
        const cvFile = $('#cv_file')

        $('.application-success-message').html('').hide()
        $('.application-error-message').html('').hide()

        setTimeout(() => {
            if (cvFile.length && cvFile.val() === '') {
                cvFile.removeClass('is-valid')
            } else {
                cvFile.addClass('is-valid')
            }
        }, 200)

        const $form = $('.application-form')

        setTimeout(() => {
            const isError = $form.find('.invalid-feedback').length

            if (isError > 1) {
                const blockHandlerError = $form.find('.application-error-message')

                let isShow = false

                $form.find('.invalid-feedback').each((index, el) => {
                    if ($(el).text() !== '') {
                        isShow = true
                        blockHandlerError.append(`<p>${$(el).text()}</p>`)
                    }
                })

                if (isShow) {
                    blockHandlerError.show()
                }
            }else {
                $form.find('.application-error-message').hide()
            }

        }, 200)
    })
})
