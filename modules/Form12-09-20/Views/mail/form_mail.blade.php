<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type"  content="text/html charset=UTF-8" />
        <title>{{ setting_item_with_lang("site_title") }}</title>
        <style type="text/css">
            body {
                margin: 0;
                padding: 0;
                min-width: 100% !important;
                background-color: #f2f2f2;
            }
            .my-email-body img {
                width: 32px;
            }
            .content {
                width: 100%;
                max-width: 600px;
                margin: 0 auto;
                border: 1px solid #f2f2f2;
            }
            .btn {
                padding: 10px;
                background-color: #fbf1f1;
                margin: 25px auto;
                width: 25%;
                min-width: 200px;
                color: #000000;
                display: block;
                text-align: center;
            }
            a {
                text-decoration: none;
            }
            #mail_content img {
                width: 43px;
            }
            #mail_content {
                font-family: Arial, Helvetica, sans-serif;
                border-collapse: collapse;
                width: 100%;
            }
            .content{
                font-family: Arial, Helvetica, sans-serif;
            }

            #mail_content td, #mail_content th {
                border: 1px solid #ddd;
                padding: 8px;
            }
        </style>
    </head>
    <body>
        <div class="content">
            <div style="width: 100%; height: 130px; padding-top: 25px; background-color: #fff; border-bottom: 2px dotted #e8e8e8;">
                <div style="width: 40%; margin: 0 auto;">

                    @php
                        $logo_id = setting_item("logo_id");
                        if(!empty($row->custom_logo)){
                            $logo_id = $row->custom_logo;
                        }
                    @endphp
                    @if($logo_id)
                        <?php $logo = get_file_url($logo_id,'full') ?>
                        <img style="width: 100% !important;" width="100%" src="{{$logo}}" alt="meiser-logo" />
                    @endif
                </div>
            </div>
            <div style="width: 550px; background-color: #ffffff; padding: 0px 25px 50px; margin-bottom: 0px; color: #000000;">
                <br />
                <br />
                <table id="mail_content">
                @foreach($formEntries as $formEntry)
                    <tr>
                        <td>{{ $formEntry->label }}</td>
                        <td>
                            @if($formEntry->type == \Modules\Form\Enums\FormEntryTypes::image->name)
                                @if($formEntry->value != '')
                                    <a href="{{ asset('storage/forms/'.$formEntry->form_id.'/'.$formEntry->value) }}"
                                       target="_blank"
                                    >
                                        <img src="{{ asset('storage/forms/'.$formEntry->form_id.'/'.$formEntry->value) }}"
                                             alt="{{ $formEntry->value }}"
                                             height="100px"
                                        />
                                    </a>
                                @endif
                            @elseif($formEntry->type == \Modules\Form\Enums\FormEntryTypes::multi_select_image->name)
                                @if(is_array(json_decode($formEntry->value)))
                                    @foreach(json_decode($formEntry->value) as $entry)
                                        <span class="badge badge-success">{{ $entry }}</span>
                                    @endforeach
                                @endif
                            @else
                                @php
                                    if($formEntry->key == 'service' || $formEntry->key == 'extra_service'){
                                        print_r(implode(', ',json_decode($formEntry->value)));
                                    } else {
                                        print_r($formEntry->value);
                                    }
                                @endphp
                            @endif
                        </td>
                    </tr>
                @endforeach
            </table>
                <br />
                <br />
                <hr />
                <div style="text-align:center">{{ setting_item_with_lang("site_title") }}<br><span style="color:#000000!important">{{ setting_item_with_lang("address") }}<br><br>Telefon: {{ setting_item_with_lang("phone_no") }}<br><a href="mailto:{{ setting_item_with_lang("email") }}" style="color: #000000;">
                    {{ setting_item_with_lang("email") }}</a><br></div>
            </div>
        </div>
    </body>
</html>
