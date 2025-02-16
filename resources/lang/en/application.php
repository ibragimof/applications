<?php

return [
    'name' => 'Applications',
    'application_information' => 'Application Information',
    'shortcode_name' => 'Application Form',
    'shortcode_description' => 'Display application form',
    'edit' => 'View Application',
    'reply_subject' => 'Applied application',
    'message_sent_success' => 'Message sent successfully',
    'comments' => 'Comments',
    'comment' => 'Comment',
    'no_comments' => 'No comments',
    'new_application_notice' => 'You have <span class="bold">:count</span> New Applications',
    'dropdown_show_label' => 'Show Applications',
    'view_all' => 'View all',
    'send' => 'Send',
    'messages' => [
        'send_application_success' => 'Send application successfully!',
        'send_application_error' => "Can't send application on this time, please try again later!",
    ],
    'form' => [
        'work_experience' => 'Work Experience',
        'title' => 'Application Form',
        'name' => 'Name',
        'email' => 'E-mail',
        'phone' => 'Phone',
        'first_name' => 'First Name',
        'last_name' => 'Last Name',
        'middle_name' => 'Middle Name',
        'time' => 'Time',
        'address' => 'Address',
        'full_name' => 'Full Name',
        'citizenship' => 'Citizenship',
        'gender' => 'Gender',
        'date_of_birth' => 'Date of Birth',
        'country' => 'Current country',
        'region' => 'Current region',
        'languages' => 'Languages',
        'university' => 'University',
        'degree' => 'Degree',
        'faculty' => 'Faculty',
        'specialization' => 'Specialization',
        'started_at' => 'Started At',
        'ended_at' => 'Ended At',
        'additional_education' => 'Additional Education',
        'diploma' => 'Diploma',
        'download_diploma' => 'Download Diploma',
        'last_workplace' => 'Last Workplace',
        'position' => 'Position',
        'later_workplaces' => 'Later Workplaces',
        'download_cv' => 'Download CV',
        'organization' => 'Organization',
        'type' => 'Type',
        'cv_file' => 'CV File',
        'is_available_full_time' => 'Is available full time?',
        'can_attend_summer_institute' => 'Can attend summer institute?',
        'agreed_to_terms' => 'Agreed to terms',
        'motivation_essay' => 'Motivation Essay',
        'value_proposition_essay' => 'Value Proposition Essay',
        'benefit_essay' => 'Benefit Essay',
        'work_experience_started_at' => 'Work Experience Started At',
        'work_experience_ended_at' => 'Work Experience Ended At',
        'education_started_at' => 'Education Started At',
        'education_ended_at' => 'Education Ended At',
        'education' => 'Education',
        'known_languages' => 'Known Languages',
        'education_diploma_file' => "Diploma's scan (or reference from current university if there's no diploma yet.",
        'social_activity' => 'Social Activity',
        'participation_in_program' => 'Participation in program',
        'motivation_essay_question' => 'Why do you want to become a fellow of the Teach for Uzbekistan program? Please give a detailed answer in the form of an essay.',
        'value_proposition_essay_question' => 'What do you think is your value for children and for the school? Please give a detailed answer in the form of an essay.',
        'benefit_essay_question' => 'What benefits do you expect from participating in the Teach for Uzbekistan program? Please give a detailed answer in the form of an essay.',
        'available_full_time_question' => 'Are you ready to work full-time from September 1 of next academic year, without combining participation in the program with other activities?',
        'can_attend_summer_institute_question' => 'Will you be able to participate in the Summer Institute which will last for 5 weeks in the next July-August (participation in it is mandatory to participate in the program)?',
        'agreed_to_terms_question' => 'Agree to share my personal information according laws',
        'send_application' => 'Send Application',
        'personal_information' => 'Personal Information',
    ],
    'statuses' => [
        'new' => 'New',
        'read_rejected' => 'Read - REJECTED',
        'interview' => 'Interview (waiting)',
        'interview_rejected' => 'Interview - REJECTED',
        'assessment' => 'Assessment (waiting)',
        'assessment_rejected' => 'Assessment - REJECTED',
        'summer_institute' => 'Summer Institute (waiting)',
        'summer_institute_rejected' => 'Summer Institute - REJECTED',
        'fellow' => 'Fellow',
        'finished' => 'Finished',
    ],
    'genders' => [
        'male' => 'Male',
        'female' => 'Female',
    ],
    'education_degrees' => [
        'bachelor' => 'Bachelor',
        'masters' => 'Masters',
        'phd' => 'PhD',
    ],
    'settings' => [
        'email' => [
            'title' => 'Application',
            'description' => 'Application email configuration',
            'templates' => [
                'notice_title' => 'Send notice to administrator',
                'notice_description' => 'Email template for notifying administrator upon receiving a new contact submission',
                'subject' => 'Message sent via application form at {{ site_title }}',
                'application_name' => 'Application name',
                'application_subject' => 'Application subject',
                'application_email' => 'Application email',
                'application_phone' => 'Application phone',
                'application_address' => 'Application address',
                'application_content' => 'Application content',
                'sender_confirmation_title' => 'Send confirmation to sender',
                'sender_confirmation_description' => 'Email template for confirming the sender that the message has been sent successfully',
                'sender_confirmation_subject' => 'Thank You for Contacting Us!',
            ],
        ],
    ],
];
