<?php

return [
    'theme' => 'aside',
    'app' => 'lambda',
    'title' => 'Lambda',
    'subTitle' => 'Lambda Platform',
    'copyright' => 'Copyright ©' . date('Y') . ' Lambda Development Team',
    'favicon' => '/images/puzzle-logo-white.png',
    'bg' => '/assets/lambda/images/login-bg.jpg',
    'logo' => '/assets/lambda/images/logo.png',
    'logoText' => '',
    'super_url' => '/lambda/puzzle',
    'app_url' => '/lambda',
    'has_language' => false,
    'languages' => [
        ['label' => "Moнгол", 'code' => 'mn']
    ],
    'default_language' => 'mn',
    'role-redirects' => [
        [
            'role_id' => 1,
            'url' => '/lambda/puzzle',
        ],
    ],
    'user_data_fields' => [
        'id',
    ],
    'password_reset_time_out' => 30,
    "data_form_custom_elements" => [],
    'static_words' => [
        'mn' => [
            'title' => 'Lambda',
            'subtitle' => 'Lambda Platform',
            'login' => 'Нэвтрэх',
            'forgot' => 'Нууц үгээ мартсан?',
            'remember' => 'Энэ компьютерт сануулах',
            'loginTitle' => 'СИСТЕМД НЭВТРЭХ',
            'username' => 'Нэвтрэх нэр',
            'email' => 'И-мэйл',
            'password' => 'Нууц үг',
            'loginSuccess' => 'Амжилттай нэвтэрлээ. Түр хүлээнэ үү!',
            'loginError' => 'Уучлаарай, нэвтрэх үед алдаа гарлаа!!',
            'emailRequired' => 'И-мэйл хаяг аа оруулна уу',
            'forgotDescription' => 'И-мэйл хаягаа оруулаад нууц үг шинэчлэнэ үү',
            'sendPasswordResetCode' => 'Нууц үг солих код и-мэйлээр авах',
            'passwordConfirm' => 'Нууц үг баталгаажуулах',
            'userNotFound' => 'Хэрэгэлч олдсонгүй !!!',
            'codeSentError' => 'Нууц үг шинэчлэх код илгээх үед алдаа гарлаа!',
            'passwordReset' => 'НУУЦ ҮГ ШИНЭЧЛЭХ',
            'passwordResetCode' => 'Нууц үгээ сэргээх код',
            'passwordResetCodeSent' => 'Нууц үг шинэчлэх код амжилттай илгээгдлээ !',
            'passwordResetCodeRequired' => 'Нууц үг солих код  оруулаагүй байна !!!',
            'passwordResetSuccess' => 'Нууц үг амжилттай шинэчлэгдлээ !',
            'passwordConfirmError' => 'Нууц үг баталгаажуулалт таарсангүй !!!',
            'passwordResetCodeIncorrect' => 'Нууц үг сэргээх код буруу байна !!!',
            'passwordResetCodeTimeout' => 'Нууц үг сэргээх кодны хугацаа дууссан !!!',
            'noReply' => 'Энэхүү и-мэйл нь автоматаар илгээгдсэн учир хариу бичих шаардлагагүй.',
        ],
    ]
];

