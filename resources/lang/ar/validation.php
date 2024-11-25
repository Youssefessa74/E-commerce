<?php

return [
'accepted' => 'يجب قبول حقل :attribute.',
'accepted_if' => 'يجب قبول حقل :attribute عندما يكون :other هو :value.',
'active_url' => 'يجب أن يكون حقل :attribute عنوان URL صالح.',
'after' => 'يجب أن يكون حقل :attribute تاريخًا بعد :date.',
'after_or_equal' => 'يجب أن يكون حقل :attribute تاريخًا بعد أو يساوي :date.',
'alpha' => 'يجب أن يحتوي حقل :attribute على أحرف فقط.',
'alpha_dash' => 'يجب أن يحتوي حقل :attribute على أحرف وأرقام وشرطات وشرطات سفلية فقط.',
'alpha_num' => 'يجب أن يحتوي حقل :attribute على أحرف وأرقام فقط.',
'array' => 'يجب أن يكون حقل :attribute مصفوفة.',
'ascii' => 'يجب أن يحتوي حقل :attribute على أحرف ورموز أحادية البايت فقط.',
'before' => 'يجب أن يكون حقل :attribute تاريخًا قبل :date.',
'before_or_equal' => 'يجب أن يكون حقل :attribute تاريخًا قبل أو يساوي :date.',
'between' => [
    'array' => 'يجب أن يحتوي حقل :attribute على بين :min و :max عناصر.',
    'file' => 'يجب أن يكون حجم ملف :attribute بين :min و :max كيلوبايت.',
    'numeric' => 'يجب أن تكون قيمة :attribute بين :min و :max.',
    'string' => 'يجب أن يحتوي حقل :attribute على بين :min و :max حرف.',
],
'boolean' => 'يجب أن يكون حقل :attribute صحيحًا أو خاطئًا.',
'can' => 'يحتوي حقل :attribute على قيمة غير مصرح بها.',
'confirmed' => 'تأكيد حقل :attribute لا يتطابق.',
'current_password' => 'كلمة المرور غير صحيحة.',
'date' => 'يجب أن يكون حقل :attribute تاريخًا صالحًا.',
'date_equals' => 'يجب أن يكون حقل :attribute تاريخًا يساوي :date.',
'date_format' => 'يجب أن يتطابق حقل :attribute مع التنسيق :format.',
'decimal' => 'يجب أن يحتوي حقل :attribute على :decimal أماكن عشرية.',
'declined' => 'يجب رفض حقل :attribute.',
'declined_if' => 'يجب رفض حقل :attribute عندما يكون :other هو :value.',
'different' => 'يجب أن يكون حقل :attribute و :other مختلفين.',
'digits' => 'يجب أن يحتوي حقل :attribute على :digits رقم.',
'digits_between' => 'يجب أن يكون حقل :attribute بين :min و :max رقم.',
'dimensions' => 'حقل :attribute له أبعاد صورة غير صالحة.',
'distinct' => 'يحتوي حقل :attribute على قيمة مكررة.',
'doesnt_end_with' => 'يجب ألا ينتهي حقل :attribute بأحد القيم التالية: :values.',
'doesnt_start_with' => 'يجب ألا يبدأ حقل :attribute بأحد القيم التالية: :values.',
'email' => 'يجب أن يكون حقل :attribute عنوان بريد إلكتروني صالح.',
'ends_with' => 'يجب أن ينتهي حقل :attribute بأحد القيم التالية: :values.',
'enum' => 'القيمة المحددة لـ :attribute غير صالحة.',
'exists' => 'القيمة المحددة لـ :attribute غير صالحة.',
'extensions' => 'يجب أن يحتوي حقل :attribute على إحدى الامتدادات التالية: :values.',
'file' => 'يجب أن يكون حقل :attribute ملفًا.',
'filled' => 'يجب أن يحتوي حقل :attribute على قيمة.',
'gt' => [
    'array' => 'يجب أن يحتوي حقل :attribute على أكثر من :value عنصر.',
    'file' => 'يجب أن يكون حجم ملف :attribute أكبر من :value كيلوبايت.',
    'numeric' => 'يجب أن تكون قيمة :attribute أكبر من :value.',
    'string' => 'يجب أن يحتوي حقل :attribute على أكثر من :value حرف.',
],
'gte' => [
    'array' => 'يجب أن يحتوي حقل :attribute على :value عناصر أو أكثر.',
    'file' => 'يجب أن يكون حجم ملف :attribute أكبر من أو يساوي :value كيلوبايت.',
    'numeric' => 'يجب أن تكون قيمة :attribute أكبر من أو تساوي :value.',
    'string' => 'يجب أن يحتوي حقل :attribute على أكبر من أو يساوي :value حرف.',
],
'hex_color' => 'يجب أن يكون حقل :attribute لونًا سداسيًا صالحًا.',
'image' => 'يجب أن يكون حقل :attribute صورة.',
'in' => 'القيمة المحددة لـ :attribute غير صالحة.',
'in_array' => 'يجب أن يوجد حقل :attribute في :other.',
'integer' => 'يجب أن يكون حقل :attribute عددًا صحيحًا.',
'ip' => 'يجب أن يكون حقل :attribute عنوان IP صالح.',
'ipv4' => 'يجب أن يكون حقل :attribute عنوان IPv4 صالح.',
'ipv6' => 'يجب أن يكون حقل :attribute عنوان IPv6 صالح.',
'json' => 'يجب أن يكون حقل :attribute سلسلة JSON صالحة.',
'lowercase' => 'يجب أن يكون حقل :attribute بحروف صغيرة.',
'lt' => [
    'array' => 'يجب أن يحتوي حقل :attribute على أقل من :value عنصر.',
    'file' => 'يجب أن يكون حجم ملف :attribute أقل من :value كيلوبايت.',
    'numeric' => 'يجب أن تكون قيمة :attribute أقل من :value.',
    'string' => 'يجب أن يحتوي حقل :attribute على أقل من :value حرف.',
],
'lte' => [
    'array' => 'يجب ألا يحتوي حقل :attribute على أكثر من :value عنصر.',
    'file' => 'يجب أن يكون حجم ملف :attribute أقل من أو يساوي :value كيلوبايت.',
    'numeric' => 'يجب أن تكون قيمة :attribute أقل من أو تساوي :value.',
    'string' => 'يجب أن يحتوي حقل :attribute على أقل من أو يساوي :value حرف.',
],
'mac_address' => 'يجب أن يكون حقل :attribute عنوان MAC صالح.',
'max' => [
    'array' => 'يجب ألا يحتوي حقل :attribute على أكثر من :max عنصر.',
    'file' => 'يجب ألا يكون حجم ملف :attribute أكبر من :max كيلوبايت.',
    'numeric' => 'يجب ألا تكون قيمة :attribute أكبر من :max.',
    'string' => 'يجب ألا يحتوي حقل :attribute على أكثر من :max حرف.',
],
'max_digits' => 'يجب ألا يحتوي حقل :attribute على أكثر من :max رقم.',
'mimes' => 'يجب أن يكون حقل :attribute ملفًا من النوع: :values.',
'mimetypes' => 'يجب أن يكون حقل :attribute ملفًا من النوع: :values.',
'min' => [
    'array' => 'يجب أن يحتوي حقل :attribute على الأقل :min عنصر.',
    'file' => 'يجب أن يكون حجم ملف :attribute على الأقل :min كيلوبايت.',
    'numeric' => 'يجب أن تكون قيمة :attribute على الأقل :min.',
    'string' => 'يجب أن يحتوي حقل :attribute على الأقل :min حرف.',
],
'min_digits' => 'يجب أن يحتوي حقل :attribute على الأقل :min رقم.',
'missing' => 'يجب أن يكون حقل :attribute مفقودًا.',
'missing_if' => 'يجب أن يكون حقل :attribute مفقودًا عندما يكون :other هو :value.',
'missing_unless' => 'يجب أن يكون حقل :attribute مفقودًا ما لم يكن :other في :values.',
'missing_with' => 'يجب أن يكون حقل :attribute مفقودًا عندما يكون :values موجودًا.',
'missing_with_all' => 'يجب أن يكون حقل :attribute مفقودًا عندما تكون :values موجودة.',
'multiple_of' => 'يجب أن يكون حقل :attribute مضاعفًا لـ :value.',
'not_in' => 'القيمة المحددة لـ :attribute غير صالحة.',
'not_regex' => 'تنسيق حقل :attribute غير صالح.',
'numeric' => 'يجب أن يكون حقل :attribute رقمًا.',
'password' => [
    'letters' => 'يجب أن يحتوي حقل :attribute على حرف واحد على الأقل.',
    'mixed' => 'يجب أن يحتوي حقل :attribute على حرف كبير واحد على الأقل وحرف صغير واحد على الأقل.',
    'numbers' => 'يجب أن يحتوي حقل :attribute على رقم واحد على الأقل.',
    'symbols' => 'يجب أن يحتوي حقل :attribute على رمز واحد على الأقل.',
    'uncompromised' => 'القيمة المقدمة لـ :attribute ظهرت في تسرب بيانات. يرجى اختيار قيمة مختلفة.',
],
'present' => 'يجب أن يكون حقل :attribute موجودًا.',
'present_if' => 'يجب أن يكون حقل :attribute موجودًا عندما يكون :other هو :value.',
'present_unless' => 'يجب أن يكون حقل :attribute موجودًا ما لم يكن :other هو :value.',
'present_with' => 'يجب أن يكون حقل :attribute موجودًا عندما تكون :values موجودة.',
'present_with_all' => 'يجب أن يكون حقل :attribute موجودًا عندما تكون :values موجودة.',
'prohibited' => 'حقل :attribute محظور.',
'prohibited_if' => 'حقل :attribute محظور عندما يكون :other هو :value.',
'prohibited_unless' => 'حقل :attribute محظور ما لم يكن :other في :values.',
'prohibits' => 'يمنع حقل :attribute وجود :other.',
'regex' => 'تنسيق حقل :attribute غير صالح.',
'required' => 'حقل :attribute مطلوب.',
'required_array_keys' => 'يجب أن يحتوي حقل :attribute على إدخالات لـ: :values.',
'required_if' => 'حقل :attribute مطلوب عندما يكون :other هو :value.',
'required_if_accepted' => 'حقل :attribute مطلوب عندما يتم قبول :other.',
'required_unless' => 'حقل :attribute مطلوب ما لم يكن :other في :values.',
'required_with' => 'حقل :attribute مطلوب عندما تكون :values موجودة.',
'required_with_all' => 'حقل :attribute مطلوب عندما تكون :values موجودة.',
'required_without' => 'حقل :attribute مطلوب عندما لا تكون :values موجودة.',
'required_without_all' => 'حقل :attribute مطلوب عندما لا تكون أي من :values موجودة.',
'same' => 'يجب أن يتطابق حقل :attribute مع :other.',
'size' => [
    'array' => 'يجب أن يحتوي حقل :attribute على :size عناصر.',
    'file' => 'يجب أن يكون حجم ملف :attribute :size كيلوبايت.',
    'numeric' => 'يجب أن تكون قيمة :attribute :size.',
    'string' => 'يجب أن يحتوي حقل :attribute على :size حرف.',
],
'starts_with' => 'يجب أن يبدأ حقل :attribute بأحد القيم التالية: :values.',
'string' => 'يجب أن يكون حقل :attribute سلسلة.',
'timezone' => 'يجب أن يكون حقل :attribute منطقة زمنية صالحة.',
'unique' => 'تم أخذ :attribute بالفعل.',
'uploaded' => 'فشل تحميل حقل :attribute.',
'uppercase' => 'يجب أن يكون حقل :attribute بحروف كبيرة.',
'url' => 'يجب أن يكون حقل :attribute عنوان URL صالح.',
'ulid' => 'يجب أن يكون حقل :attribute ULID صالح.',
'uuid' => 'يجب أن يكون حقل :attribute UUID صالح.',

/*
|--------------------------------------------------------------------------
| Custom Validation Language Lines
|--------------------------------------------------------------------------
|
| هنا يمكنك تحديد رسائل التحقق المخصصة للسمات باستخدام
| "attribute.rule" لتسمية الأسطر. هذا يجعل من السهل
| تحديد سطر لغة مخصص محدد لقاعدة سمات معينة.
|
*/

'custom' => [
    'attribute-name' => [
        'rule-name' => 'custom-message',
    ],
],

/*
|--------------------------------------------------------------------------
| Custom Validation Attributes
|--------------------------------------------------------------------------
|
| تستخدم الأسطر اللغوية التالية لاستبدال عنصر النائب الخاص بنا
| بشيء أكثر ملاءمة للقارئ مثل "عنوان البريد الإلكتروني" بدلاً
| من "البريد الإلكتروني". يساعدنا هذا ببساطة في جعل رسالتنا أكثر تعبيرًا.
|
*/

'attributes' => [],

];
