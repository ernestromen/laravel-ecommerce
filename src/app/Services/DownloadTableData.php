<?php
namespace App\Services;

use Illuminate\Support\Facades\Log;
use League\Csv\Writer;
use Response;
use App\Models\Category;
use Illuminate\Support\Facades\Schema;

class DownloadTableData
{
    public function execute($entityName)
    {
        $modelPath = 'App\Models\\';
        $finalModelPath = $modelPath . $entityName;
        $tableDataToBeDownloaded = resolve($finalModelPath)::all();
        $csv = Writer::createFromString('');
        $tableName = $tableDataToBeDownloaded->first()->getTable();
        $columns = Schema::getColumnListing($tableName);

        $csv->insertOne($columns);

        foreach ($tableDataToBeDownloaded as $entity) {

            $rowData = [];

            foreach ($columns as $col => $val) {

                $rowData[] = $entity->$val;


            }
            $csv->insertOne($rowData);

        }

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="list.csv"',
        ];

        return Response::make($csv->getContent(), 200, $headers);
    }
}
