<?php

namespace App\Controllers\Contacts;

use App\Models\Contact;

use function Core\Request;
use function Core\View;

class IndexController
{

    public function index()
    {
        $search = request()->get('search', '');
        $letter = request()->get('letter', '');

        if ($letter) {
            $contacts = Contact::findByLetter($letter);
        } else {
            $contacts = Contact::all($search);
        }

        return view('contacts/index', [
            'contacts' => $contacts,
        ]);
    }
}
