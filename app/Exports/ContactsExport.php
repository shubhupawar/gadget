<?php

namespace App\Exports;

use App\Models\Contact;
use Maatwebsite\Excel\Concerns\FromCollection;

class ContactsExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Contact::select('name', 'email', 'phone', 'message', 'image', 'created_at')->get();
    }

    public function headings(): array
    {
        return ['Name', 'Email', 'Phone', 'Message', 'Image Filename', 'Created At'];
    }
}
