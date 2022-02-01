<?php

return [
    'url' => env('FRONTEND_URL', 'http://localhost:3000'), //フロントエンドのURL
    'reset_pass_url' => env('RESET_PASS_URL', '/password/reset?key='), // フロントエンドのパスワードリセットページのURL
];