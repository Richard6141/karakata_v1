public function import(Request $request)
    {
        $request->validate([
            'file' => 'required',
        ]);

        $nbrow = 0;
        try {
            set_time_limit(0);
            $time_start = microtime(true);

            $f = new NumberFormatter("fr", NumberFormatter::SPELLOUT);
            $records = import_CSV($request->file);


            DB::beginTransaction();

            foreach ($records as $key => $row) {
                $nbrow++;

                Source::create([
                    'ancient_id'     => $row['id'],
                    'label'     => $row['libelle'],
                ]);
            }

            DB::commit();
            $time_end = microtime(true);
            $execution_time = round(($time_end - $time_start));

            return back()->with('successMessage', "Succès de l'import. <br>" . $nbrow . " lignes importées. Durée (sec): " . $execution_time);
        } catch (\Throwable $ex) {
            DB::rollBack();
            $time_end = microtime(true);
            $execution_time = round(($time_end - $time_start));
            return back()->with('errorMessage', "Échec, ligne " . $nbrow . ". Durée (sec): " . $execution_time . "<br>" . $ex->getMessage());
        }
    }


function import_CSV($filename, $delimiter = ';')
{
    if (!file_exists($filename) || !is_readable($filename))
        return false;
    $header = null;
    $data = array();
    if (($handle = fopen($filename, 'r')) !== false) {
        while (($row = fgetcsv($handle, 1000, $delimiter)) !== false) {
            $row = array_map("utf8_encode", $row);
            if (!$header)
                $header = $row;
            else
                $data[] = array_combine($header, $row);
        }
        fclose($handle);
    }
    return $data;
}
