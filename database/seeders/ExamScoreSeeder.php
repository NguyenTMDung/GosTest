<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class ExamScoreSeeder extends Seeder
{
    public function run()
    {
        $csvPath = database_path('seeders/exam_scores.csv');

        if (!File::exists($csvPath)) {
            $this->command->error('File CSV không tồn tại!');
            return;
        }

        $file = fopen($csvPath, 'r');
        $header = fgetcsv($file); // đọc header

        while ($row = fgetcsv($file)) {
            if ($row === false) continue;
            $data = array_combine($header, $row);

            // Convert empty strings to null, and floats for numeric fields
            $data = array_map(function ($value) {
                if ($value === '' || $value === null) {
                    return null;
                }
                // Nếu là số có thể chuyển sang float
                if (is_numeric($value)) {
                    return (float)$value;
                }
                return $value;
            }, $data);

            DB::table('exam_scores')->updateOrInsert(
                ['sbd' => $data['sbd']],
                $data
            );
        }

        fclose($file);

        $this->command->info('Import CSV exam_scores thành công!');
    }
}
