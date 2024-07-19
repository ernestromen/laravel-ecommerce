<?php
namespace App\Services;

use Illuminate\Support\Facades\Log;
use League\Csv\Writer;
use Response;
use App\Models\Category;
use Illuminate\Support\Facades\Schema;

class DownloadTableData
{
    public function execute()
    {
        $csv = Writer::createFromString('');
        $categories = Category::all();
        $tableName = $categories->first()->getTable();
        $columns = Schema::getColumnListing($tableName);

        $csv->insertOne($columns);

        foreach ($categories as $category) {

            $rowData = [];

            foreach ($columns as $col => $val) {

                $rowData[] = $category->$val;


            }
            $csv->insertOne($rowData);

        }

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="categories.csv"',
        ];

        return Response::make($csv->getContent(), 200, $headers);
    }
}
