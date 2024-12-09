<?php

return [
    'name' => 'plugins/applications::application.settings.email.title',
    'description' => 'plugins/applications::application.settings.email.description',
    'templates' => [
        'application-notice' => [
            'title' => 'plugins/applications::application.settings.email.templates.notice_title',
            'description' => 'plugins/applications::application.settings.email.templates.notice_description',
            'subject' => 'plugins/applications::application.settings.email.templates.subject',
            'can_off' => true,
            'variables' => [
                'application_name' => 'plugins/applications::application.settings.email.templates.application_name',
                'application_email' => 'plugins/applications::application.settings.email.templates.application_email',
                'application_phone' => 'plugins/applications::application.settings.email.templates.application_phone',
                'application_address' => 'plugins/applications::application.settings.email.templates.application_address',
            ],
        ],

        'application-sender-confirmation' => [
            'title' => 'plugins/applications::application.settings.email.templates.sender_confirmation_title',
            'description' => 'plugins/applications::application.settings.email.templates.sender_confirmation_description',
            'subject' => 'plugins/applications::application.settings.email.templates.sender_confirmation_subject',
            'can_off' => true,
            'enabled' => false,
            'variables' => [
                'application_name' => 'plugins/applications::application.settings.email.templates.application_name',
                'application_email' => 'plugins/applications::application.settings.email.templates.application_email',
                'application_phone' => 'plugins/applications::application.settings.email.templates.application_phone',
                'application_address' => 'plugins/applications::application.settings.email.templates.application_address',
            ],
        ],
    ],
];
