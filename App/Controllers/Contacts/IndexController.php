<?php

namespace App\Controllers\Contacts;

use App\Models\Contact;

use function Core\Request;
use function Core\View;

  class IndexController {
    
    public function index() {
      $search = request()->get('search', '');

      $contacts = Contact::all($search);

      $selectedContact = $this->getSelectedContact($contacts);

      if (!$selectedContact) {
        return view('contacts/not-found');
      }

      return view('contacts/index', [
        'contacts' => $contacts,
        'selectedContact' => $selectedContact,
      ]);
    }

    private function getSelectedContact($contacts) {
      isset($_GET['id']) ? $id = $_GET['id'] : (sizeof($contacts) > 0 ? $id = $contacts[0]->id : null);

      $filteredcontacts = array_filter($contacts, fn($n) => $n->id == $id);

      return array_pop($filteredcontacts);
  }
  }