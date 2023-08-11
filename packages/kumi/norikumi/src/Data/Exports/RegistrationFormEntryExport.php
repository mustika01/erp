<?php

namespace Kumi\Norikumi\Data\Exports;

use Illuminate\Support\Carbon;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Cell\StringValueBinder;
use Maatwebsite\Excel\Concerns\WithCustomValueBinder;

class RegistrationFormEntryExport extends StringValueBinder implements FromArray, WithMapping, WithHeadings, WithCustomValueBinder, ShouldAutoSize
{
    use Exportable;

    public function __construct(
        public array $items
    ) {
    }

    public function array(): array
    {
        return $this->items;
    }

    public function headings(): array
    {
        return [
            '#',
            'Name',
            'Gender',
            'Status',
            'Place of Birth',
            'Date of Birth',
            'Age',
            'NIC No.',
            'Family Card No.',
            'Tax Card No.',
            'BPJS Active',
            'BPJS No.',
            'Mother\'s Name',
            'Designation',
            'Certificate Level',
            'Certificate No.',
            'RATINGS No.',
            'RATINGS Publish Date',
            'RATINGS Expiry Date',
            'Endorsement No.',
            'Endorsement Expiry Date',
            'BST No.',
            'BST Publish Date',
            'BST Expiry Date',
            'Seafarer\'s Book No.',
            'Seafarer\'s Book Expiry Date',
            'Wearpack Size',
            'Safety Shoes Size',
            'Emergency Contact Name',
            'Emergency Contact No.',
        ];
    }

    public function map($row): array
    {
        $birthDate = Carbon::parse($row->properties['date_of_birth']);

        return [
            $row->id,
            $row->name,
            $row->properties['gender'],
            '',
            $row->properties['place_of_birth'],
            $birthDate->format('d-m-Y'),
            $birthDate->age,
            $row->properties['identity_card_number'],
            $row->properties['family_card_number'],
            $row->properties['tax_card_number'],
            '', // bpjs active
            '', // bpjs no.
            '', // mother's name
            '', // designation
            $row->properties['certificate_level'] ?? 'N/A',
            $row->properties['certificate_number'] ?? 'N/A',
            $row->properties['ratings_or_able_number'] ?? 'N/A',
            '', // ratings or able publish date
            $row->properties['ratings_or_able_expiry_date'] ?? 'N/A',
            $row->properties['endorsement_number'],
            $row->properties['endorsement_expiry_date'],
            $row->properties['basic_safety_training_number'] ?? 'N/A',
            '', // basic safety training publish date
            $row->properties['basic_safety_training_expiry_date'] ?? 'N/A',
            $row->properties['seafarer_book_number'],
            $row->properties['seafarer_book_expiry_date'],
            $row->properties['wearpack_size'],
            $row->properties['safety_shoes_size'],
            $row->properties['emergency_contact_name'],
            $row->properties['emergency_contact_number'],
        ];
    }
}
