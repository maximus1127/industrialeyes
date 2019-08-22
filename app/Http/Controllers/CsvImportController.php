<?php

namespace App\Http\Controllers;

use App\CsvFileImporter;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;


class CsvImportController extends Controller
{
    /**
     * [POST] Form which will submit the file
     */
    public function store()
    {
        // Check if form submitted a file
        if (Input::hasFile('csv_import')) {
            $csv_file = Input::file('csv_import');

            // You wish to do file validation at this point
            if ($csv_file->isValid()) {

                // We can also create a CsvStructureValidator class
                // So that we can validate the structure of our CSV file

                // Lets construct our importer
                $csv_importer = new CsvFileImporter();

                // Import our csv file
                if ($csv_importer->import($csv_file)) {
                    // Provide success message to the user
                    $message = 'Your file has been successfully imported!';
                } else {
                    $message = 'Your file did not import';
                }

            } else {
                // Provide a meaningful error message to the user
                // Perform any logging if necessary
                $message = 'You must provide a CSV file for import.';
            }

            return Redirect::back()->with('message', $message);
        }
    }
}
