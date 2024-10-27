<?php

namespace App\Exports;

use App\Models\ProcessAgreement;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\BeforeSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Worksheet\PageSetup;

class ProcessAgreementsExport implements FromCollection, WithHeadings, ShouldAutoSize, WithStyles, WithEvents
{
    protected $year;
    protected $district;
    protected $search;
    protected $field;
    protected $userId;

    public function __construct($year, $district, $search = null, $field = null, $userId = null)
    {
        $this->year = $year;
        $this->district = $district;
        $this->search = $search;
        $this->field = $field;
        $this->userId = $userId;
    }

    public function collection()
    {
        $query = ProcessAgreement::query();

        if (!empty($this->district) && $this->district !== 'All Districts') {
            $query->whereHas('user', function ($query) {
                $query->where('district', $this->district);
            });
        }

        if (!empty($this->year) && $this->year !== 'All Years') {
            $query->whereYear('created_at', $this->year);
        }

        if (!empty($this->search)) {
            $query->where('task', 'LIKE', '%' . $this->search . '%');
        }

        if (!empty($this->field)) {
            $query->where('field', $this->field);
        }

        if (!empty($this->userId)) {
            $query->where('user_id', $this->userId);
        }

        $processAgreements = $query->get();

        return $processAgreements->map(function ($agreement) {
            return [
                'ID' => $agreement->id,
                'User Name' => $agreement->user->name,
                'User Email' => $agreement->user->email,
                'District' => $agreement->user->district,
                'Field' => $agreement->field,
                'Task' => $agreement->task,
                'Performance Indicator' => $agreement->performance_indicator,
                'Contracted Target' => $agreement->contracted_target,
                '1st Quarter' => $agreement->first_quarter,
                '2nd Quarter' => $agreement->second_quarter,
                '3rd Quarter' => $agreement->third_quarter,
                '4th Quarter' => $agreement->fourth_quarter,
                'Total' => $agreement->total,
                'Percentage' => $agreement->percentage,
            ];
        });
    }

    public function headings(): array
    {
        return [
            'ID', 'User Name', 'User Email', 'District', 'Field', 'Task',
            'Performance Indicator', 'Contracted Target', '1st Quarter',
            '2nd Quarter', '3rd Quarter', '4th Quarter', 'Total', 'Percentage'
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('A1:N1')->getFont()->setBold(true);
        $sheet->getStyle('A1:N1')->getAlignment()->setWrapText(true);
    }

    public function registerEvents(): array
    {
        return [
            BeforeSheet::class => function (BeforeSheet $event) {
                $event->sheet->getPageSetup()->setOrientation(PageSetup::ORIENTATION_LANDSCAPE);
                $event->sheet->getPageSetup()->setPaperSize(PageSetup::PAPERSIZE_A4);

                $event->sheet->getColumnDimension('A')->setWidth(3); // ID
                $event->sheet->getColumnDimension('B')->setWidth(10); // User Name
                $event->sheet->getColumnDimension('C')->setWidth(9); // User Email
                $event->sheet->getColumnDimension('D')->setWidth(10); // District
                $event->sheet->getColumnDimension('E')->setWidth(10); // Field
                $event->sheet->getColumnDimension('F')->setWidth(20); // Task
                $event->sheet->getColumnDimension('G')->setWidth(15); // Performance Indicator
                $event->sheet->getColumnDimension('H')->setWidth(8); // Contracted Target
                $event->sheet->getColumnDimension('I')->setWidth(8); // 1st Quarter
                $event->sheet->getColumnDimension('J')->setWidth(8); // 2nd Quarter
                $event->sheet->getColumnDimension('K')->setWidth(8); // 3rd Quarter
                $event->sheet->getColumnDimension('L')->setWidth(8); // 4th Quarter
                $event->sheet->getColumnDimension('M')->setWidth(10); // Total
                $event->sheet->getColumnDimension('N')->setWidth(7); // Percentage

                $event->sheet->getStyle('A1:N1')->getFont()->setSize(7);
                $event->sheet->getDelegate()->getSheetView()->setZoomScale(70);
            },
        ];
    }
}
