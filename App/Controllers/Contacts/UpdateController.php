<?php

namespace App\Controllers\Contacts;

use App\Models\Contact;
use Core\Validation;

use function Core\dd;
use function Core\flash;
use function Core\redirect;
use function Core\request;

class UpdateController {
    public function update() {
        $validations = [];

        $rules = [
            'name' => ['required', 'min:3', 'max:255'],
            'description' => ['required'],
            'email' => ['required'],
            'phone' => ['required', 'min:7'],
        ];

        $validation = Validation::validate($rules, request()->all());

        $validations = $validation->validations;

        if (!empty($validations)) {
            flash()->push('validations', $validations);
            return redirect('/contacts?id=' . request()->post('id'));
        }

        $data = request()->all();
        $contactId = $data['id'];
        $contact = Contact::find($contactId);

        if (isset($_FILES['avatar_url']) && $_FILES['avatar_url']['error'] === UPLOAD_ERR_OK) {
            $avatar = $_FILES['avatar_url'];

            $uploadDir = 'data/images/contacts/';
            
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }

            $avatarName = uniqid('avatar_') . '.' . pathinfo($avatar['name'], PATHINFO_EXTENSION);

            $uploadPath = $uploadDir . $avatarName;

            if (move_uploaded_file($avatar['tmp_name'], $uploadPath)) {
                if (!empty($contact->avatar_url) && file_exists($contact->avatar_url)) {
                    unlink($contact->avatar_url);
                }

                $data['avatar_url'] = $uploadPath;
            } else {
                flash()->push('error', 'Failed to upload avatar.');
                return redirect('/contacts?id=' . $contactId);
            }
        } else {
            $data['avatar_url'] = $contact->avatar_url ?? null;
        }

        Contact::update($data);

        flash()->push('successfully_updated', 'Contact successfully updated!');

        return redirect('/contacts');
    }
}
