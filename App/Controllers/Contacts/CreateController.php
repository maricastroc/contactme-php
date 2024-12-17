<?php

namespace App\Controllers\Contacts;

use App\Models\Contact;
use Core\Validation;

use function Core\flash;
use function Core\redirect;
use function Core\request;
use function Core\view;

class CreateController
{
    public function create()
    {
        $contacts = Contact::all();

        $validations = [];

        $rules = [
            'name' => ['required', 'min:3', 'max:255'],
            'description' => ['required'],
            'email' => ['required'],
            'phone' => ['required', 'min:7'],
        ];

        $validation = Validation::validate($rules, request()->all());

        $validations = $validation->validations;

        if (! empty($validations)) {
            flash()->push('validations', $validations);

            return view('contacts/index', [
                'contacts' => $contacts,
                'validations' => $validations,
                'old' => request()->all(),
            ]);
        }

        if (isset($_FILES['avatar_url']) && $_FILES['avatar_url']['error'] === UPLOAD_ERR_OK) {
            $avatar = $_FILES['avatar_url'];

            $uploadDir = 'data/images/contacts/';

            if (! is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }

            $avatarName = uniqid('avatar_').'.'.pathinfo($avatar['name'], PATHINFO_EXTENSION);

            $uploadPath = $uploadDir.$avatarName;

            if (move_uploaded_file($avatar['tmp_name'], $uploadPath)) {
                $avatarUrl = $uploadPath;
                $data['avatar_url'] = $avatarUrl;
            } else {
                flash()->push('error', 'Failed to upload avatar.');

                return redirect('/contacts');
            }
        } else {
            flash()->push('error', 'No file uploaded or upload error.');

            return redirect('/contacts');
        }
        $data = request()->all();

        $data['avatar_url'] = isset($avatarUrl) ? $avatarUrl : '';

        Contact::create($data);

        flash()->push('successfully_created', 'Contact successfully created!');
        redirect('/contacts');
    }

    public function index()
    {
        return view('/contacts');
    }
}
