{{ header }}

<div class="bb-main-content">
    <table class="bb-box" cellpadding="0" cellspacing="0">
        <tbody>
            <tr>
                <td class="bb-content bb-pb-0" align="center">
                    <table class="bb-icon bb-icon-lg bb-bg-blue" cellspacing="0" cellpadding="0">
                        <tbody>
                            <tr>
                                <td valign="middle" align="center">
                                    <img src="{{ 'mail' | icon_url }}" class="bb-va-middle" width="40" height="40" alt="Icon">
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <h1 class="bb-text-center bb-m-0 bb-mt-md">New Application Message</h1>
                </td>
            </tr>
            <tr>
                <td>
                    <table cellpadding="0" cellspacing="0">
                        <tbody>
                            <tr>
                                <td class="bb-content">
                                    <p>Dear Admin,</p>

                                    <h4>Message details</h4>

                                    <table class="bb-table" cellspacing="0" cellpadding="0">
                                        <thead>
                                            <tr>
                                                <th width="80px"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            {% if application_name %}
                                                <tr>
                                                    <td>Name:</td>
                                                    <td class="bb-font-strong bb-text-left"> {{ application_name }} </td>
                                                </tr>
                                            {% endif %}
                                            {% if application_email %}
                                                <tr>
                                                    <td>Email:</td>
                                                    <td class="bb-font-strong bb-text-left"> {{ application_email }} </td>
                                                </tr>
                                            {% endif %}
                                            {% if application_address %}
                                                <tr>
                                                    <td>Address:</td>
                                                    <td class="bb-font-strong bb-text-left"> {{ application_address }} </td>
                                                </tr>
                                            {% endif %}
                                            {% if application_phone %}
                                                <tr>
                                                    <td>Phone:</td>
                                                    <td class="bb-font-strong bb-text-left"> {{ application_phone }} </td>
                                                </tr>
                                            {% endif %}
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td class="bb-content bb-text-center bb-pt-0 bb-pb-xl" align="center">
                                    <p>You can reply an email to {{ application_email }} by clicking on below button.</p> <br />
                                    <a href="mailto:{{ application_email }}" class="bb-btn bb-bg-blue bb-border-blue">Answer</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>
</div>

{{ footer }}
