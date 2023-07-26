<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class CSVGenerateController extends Controller
{

    public function csvIndex()
    {
        return view('CSV');
    }

    public function generateCSV(Request $request)
    {
        // Step 1: Generate the CSV file for 3 employees for 30 Days
        $employeeData = $this->generateEmployeeData();
        $employeeCSVData = $this->convertToCSV($employeeData);
        file_put_contents('employees.csv', $employeeCSVData);

        // Step 2: Create the employee leave file in CSV format
        $employeeLeaveData = $this->generateEmployeeLeaveData();
        $employeeLeaveCSVData = $this->convertToCSV($employeeLeaveData);
        file_put_contents('employee_leave.csv', $employeeLeaveCSVData);

        // Step 3: Create the public holiday CSV file
        $publicHolidayData = $this->generatePublicHolidayData();
        $publicHolidayCSVData = $this->convertToCSV($publicHolidayData);
        file_put_contents('public_holiday.csv', $publicHolidayCSVData);

        // Step 4: Calculate the employee attendance for June month
        $employeeAttendanceData = $this->calculateEmployeeAttendance();
        $employeeAttendanceCSVData = $this->convertToCSV($employeeAttendanceData);
        file_put_contents('employee_attendance.csv', $employeeAttendanceCSVData);

        // Step 5: Store the calculated results of employees in the result output CSV sheet
        // In this step, we won't use OpenAI as it's just formatting the data.

        return response()->json(['message' => 'CSV files generated successfully']);
    }

    private function generateEmployeeData()
    {
        $prompt = 'Generate the csv file for 3  employees for june month (30 days) and Marked the Weekend (Saturday and Sunday as 0) having Employee ID as (EMP001,...),Date (DD-MM-YYYY),Day,Time-in (8AM - 10AM),Time-out (5PM-8PM),Total Hours Worked(Hrs)';
        // Send the prompt to the OpenAI API for text generation
        $response = $this->generateTextFromOpenAI($prompt);
        
        // Process the response and convert it to CSV data
        $employeeData = $response;

        return $employeeData;
    }

    private function generateEmployeeLeaveData()
    {
        $prompt = 'Generate the csv for employee leave having Employee ID as (EMP001,...),Employee Name,Leave Type(half day,full day),Start Date,End Date,Leave Duration,Leave Status (Approval Status like Approved or Rejected) for June month';

        // Send the prompt to the OpenAI API for text generation
        $response = $this->generateTextFromOpenAI($prompt);
        
        // Process the response and convert it to CSV data
        $employeeLeaveData = $response;

        return $employeeLeaveData;
    }

    private function generatePublicHolidayData()
    {
        $prompt = 'Generate the csv file for National holidays(as per India calendar)having Date as (DD-MM-YYYY),Day,Holiday Name,Type(Public)';

        // Send the prompt to the OpenAI API for text generation
        $response = $this->generateTextFromOpenAI($prompt);

        // Process the response and convert it to CSV data
        $publicHolidayData = $response;

        return $publicHolidayData;
    }

    private function calculateEmployeeAttendance()
    {
        // Generate the prompt to request the user to provide the attendance data
        $prompt = "Generate the Attendance sheet for 3 employees for june month  in to csv format which contain  headers, Employee Name,Employee Id(EMP...),Total Working Day(Calculated),Total Working Hours(Calculated).excluding weekends, holidays, leaves and based on number of working days, each day 8 hours being working hours.";

        // Send the prompt to the OpenAI API for text generation
        $response = $this->generateTextFromOpenAI($prompt);
    
        // Process the response and convert it to CSV data
        $employeeAttendanceData = $response;
    
        return $employeeAttendanceData;
    }

    private function generateTextFromOpenAI($prompt)
    {
        $apiKey = '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';
        $apiEndpoint = 'https://api.openai.com/v1/chat/completions';

        $headers = [
            'Authorization: Bearer ' . $apiKey,
            'Content-Type: application/json',
        ];

        $data = [
            'model' => 'gpt-3.5-turbo',
            'temperature' => 0.2,
            'messages' =>  array(
                array("role" => "user", "content" => $prompt)
            ),
            'max_tokens' => 100,
        ];

        $ch = curl_init($apiEndpoint);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $response = curl_exec($ch);
        $httpStatus = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($httpStatus === 200) {
            $responseData = json_decode($response, true);
            if (isset($responseData['choices'][0]['message']['content'])) {
                return $responseData['choices'][0]['message']['content'];
            } else {
                return 'Error generating text';
            }
        } else {
            return 'Error generating text';
        }
    }

    private function convertToCSV($data)
    {
        // If $data is a string, assume it is a CSV string and convert it to an array
        if (is_string($data)) {
            $data = $this->parseCSVData($data);
        }

        if (is_array($data)) {
            $csvData = '';
            foreach ($data as $row) {
                $csvData .= implode(',', $row) . "\n";
            }
            return $csvData;
        } else {
            return 'Invalid data format. Unable to convert to CSV.';
        }
    }

    private function parseCSVData($csvString)
    {
        $rows = explode("\n", $csvString);
        $data = [];
        foreach ($rows as $row) {
            $data[] = explode(',', $row);
        }
        return $data;
    }


}
